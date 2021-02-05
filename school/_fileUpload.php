
 
<?php //error_reporting(0);
session_start(); ?>
ini_set('upload_max_filesize', "2M");
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
	<title>School</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>

<?php $ulpath = $_SERVER['DOCUMENT_ROOT']; $ulpath .= "/topbar.php";$act=100; include($ulpath); ?>


<div class="header">
</div>


<div class="content">


<h3>

<p><strong>



<?php
session_start(); 
include '../db.php';

//$desc = preg_replace("/[^a-zA-Z0-9 ]+/", "", $_POST['desc'] );
$desc = $_POST['desc'];
$uploaddir = 'uploads/';

$uploadfile = $uploaddir . $filename ;
 
$name = $_FILES["file"]["name"];
$ext = end((explode(".", $name)));

$filename = uniqid("post_".date("Y-m-d-H-m-s")."_"). ".$ext";


 if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile))
 { 

$unsaa = $_SESSION['username'];

$result = mysqli_query($db,"SELECT id FROM users WHERE username='$unsaa'");


$userid = mysqli_fetch_array($result);

$unamee = $userid[0];









$query = "INSERT INTO homeworks (imagename, description, userid) VALUES ('$wfname', '$desc',  '$unamee')";	 
mysqli_query($db, $query);


$posidres = mysqli_query($db,"SELECT postid FROM posts WHERE imagename='$wfname' AND userid='$unamee'");
$postidn= mysqli_fetch_array($posidres);



$pidd = $postidn[0];
$content = $desc;
include '../mention_check.php';




unlink($uploadfile);
echo "Image succesfully uploaded.";
echo "<img src=\"ok.png\" width=\"200\" height=\"200\" class=\"center\">";

 
 if(!file_exists("uploads/$wfname")){
	 $query = "DELETE FROM posts WHERE imagename='$wfname'";	 
	mysqli_query($db, $query);
 }
 } else { 
	 
	 
echo "Image uploading failed."; 


} ?> 



</strong>
</p>

</h3>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</html>
