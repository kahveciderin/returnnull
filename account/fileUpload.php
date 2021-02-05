<?php ini_set('upload_max_filesize', "2M"); error_reporting(0); session_start(); ?>



<?php
$lcpath = $_SERVER['DOCUMENT_ROOT'];
$lcpath .= "/login-check.php";
include($lcpath);
?>
<html>


<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>


<body>

<?php $disableloading = true;  $ulpath = $_SERVER['DOCUMENT_ROOT']; $ulpath .= "/topbar.php";$act=3; include($ulpath); ?>



<div class="header">
	<h2>Account Settings</h2>
</div>


<div class="content">


<h3>

<p><strong>



<?php
session_start(); 
include("../db.php");
$uploaddir = '../uploads/ppictures/';

$filename = uniqid("ppic_".date("Y-m-d-H-m-s")."_"). ".jpg";


$uploadfile = $uploaddir . $filename ;
 
 if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile))
 { 

$file = $uploadfile;
$image = imagecreatefromstring(file_get_contents($file));
ob_start();
imagejpeg($image,NULL,100);
$cont = ob_get_contents();
ob_end_clean();
imagedestroy($image);
$content = imagecreatefromstring($cont);
$output = "$uploadfile.webp";
imagewebp($content,$output);
imagedestroy($content);

$wfname = "$filename.webp";

$unamee = $_SESSION['username'];
$query = "UPDATE users SET profilepic = '$wfname' WHERE username = '$unamee'";	 
mysqli_query($db, $query);
echo "Image succesfully uploaded.";
echo "<img src=\"../uploads/ok.png\" width=\"200\" height=\"200\" class=\"center\">";

 
 } else { 
	 
	 
echo "Image uploading failed."; 


} ?> 



</strong>
</p>

</h3>

</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</html>
