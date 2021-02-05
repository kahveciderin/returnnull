<?php


$row = $_GET['row'];
//$row = 3;
$request = "SELECT * FROM posts WHERE deleted=0 ORDER BY date DESC LIMIT $row,3";
include $_SERVER['DOCUMENT_ROOT'] . '/showposts.php';

?>
