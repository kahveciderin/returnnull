<?php
	session_start();
	include $_SERVER['DOCUMENT_ROOT'] . '/db.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/like.php';
	
if(isset($_GET['d'])){
	$del = $_GET['d'];
	if(whoPostedThis($del,$db)==getIdOfUser($_SESSION['username'],$db) || getDataRaw("count(1)","moderators","userid = ".getIdOfUser($_SESSION['username'],$db),$db) > 0){
		echo $_GET['d'].$_GET['r'].$_GET['p'];
		mysqli_query($db,"UPDATE posts SET deleted=1 WHERE postid='$del'");
	}
	header("Location: ".$_GET['r']."#".$_GET['p']);
}

?>
