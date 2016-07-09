<?php
session_start();
/*if(isset($_SESSION['login_user']))
{
	header("location: board.php");
}*/
if (isset($_POST['submit'])) 
{
	if (empty($_POST['username']) || empty($_POST['password'])) 
	{
	$_SESSION['error'] = "Username and Password cannot be blank";
	}
	else
	{
		$username=$_POST['username'];
		$password=$_POST['password'];
		$query = "SELECT * from users where password = '". $password . "'AND username = '" . $username . "'";
		$dbh = new PDO("mysql:host=127.0.0.1:3306;dbname=pms","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		foreach ($dbh->query($query) as $row)
		{
			if ($row['username'] == $username && $row['password'] == $password)
			{
				header("location: admin.php");
			}
			else 
			{
				$_SESSION['error'] = "Username or Password is incorrect";
			}
		}
	}
}
else
{
	$_SESSION['error']='';
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
	</head>
<body>
	<div id="login">
		<h2>Admin Login</h2>
	<form action="" method="post">
		<label>UserName :</label>
		<input id="name" name="username" type="text">
		<label>Password :</label>
		<input id="password" name="password" type="password">
		<input name="submit" type="submit" value="Login">
		<p/><?php echo $_SESSION['error']; ?>
	</form>
	</div>
</body>
</html>