<?php

include $_SERVER['DOCUMENT_ROOT'] . '/db.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/like.php';
	$act=100;include $_SERVER['DOCUMENT_ROOT'] . '/topbar.php';
	include $_SERVER['DOCUMENT_ROOT'] . '/login-check.php';
	
	
	$uid = getIdOfUser($_SESSION['username'],$db);

$cname = $_POST['classname'];
mysqli_query($db,"INSERT INTO classes (ownerid,name) VALUES ('$uid','$cname')");

header("Location: /school");
?>
