<?php 
 session_start(); ?>
<?php 

	include_once '../like.php';
session_start();
  if (getTchrOfUser(getIdOfUser($_SESSION['username'],$db),$db) != 1) {
  	header('location: /registration/login.php');
  }
?>
