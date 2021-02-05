<!DOCTYPE HTML>
<html lang="en" xml:lang="en">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ReturnNull Home - The Best Social Media Platform</title>
  
  <link rel="stylesheet" href="/style.css"/>
  <link rel="stylesheet" href="style.css"/>
  <link rel="stylesheet" href="styles.css"/>
  
  <link rel="stylesheet" href="content_styling.css"/>
<script src="/scripts/jquery.min.js"></script>
<script src="/scripts/jquery.lazyload.js"></script>
</head>

<body>
	<?php 
	
	include '../db.php';
	include_once '../like.php';
	$act=6; include('../topbar.php');
	
			$adcounter = 0;
			if(getTchrOfUser(getIdOfUser($_SESSION['username'],$db),$db) == 1){
			header('Location: /school');
		}
	 ?>
	
	
  <div class="header"><h1>Blogs</h1></div><br>
  <?php
  $result = mysqli_query($db,"SELECT blogid,userid,blogtitle,body,date FROM blogs WHERE deleted=0 ORDER BY date DESC");
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		
		echo "<div id=\"borderpost\" style=\"height: 200px; overflow: hidden;\" >";
		
		echo "<h3 style=\"text-align:center;\">{$row['blogtitle']}</h3>";
		$byuname = getNameOfUser($row['userid'],$db);
		
		echo "<div style=\"text-align:right;\"><small><small>{$row['date']}</small>  By $byuname</small></div>";
		
		echo "<div class=\"blog-desc\" style=\"height: 120px;\">{$row['body']}</div>";
		
		echo "<div style=\"position:relative;bottom:0;text-align:center;\"><a class=\"cr\" href=\"/blog/{$row['blogid']}\">Continue Reading</a></div>";
		
		echo "</div><br>";

$adcounter +=1;
		if($adcounter == 5){
			$adcounter = 0;
			include '../ad.php';

		}
		
				}
	?>
  </body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
  </html>
