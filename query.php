<?php 
 // Connects to your Database 
 $db = mysql_connect("localhost", "seniordesign", "utr9AaQ!") or die(mysql_error()); 
 $db_select = mysql_select_db("mavappointdb",$db);
 if (!$db_select) {
 die("Database selection also failed miserably: " . mysql_error());
 }
 ?> 