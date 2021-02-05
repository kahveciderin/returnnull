<?php

session_start();
include 'db.php';
include_once 'like.php';

if(isset($_SESSION['username'])){
	
	toggleBlock($_GET['b'], getIdOfUser($_SESSION['username'],$db),$db);
	
	echo isBlocked($_GET['b'], getIdOfUser($_SESSION['username'],$db),$db);
	}

?>
