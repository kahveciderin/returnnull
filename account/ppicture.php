<?php error_reporting(0); session_start(); ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Profile</title>
<?php $disableloading = true;  $ulpath = $_SERVER['DOCUMENT_ROOT']; $ulpath .= "/topbar.php";$act=3; include($ulpath); ?>





<div class="header">
	<h2>Account Settings</h2>
</div><link rel="stylesheet" type="text/css" href="../style.css">
<form name="upload" action="fileUpload.php" method="POST" enctype="multipart/form-data"> Select profile picture:

<div class="input-group">

 <input type="file" name="image" class="btn">
<br> <br>
<input type="submit" name="upload" value="Update" class="btn">
<br> <br> <br> <br>


</div>

</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>





