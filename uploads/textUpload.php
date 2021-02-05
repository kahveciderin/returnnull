
<?php //error_reporting(0);
session_start(); ?>
<?php
$disableloading = true;
$lcpath = $_SERVER['DOCUMENT_ROOT'];
$lcpath .= "/login-check.php";
include($lcpath);
include '../db.php';



if(isset($_POST['reply'])){
	$reply = $_POST['reply'];
	}else{
		$reply = -1;
	}

$unsaa = $_SESSION['username'];

$result = mysqli_query($db,"SELECT id FROM users WHERE username='$unsaa'");


$userid = mysqli_fetch_array($result);



$unamee = $userid[0];
$query = "INSERT INTO posts (imagename, description, userid, posttype, reply) VALUES ('{$_POST['text']}', '{$_POST['desc']}',  '$unamee', '1', $reply)";	 
mysqli_query($db, $query);


$posidres = mysqli_query($db,"SELECT postid FROM posts WHERE imagename='$wfname' AND userid='$unamee'");
$postidn= mysqli_fetch_array($posidres);



$pidd = $postidn[0];
$content = $desc;
include '../mention_check.php';


if($reply == -1)
header('Location: /');
else
header('Location: /post.php?post='.$reply);
return;

?>
