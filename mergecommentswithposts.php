<?php

include('db.php');
$result = mysqli_query($db,"SELECT * FROM comments");
	
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	
			$sql = "INSERT INTO posts (imagename, description, userid, reply, posttype, date) VALUES ('', '{$row['body']}', '{$row['userid']}', '{$row['postid']}', '1', '{$row['date']}')";
			//mysqli_query($db,$sql);
			//echo "$sql<br>";
}

?>
