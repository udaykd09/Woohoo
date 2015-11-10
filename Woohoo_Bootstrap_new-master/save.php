<?php
//get's and saves the image
$url = $_GET['image'];
$title = $_GET['title'];
$type = $_GET['type'];
$img = 'uploads/new/'.$title.'.'.$type;
file_put_contents($img, file_get_contents($url));
include "multi_curl.php";
?>