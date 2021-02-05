
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
<body>


<?php

	
	include $_SERVER['DOCUMENT_ROOT'] . '/db.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/like.php';
	$act=100;include $_SERVER['DOCUMENT_ROOT'] . '/topbar.php';
	include $_SERVER['DOCUMENT_ROOT'] . '/login-check.php';
	
	
	
	$oname = getNameOfUser(getData("ownerid","classes","classid",$_GET['c'],$db),$db);
	if($oname != $_SESSION['username']){
		
		header("Location: /school");
	}else{
	?>
	<div>
	<form action="sendassignment.php" method="post" enctype="multipart/form-data">
			<textarea name ="editor" style="width:70%;height:100px;"></textarea>
			<input type="hidden" value="<?php echo $_GET['c']; ?>" name="c">
			<input type="file" name="image" class="btncmt"><br><br>
			<input type="submit" class="btn" value="Submit">
			
			</form>
		<br>
		</div>
	
	<?php
	
	
}
	echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
	include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
	?>
	
	</body>
	</html>
