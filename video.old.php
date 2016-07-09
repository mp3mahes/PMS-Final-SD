<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if (!empty($_GET["type"]))
{
	$_SESSION["type"] = $_GET["type"];
}
if(!empty($_GET["language"]))
{
	if ($_SESSION["type"] == "health")
	{
		$type = "Disease Management";
	}
	else
	{
		$type = $_SESSION["type"];
	}
	$urlArray = $db_handle->runQuery("SELECT * FROM videos WHERE language='" . $_GET["language"] . "' AND type='" . $type . "' ORDER BY viewcount DESC");
}
?>

<!DOCTYPE html>
<html>
	<head>
		
	</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

	<body>
		<div id="header-wrapper-video">
	<div id="header-pages" class="container">
		<div id="logo">
			<h1><a href="#">Videos</a></h1>
		</div>
		<div id="menu">
			<ul>
				<li><a href="index.html" accesskey="1" title="">Home</a></li>
				<li><a href="#" accesskey="2" title="">Help</a></li>
				<li><a href="contact.html" accesskey="5" title="">Contact Us</a></li>
			</ul>
		</div>
	</div>
	</div>
		<form action="video.php" method = "GET">
			<fieldset><legend>Filter videos</legend>
			<label>Language <select name = "language">
			<option value = "english">English</option>
			<option value = "spanish">Spanish</option>
			</label></select>
			<input type="submit" value="Apply"/>
			</fieldset></form>
			
		<hr />

<?php
		if (!empty($urlArray)) { 
			foreach($urlArray as $key=>$value)
			{
			?>

			<div class="content">
				<div class="content1">

					<iframe  width="560" height="315" src="<?php echo $urlArray[$key]["URL"] ?>" frameborder="0" allowfullscreen></iframe>
				</div>


<style>
.form1
{


}


.content
{
margin-left: 2cm;
float: left;
}

.content1
{


}
</style>


<form method='post' class="form1" >


<!--
the code below using Jquery. just to see 
language: lang-js -->

<script>

    $('.like-btn').click(function(){
      var $button = $(this);
      var buttonNumber = $button.data('button');

      $button.addClass('like-btn-solid');
      $('.dislike-btn[data-button="'+buttonNumber+'"]').removeClass('dislike-btn-solid');
    });

    $('.dislike-btn').click(function(){
      var $button = $(this);
      var buttonNumber = $button.data('button');

      $button.addClass('dislike-btn-solid');
      $('.like-btn[data-button="'+buttonNumber+'"]').removeClass('like-btn-solid');
    });

    </script>

<!-- language: lang-css -->
<style>

    .dislike-btn-solid {
      color: red;
    }

    .like-btn-solid {
      color: blue;
    }
</style>
<!-- language: lang-html -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <button class="dislike-btn" data-id="dislikeBtn-1" data-button="1">Dislike</button>
    <button class="like-btn" data-id="likeBtn-1" data-button="1">Like</button>
    <br />
    
<!-- end  -->






<!-- 
Trying with Radio Buttons


<input id="radio1" type="radio" name="mybtn" value="0" />Like
<br />
<input id="radio2" type="radio" name="mybtn" value="1" />Dislike -->











 <b> Drop your Comments: </b> <br><br>
  <textarea name='comment' id='comment' > </textarea><br>
  <input type='submit' value='Submit'   button onclick="myFunction()"/>   
</form>
<br>
<script>
function myFunction() {
    alert("Thankyou for your Feedbacks.");
}
</script>






</div>
	
			<?php
			}
		}?>
		</hr>
		<p> 1 > 2 > 3 </p>
		<a class="return_button" href="">Return</a>
	</body>
</html>