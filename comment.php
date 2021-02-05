<?php error_reporting(0); session_start(); ?>



<?php
$lcpath = $_SERVER['DOCUMENT_ROOT'];
$lcpath .= "/login-check.php";
include($lcpath);
include_once 'like.php';
?>

<html>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="/style.css">

<body>

<?php $ulpath = $_SERVER['DOCUMENT_ROOT']; $ulpath .= "/topbar.php";$act=1; include($ulpath); ?>

<?php

$pidtoc = $_GET['postid'];
//echo $_POST['commentarea'];
if(isset($_POST['commentarea']) && $_POST['commentarea'] != ""){
	
	
	$cmt = $_POST['commentarea'];
	//user pressed the "upload" button
	//echo $_POST['commentarea'];
	//start MySQLi
	include 'db.php';
	
	$pname = $_SESSION['username'];
	
	
   $nameresult = mysqli_query($db,"SELECT id FROM users WHERE username='$pname'");

    //print_r($nameresult);


    $pname = mysqli_fetch_array($nameresult)[0];
    
    
    //echo $pname;
	$pidd = $pidtoc;
	$content = $cmt;
	include 'mention_check.php';
	$query = "INSERT INTO comments (postid, userid, body) VALUES ('$pidtoc', '$pname',  '$cmt')";	 
	mysqli_query($db, $query);
	
	
	$poster = whoPostedThis($pidtoc,$db);
	addNotifToUser($poster,"User {$_SESSION['username']} commented on your post: $cmt",$pidtoc,$db);
	
	header("Location: /".chr(35).$pidtoc);



}



?>
<div id="wrapper">
	
<div class="main-login">


<div class="input-group">
	
	
	

<br><br>
<form name="comment" action="comment.php?postid=<?php  echo $_GET['postid']; ?>" method="POST">
<textarea name="commentarea" cols="24"></textarea>
<input type="submit" name="upload" value="Comment" class="btn">
</form>


</div>
</div>
</div><?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</body>

</html>


