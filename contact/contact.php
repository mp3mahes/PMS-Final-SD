<?php

$your_email = "mp3.mahes@gmail.com"; // email address to which the form data will be sent
$subject = "Little Treasures Contact Form"; // subject of the email that is sent

if (!isset($_POST['Send'])) {
    header( "Location: contact.php" );
  }



if (isset($_POST["Send"])) {
	$nam = $_POST["Name"];
	$pho = $_POST["Phone"];
	$ema = trim($_POST["Email"]);
	$sub = $_POST["Subject"];
	$com = $_POST["Message"];

	if (get_magic_quotes_gpc()) { 
	$nam = stripslashes($nam);
	$ema = stripslashes($ema);
	$pho = stripslashes($pho);
	$sub = stripslashes($sub);
	$com = stripslashes($com);
	}

$error_msg=array(); 

if (empty($nam) || !preg_match("~^[a-z\\-'\\s]{1,60}$~i", $nam)) { 
$error_msg[] = "The name field must contain only letters, spaces, dashes ( - ) and single quotes ( ' )";
}

if (empty($ema) || !filter_var($ema, FILTER_VALIDATE_EMAIL)) {
	$error_msg[] = "Your email must have a valid format, such as name@mailhost.com";
}

if (empty($pho) && !preg_match("/^[A-z\\/0-9\\s\\(\\)]{1,60}$/", $pho)) { 
$error_msg[]="The phone field can contain only digits, spaces and parentheses";
}

if (empty($sub) || !preg_match("~^[a-z\\-'\\s]{1,60}$~i", $sub)) { 
$error_msg[] = "The subject field must contain only letters, spaces, dashes ( - ) and single quotes ( ' )";
}

$limit = 1000;

if (empty($com) || !preg_match("/^[0-9A-Za-z\\/-\\s'\\(\\)!\\?\\.,]+$/", $com) || (strlen($com) > $limit)) { 
$error_msg[] = "The Comments field must contain only letters, digits, spaces and basic punctuation (&nbsp;'&nbsp;-&nbsp;,&nbsp;.&nbsp;), and has a limit of 1000 characters";
}

// Assuming there's an error, refresh the page with error list and repeat the form

if ($error_msg) {
echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Error</title>
<style>
	body {background: #f7f7f7; font: 100%/1.375 georgia, serif;padding: 20px 40px;}
	div {margin-bottom: 10px;}
	.content {width: 40%; margin: 0 auto;}
	h1 {margin: 0 0 20px 0; font-size: 175%; font-family: calibri, arial, sans-serif;}
	fieldset {border: 0; padding: 0; margin: 0;}
	legend {position: absolute; left:-9999px}
	label {margin-bottom: 2px;}
	input[type="text"], input[type="email"], textarea {font-size: 0.75em; width: 98%; font-family: arial; border: 1px solid #ebebeb; padding: 4px; display: block;}
	input[type="radio"] {margin: 0 5px 0 0;}
	textarea {overflow: auto;}
	.hide {display: none;}
	.err {color: red; font-size: 0.875em; margin: 1em 0; padding: 0 2em;}
</style>
</head>
<body>
	<div class="content">
		<h1>O dear!</h1>
		<p>Unfortunately, your message could not be sent. The form as you filled it out is displayed below. Please make sure each field is completed, and please also address any issues listed below:</p>
		<ul class="err">';
foreach ($error_msg as $err) {
echo '<li>'.$err.'</li>';
}
echo '</ul>
	<form method="post" action="', $_SERVER['PHP_SELF'], '">
		<fieldset> 
			<legend>Contact Us</legend>
				<div>
					<label for="name">Name</label>
					<input name="Name" type="text" size="40" maxlength="60" id="name" value="'; if (isset($_POST["Name"])) {echo $nam;}; echo '">
				</div>
				<div>
					<label for="email">Email Address</label>
					<input name="Email" type="email" size="40" maxlength="60" id="email" value="'; if (isset($_POST["Email"])) {echo $ema;}; echo '">
				</div>
				<div>
					<label for="phone">Telephone</label>
					<input name="Phone" type="text" size="40" maxlength="60" id="phone" value="'; if (isset($_POST["Phone"])) {echo $pho;}; echo '">
				</div>
				<div>
					<label for="subject">Subject</label>
					<input name="Subject" type="text" size="40" maxlength="60" id="subject" value="'; if (isset($_POST["Subject"])) {echo $sub;}; echo '">
				</div>
				<div>
					<label for="comm">Comments</label>
					<textarea name="Message" rows="10" cols="50" id="comm">'; if (isset($_POST["Message"])) {echo $com;}; echo '</textarea>
				</div>
				<div>
					<input type="submit" name="Send" value="Send">
				</div>
		</fieldset>
	</form>
</body>
</html>';
exit();
} 

$email_body = 
	"Name: $nam\
\
" .
	"Email: $ema\
\
" .
	"Telephone: $pho\
\
" .
	"Subject: $sub\
\
" .
    "MESSAGE:\
\
" .
	"$com" ; 

// Assuming there's no error, send the email and redirect to Thank You page

if (isset($_REQUEST['<font color="#FF0000">Message</font>']) && !$error_msg) {
mail ($your_email, $subject, $email_body, "From: $nam <$ema>" . "\\r\
" . "Reply-To: $nam <$ema>");
header ("Location: http://littletreasures-shop.co.uk/Contact/messagesent/true.html");
exit();
}  
}
