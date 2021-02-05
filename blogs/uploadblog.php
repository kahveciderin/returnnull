<?php
include '../login-check.php';
	include '../db.php';
	include_once '../like.php';
	$act=7; include('../topbar.php');
if(isset($_POST['editor'])){
	
	preg_match("/(?<=<h1>)(.*)(?=<\/h1>)/",$_POST['editor'],$title);
	
	$title = $title[0];
	//echo $title;
	
	if(isset($_SESSION['username'])){
		
		$body = preg_replace("/<h1>(?<=<h1>)(.*)(?=<\/h1>)<\/h1>/","",$_POST['editor']);
		$uid = getIdOfUser($_SESSION['username'],$db);
		
		echo $body;
		
		mysqli_query($db,"INSERT INTO blogs (userid,blogtitle,body) VALUES ('$uid','$title','$body')");
		}
	}
header('Location: /blogs');
?>
