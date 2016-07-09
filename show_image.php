<?php
$id = $_GET['id'];

if($id)
{
    $res = mysql_query('SELECT content FROM readings WHERE readID = ' . $id . "'");
        $data = mysql_fetch_assoc($res);
        header("Content-type: image/jpg"); //Send the content Type here.
        print $data['content'];
        exit;
}
?>