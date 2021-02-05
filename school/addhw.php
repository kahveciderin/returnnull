
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
	
	
<form name="upload" action="fileUpload.php" method="POST" enctype="multipart/form-data"> Select file to upload:<br>




<div class="input-group">

 <input type="file" name="image" class="btn">
<br><br>

<input type="hidden" name="assid" value="<?php echo $_GET['a']; ?>" class="btn">
<input type="submit" name="upload" value="upload" class="btn">
<br> <br> <br> <br>



</div>
</form>

	</body>
	</html>
