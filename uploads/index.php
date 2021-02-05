<?php
$lcpath = $_SERVER['DOCUMENT_ROOT'];
$lcpath .= "/login-check.php";
$disableloading = true;
include($lcpath);

if(isset($_GET['reply'])){
	$reply = "&reply=".$_GET['reply'];
}else{
	$reply = "";
}
?>

<!DOCTYPE html>
<html>
 <title>ReturnNull Home - The Best Social Media Platform</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://kit.fontawesome.com/50b8436ee1.js" crossorigin="anonymous"></script>

<body>
<?php $ulpath = $_SERVER['DOCUMENT_ROOT']; $ulpath .= "/topbar.php";$act=2; include($ulpath); ?>
<link rel="stylesheet" type="text/css" href="../style.css">

<div class="header">
	<h1>Create a Post</h1>
	<h2>
	<?php if (!isset($_GET['posttype'])): ?>
	Select Post Type
	<?php endif; ?>
	
	<?php if ($_GET['posttype'] == 1): ?>
	Create a Text Post
	<?php endif; ?>
	
	<?php if ($_GET['posttype'] == 2): ?>
	Create an Image Post
	<?php endif; ?>
	
	</h2>
</div>
<br><br><br><br>


<?php if (!isset($_GET['posttype'])): ?>
<div class="selection" style="display: flex; justify-content: space-around;">
<a href="?posttype=1<?php echo $reply; ?>" ><img class="posttypeselect" src="/uploads/post.png" width=200 style="border-radius: 10px;"></a>
<a href="?posttype=2<?php echo $reply; ?>" ><img class="posttypeselect" src="/uploads/img.png" width=200 style="border-radius: 10px;"></a>
</div>
<?php endif; ?>

<?php if ($_GET['posttype'] == 1): ?>

<div class="content-text">
<form name="text" action="textUpload.php" method="POST" enctype="multipart/form-data">
<div class="input-group" style="text-align:center;">

<p>Title: </p>
<input type="text" name="desc" id="desc" style="width: 50%;">
<br><br>
<p>Content (optional): </p>
 <textarea id="text" name="text" style="width: 50%;"></textarea>
 <?php if(isset($_GET['reply'])):?>
 <input type="hidden" value="<?php echo $_GET['reply']; ?>" name="reply">
 <?php endif; ?>
<br> <br> <br>


<button type="submit" class="btncmt"><i class="fa fa-cloud-upload"></i> Post</button>
<br> <br> <br> <br>



</div>
</form>


<div class="input-group">


<br><br> <br><br> <br><br> <br>
<br> <br>
</div>
</div>


<?php endif; ?>
<?php if ($_GET['posttype'] == 2): ?>
<div class="content">
<form name="upload" action="fileUpload.php" method="POST" enctype="multipart/form-data">
<div class="input-group" style="text-align:center;">

<label style="width: 30%; margin: auto; text-align: center;" for="file-upload" class="custom-file-upload btncmt" style="text-align:center;">
    <i class="fas fa-images"></i> Select Image
</label>
 <input id="file-upload" type="file" name="image" size="60">
<br><br>
<p>Description: </p>
<input type="text" name="desc" id="desc" style="width: 50%;">
<br> <br> <br>


<button type="submit" class="btncmt"><i class="fa fa-cloud-upload"></i> Upload</button>
<br> <br> <br> <br>



</div>
</form>


<div class="input-group">


<br><br> <br><br> <br><br> <br>
<br> <br>
</div>
</div>


<?php endif; ?>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</body>

</html>

