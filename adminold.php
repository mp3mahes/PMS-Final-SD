<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if (isset($_POST['submit'])) 
{
	unset($_SESSION['error']);
	switch ($_POST['submit'])
	{
		case 'Add':
		if ((empty($_POST['url']) || empty($_POST['type']) || empty($_POST['media']) || empty($_POST['language']))) 
		{
			$_SESSION['error'] = "Input Error";
		}
		else
		{
			$url=$_POST['url'];
			$type=$_POST['type'];
			$media=$_POST['media'];
			$language=$_POST['language'];
			$query = "INSERT INTO ".$media." (URL,Type,Language) VALUES ('".$url."','".$type."','".$language."')";
		}
		break;
		case 'Remove':
		if (empty($_POST['vidid']))
		{
			$_SESSION['error'] = "Input Error";
		}
		else
		{
			$vidid = $_POST['vidid'];
			$media=$_POST['media'];
			$query = "DELETE FROM ".$media." WHERE VidID='".$vidid."'";
		}
		break;
	}
	if (!isset($_SESSION['error']))
	{
		$db_handle->dbMod($query);
	}
	else
	{
		echo '<script type="text/javascript">alert("Input Error");</script>';
	}
}
$fitArray = $db_handle->runQuery("SELECT * FROM videos WHERE type='Exercise' ORDER BY VidID ASC");
$healthArray = $db_handle->runQuery("SELECT * FROM videos WHERE type='disease management' ORDER BY VidID ASC");
$dietArray = $db_handle->runQuery("SELECT * FROM videos WHERE type='Nutrition' ORDER BY VidID ASC");
?>





<!DOCTYPE html>
<html>
<head>
	<title>Admin Console</title>
	<link rel="stylesheet" type="text/css" href="admin.css">
	<style>
	table {
		width:100%;
	}
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}
	th, td {
		padding: 5px;
		text-align: left;
	}
	table tr:nth-child(even) {
		background-color: #eee;
	}
	table tr:nth-child(odd) {
	   background-color:#fff;
	}
	table th	{
		background-color: black;
		color: white;
	}
	</style>
</head>
<body>
	<nav><a href="login.html">Logout</a></nav>
	<h1>Admin Console</h1>
	<hr />
	<h2>Website Usage Reports</h2>
	 <table style="width:100%">
	  <tr>
		<th>ID</th>
		<th>URL</th>
		<th>Views</th>
		<th>Type</th>
		<th>Language</th>
	  </tr>
		<?php
		if (!empty($fitArray)) { 
			foreach($fitArray as $key=>$value)
			{
			?>
				<tr>
					<td>
						<?php echo $fitArray[$key]["VidID"] ?>
					</td>
					<td>
						<?php echo $fitArray[$key]["URL"] ?>
					</td>
					<td>
						<?php echo $fitArray[$key]["ViewCount"] ?>
					</td>
					<td>
						<?php echo $fitArray[$key]["Type"] ?>
					</td>
					<td>
						<?php echo $fitArray[$key]["Language"] ?>
					</td>
				</tr>
			<?php
			}
		}?>
		<?php
		if (!empty($healthArray)) { 
			foreach($healthArray as $key=>$value)
			{
			?>
				<tr>
					<td>
						<?php echo $healthArray[$key]["VidID"] ?>
					</td>
					<td>
						<?php echo $healthArray[$key]["URL"] ?>
					</td>
					<td>
						<?php echo $healthArray[$key]["ViewCount"] ?>
					</td>
					<td>
						<?php echo $healthArray[$key]["Type"] ?>
					</td>
					<td>
						<?php echo $healthArray[$key]["Language"] ?>
					</td>
				</tr>
			<?php
			}
		}?>
				<?php
		if (!empty($dietArray)) { 
			foreach($dietArray as $key=>$value)
			{
			?>
				<tr>
					<td>
						<?php echo $dietArray[$key]["VidID"] ?>
					</td>
					<td>
						<?php echo $dietArray[$key]["URL"] ?>
					</td>
					<td>
						<?php echo $dietArray[$key]["ViewCount"] ?>
					</td>
					<td>
						<?php echo $dietArray[$key]["Type"] ?>
					</td>
					<td>
						<?php echo $dietArray[$key]["Language"] ?>
					</td>
				</tr>
			<?php
			}
		}?>
	</table> 
	<form id="pdf">
		<button type="button">Export to PDF</button>
	</form>
	<hr />
	<h2>Add to Repository</h2>
	<form id="repository" action ="" method="post">
		<input type="radio" name="media" value="videos">Video</input>
		<br />
		<input type="radio" name="media" value="reading">Reading</input>
		<br />
		<br />
		<input type="radio" name="language" value="English">English</input>
		<br />
		<input type="radio" name="language" value="Spanish">Spanish</input>
		<br />
		<br />
		<input type="radio" name="type" value="Exercise">Exercise</input>
		<br />
		<input type="radio" name="type" value="Disease Management">Disease Management</input>
		<br />
		<input type="radio" name="type" value="Nutrition">Nutrition</input>
		<br />
		<br />
		<h4>URL</h4>
		<input type="text" name="url"></input>
		<input type="submit" name="submit" value="Add">
		<h2>Remove from Repository</h2>
		<input type="radio" name="media" value="videos">Video</input>
		<br />
		<input type="radio" name="media" value="reading">Reading</input>
		<br />
		<br />
		<h4>ID</h4>
		<input type="text" name="vidid"></input>
		<input type="submit" name="submit" value="Remove">
	</form>
</body>
</html>