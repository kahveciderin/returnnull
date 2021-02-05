<?php
include 'db.php';
include_once 'like.php';
session_start();
if(whoPostedThis($_GET['postid'],$db) == getIdOfUser($_SESSION['username'],$db) || getDataRaw("count(1)","moderators","userid = ".getIdOfUser($_SESSION['username'],$db),$db) > 0){
	$savenow = $_GET['editeddata'];
	$sql = "UPDATE posts SET description = '$savenow' WHERE postid = {$_GET['postid']}";
	mysqli_query($db,$sql);
	}


?>
