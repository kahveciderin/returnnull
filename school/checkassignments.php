
<!DOCTYPE html>
<html>
	
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	
	<title>School</title>
	<link rel="stylesheet" type="text/css" href="/style.css">
		<link rel="stylesheet" href="/modal.css"/>
		
  <link rel="stylesheet" href="style.css"/>
<script src="/scripts/jquery.min.js"></script>
<script src="/scripts/jquery.lazyload.js"></script>
</head>
<body >


<?php

	
	include $_SERVER['DOCUMENT_ROOT'] . '/db.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/like.php';
	$act=100;include $_SERVER['DOCUMENT_ROOT'] . '/topbar.php';
	include $_SERVER['DOCUMENT_ROOT'] . '/login-check.php';
	?>
	
	
  <div class="header"><h1>Homeworks</h1></div><br>
  <?php
  $uid = getIdOfUser($_SESSION['username'],$db);
  $classcode = $_GET['c'];
  if($uid == getDataRaw("ownerid","classes","classid='$classcode'",$db)){
			
  $result = mysqli_query($db,"SELECT assignmentid,description,date FROM assignments WHERE class='$classcode' ORDER BY date DESC");
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		
		echo "<div id=\"borderpost\" style=\"height: 200px; overflow: hidden;\" >";
		
		echo "<h3 style=\"text-align:center;\">Given: {$row['date']}</h3>";
		
		
		echo "<div class=\"blog-desc\" style=\"height: 120px;\">{$row['description']}</div>";
		
		echo "<div style=\"position:relative;bottom:0;text-align:center;\"><a class=\"cr\" href=\"assview.php?a={$row['assignmentid']}&c=$classcode\">Continue Reading</a></div>";
		
		echo "</div><br>";


		
				
			}
		}else{
			
			header("Location: /school");
			}
	?>
	</body>
	</head>
