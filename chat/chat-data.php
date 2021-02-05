<?php
include '../db.php';

$rn = $_GET['row'];

$sql = "SELECT body, userid FROM chat LIMIT $rn,1000000000000";
	$result = mysqli_query($db, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			
			
	$unforthis = mysqli_query($db,"SELECT username, profilepic FROM users WHERE id='{$row["userid"]}'");
   $fun = array();
   $unrow = mysqli_fetch_array($unforthis, MYSQLI_ASSOC);
	$fun[] = $unrow;
	$un = $fun[0]['username'];
	$up = $fun[0]['profilepic'];
	
			$bfilt = preg_replace("/[*<>]/", "", $row["body"] );
			
			echo "<div style=\"display: flex; flex: 1;\">";
			echo "<img style=\"position: relative; top:-14px;\" src=\"/uploads/ppictures/$up\" class=\"ppic\" width=\"45\" height=\"45\"><p style=\"position: relative; left: 20px;\">".$un.": " . $bfilt. "</p>";
			echo "</div><br>";
			$chatcnt += 1;
			
			
		}	
	} else {
	}
	echo "<p id=\"chatcnt\" style=\"display:none;\">$chatcnt</p>";

?>
