
<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>Notifications</title>
  <link rel="stylesheet" type="text/css" href="/style.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <?php $disableloading = true; $ulpath = $_SERVER['DOCUMENT_ROOT']; $ulpath .= "/topbar.php";$act=5; include($ulpath);?>
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$lcpath = $path. "/login-check.php";
$fpath = $path. "/like.php";
//session_start();
include '../db.php';
include_once($lcpath);
include_once($fpath);
$uid = getIdOfUser($_SESSION['username'],$db);
echo "Hello {$_SESSION['username']}!<br><br><br>";
$result = mysqli_query($db,"SELECT notifid,notification,postid,date FROM notifications WHERE seen='0' AND userid='$uid' ORDER BY date DESC");
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
if(empty($row)){echo "No new notifications";}else{
echo "<a class=\"nav-link\" href=\"/post.php?post={$row['postid']}\">";
$asd = preg_replace("/[*<>]/", "", $row['notification']);
echo "<div class=\"notif_new\">$asd</div>";
echo "</a><br>";
mysqli_query($db,"UPDATE notifications SET seen='1' WHERE notifid='{$row['notifid']}'");
}
}


if(isset($_GET['old'])){
	
$result = mysqli_query($db,"SELECT notifid,notification,postid,date FROM notifications WHERE userid='$uid' ORDER BY date DESC");
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
if(empty($row)){echo "No new notifications";}else{
echo "<a class=\"nav-link\" href=\"/post.php?post={$row['postid']}\">";
$asd = preg_replace("/[*<>]/", "", $row['notification']);
echo "<div class=\"notif_container\">$asd</div>";
echo "</a><br>";
mysqli_query($db,"UPDATE notifications SET seen='1' WHERE notifid='{$row['notifid']}'");
}
}

echo "<a href=\"/notifications\">Show new notifications</a>";
	}else{
		
		
echo "<a href=\"old\">Load older notifications</a>";
		}

?>

<script>
</script>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</body>
</html>
