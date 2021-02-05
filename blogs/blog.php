<!DOCTYPE HTML>
<html lang="en" xml:lang="en">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ReturnNull Home - The Best Social Media Platform</title>
  
  <link rel="stylesheet" href="/style.css"/>
  <link rel="stylesheet" href="style.css"/>
  <link rel="stylesheet" href="content_styling.css"/>
<script src="/scripts/jquery.min.js"></script>
<script src="/scripts/jquery.lazyload.js"></script>
</head>

<body>



	<?php 
	
	include '../db.php';
	include_once '../like.php';
	$act=6; include('../topbar.php');
	 ?>
<?php
$result = mysqli_query($db,"SELECT blogid,userid,blogtitle,body,date FROM blogs WHERE blogid={$_GET['id']} ORDER BY date DESC");
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
echo "<div class=\"header\"><h1>{$row['blogtitle']}</h1><h2>";
$byuname = getNameOfUser($row['userid'],$db);
		
		echo "<div style=\"text-align:right;\"><small><small>{$row['date']}</small>  By $byuname</small></div>";
echo "</h2></div><br>";

echo "<div style=\"width:90%; position: relative; left: 5%; border-radius:5%; height:100%; background:#fff; overflow-wrap: break-word;\">{$row['body']}</div>";


	echo "<br><div id=\"borderpost\">";
	echo '<div class="addthis_inline_share_toolbox"></div> ';
	echo "</div>";

include '../ad.php';
?>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</body>


</html>
