<!DOCTYPE HTML>
<html lang="en" xml:lang="en">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School</title>
  
  <link rel="stylesheet" href="/style.css"/>
  <link rel="stylesheet" href="style.css"/>
  <link rel="stylesheet" href="content_styling.css"/>
<script src="/scripts/jquery.min.js"></script>
<script src="/scripts/jquery.lazyload.js"></script>
</head>

<body>



	<?php 
	
	include '../db.php';
	include_once '../like.php';
	$act=100; include('../topbar.php');
	include('../login-check.php');
	 ?>
	 
	 <?php
	 $uid = getIdOfUser($_SESSION['username'],$db);
	 mysqli_query($db,"DELETE FROM homeworks WHERE userid = '$uid' AND assignmentid = '{$_GET['a']}'");
	 header("Location: /school/assignment.php?a={$_GET['a']}");
	 
	 ?>
	 
	 
	 </body>
	 </html>
