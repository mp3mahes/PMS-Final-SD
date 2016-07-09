<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
$ID = $_POST["ID"];
$Comment = $_POST["comment"];
$query = "INSERT INTO comments (vidID,comment) VALUES ('".$ID."','".$Comment."')";
$db_handle->dbMod($query); 
?>