<?php
$lcpath = $_SERVER['DOCUMENT_ROOT'];
$lcpath .= "/login-check.php";
include($lcpath);
include("../db.php");

$name = $_FILES["image"]['name'];
$ext = end((explode(".", $name)));
$filename = uniqid("post_".date("Y-m-d-H-m-s")."_"). ".$ext";

$uploadfile = "uploads/";

 if (rename($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/school/uploads/".$filename))
 { 

$unsaa = $_SESSION['username'];

$result = mysqli_query($db,"SELECT id FROM users WHERE username='$unsaa'");


$userid = mysqli_fetch_array($result);

$unamee = $userid[0];

$query = "INSERT INTO homeworks (userid, filename, assignmentid) VALUES ('$unamee', '$filename', '{$_POST['assid']}')";	 
mysqli_query($db, $query);


 }

header("Location: /school");
?>
