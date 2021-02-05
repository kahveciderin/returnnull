<?php
include 'db.php';

//print_r($db);

//toggleLike(5,3,$db);
//echo "<br>Total: ".getTotalLikes(5,$db);

function isLiked($postid,$userid,$db){
	$result = mysqli_query($db,"SELECT liked FROM likes WHERE userid = '$userid' AND postid = '$postid'");
	$result = mysqli_fetch_row($result);
	
	return !empty($result);
}

function isBlocked($buserid,$userid,$db){
	$result = mysqli_query($db,"SELECT block FROM block WHERE blocker = '$userid' AND blocked = '$buserid'");
	$result = mysqli_fetch_row($result);
	
	return !empty($result);
}

function toggleBlock($buserid,$userid,$db){
	if(isBlocked($buserid,$userid,$db)){
		mysqli_query($db,"DELETE FROM block WHERE blocker = '$userid' AND blocked = '$buserid' AND block='1'");
	}else{
		mysqli_query($db,"INSERT INTO block (blocker,blocked) VALUES ('$userid','$buserid')");
	}
	
}


function toggleLike($postid,$userid,$db){
	if(isLiked($postid,$userid,$db)){
		mysqli_query($db,"DELETE FROM likes WHERE userid = '$userid' AND postid = '$postid' AND liked='1'");
		$poster = whoPostedThis($postid,$db);
		$uname = getNameOfUser($userid,$db);
		mysqli_query($db,"INSERT INTO notifications (userid,notification,postid) VALUES ('$poster','User $uname unliked your post.','$postid')");
	}else{
		mysqli_query($db,"INSERT INTO likes (liked,userid,postid) VALUES (1,'$userid','$postid')");
		$poster = whoPostedThis($postid,$db);
		$uname = getNameOfUser($userid,$db);
		mysqli_query($db,"INSERT INTO notifications (userid,notification,postid) VALUES ('$poster','User $uname liked your post.','$postid')");
	}
	
}

function getTotalLikes($postid,$db){
	$result = mysqli_query($db, "select count(1) FROM likes WHERE postid = '$postid' AND liked='1'");
	$row = mysqli_fetch_array($result);

	return $row[0];
}


function getTotalComments($postid,$db){
	$result = mysqli_query($db, "select count(1) FROM posts WHERE reply = '$postid'");
	$row = mysqli_fetch_array($result);

	return $row[0];
}

function isCompletedHw($userid,$assid,$db){
	$result = mysqli_query($db, "select count(1) FROM homeworks WHERE assignmentid = '$assid' AND userid = '$userid'");
	$row = mysqli_fetch_array($result);

	return $row[0];
}
function getIdOfUser($username,$db){
	
	$result = mysqli_query($db,"SELECT id FROM users WHERE username='$username'");
	$userid = mysqli_fetch_array($result);
	return $userid[0];
}

function getData($select,$from,$where,$value,$db){
	
	$result = mysqli_query($db,"SELECT $select FROM $from WHERE $where = '$value'");
	$data = mysqli_fetch_array($result);
	return $data[0];
}

function getDataRaw($select,$from,$where,$db){
	
	$result = mysqli_query($db,"SELECT $select FROM $from WHERE $where");
	$data = mysqli_fetch_array($result);
	return $data[0];
}
function getTchrOfUser($userid,$db){
	
	$result = mysqli_query($db,"SELECT teacher FROM users WHERE id='$userid'");
	$istchr = mysqli_fetch_array($result);
	return $istchr[0];
}


function getClassCodeOfUser($userid,$db){
	
	$result = mysqli_query($db,"SELECT classcode FROM users WHERE id='$userid'");
	$istchr = mysqli_fetch_array($result);
	return $istchr[0];
}
function addNotifToUser($userid,$notification,$postid,$db){
	mysqli_query($db,"INSERT INTO notifications (userid,notification,postid) VALUES ('$userid','$notification','$postid')");
}

function whoPostedThis($postid,$db){
	$result = mysqli_query($db,"SELECT userid FROM posts WHERE postid='$postid'");
	$userid = mysqli_fetch_array($result);
	return $userid[0];
}

function getNameOfUser($userid,$db){
	
	$result = mysqli_query($db,"SELECT username FROM users WHERE id='$userid'");
	$userid = mysqli_fetch_array($result);
	return $userid[0];
}

function getPicOfUser($userid,$db){
	
	$result = mysqli_query($db,"SELECT profilepic FROM users WHERE id='$userid'");
	$userid = mysqli_fetch_array($result);
	return $userid[0];
}

function getTotalNotifs($userid,$db){
	$result = mysqli_query($db, "select count(1) FROM notifications WHERE userid = '$userid' AND seen='0'");
	$row = mysqli_fetch_array($result);

	return $row[0];
}
?>
