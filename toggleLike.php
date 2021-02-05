<?php
$lcpath = $_SERVER['DOCUMENT_ROOT'];
$lcpath .= "/login-check.php";
 session_start();
include $lcpath;


//include($lcpath);
?>

<?php error_reporting(0);
 ?>

<?php 
	include 'db.php';
	include 'like.php';
 
    if (isset($_POST['togglelike'])) {
		
		//echo "<br><br><br>".getIdOfUser($_SESSION['username']);
		toggleLike($_POST['togglelike'],getIdOfUser($_SESSION['username'],$db),$db);
		//$asdf = getIdOfUser($_SESSION['username']);
		//echo "<script>alert(\"You liked the post #{$asdf}\");</script>";
		
 }

?>
