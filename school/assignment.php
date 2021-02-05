<!DOCTYPE HTML>
<html lang="en" xml:lang="en">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School</title>
  
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
	$act=100; include('../topbar.php');
	include('../login-check.php');
	 ?>
<?php
$result = mysqli_query($db,"SELECT assignmentid,description,file,date FROM assignments WHERE assignmentid='{$_GET['a']}' ORDER BY date DESC");
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
echo "<div class=\"header\"><h1>Given: {$row['date']}</h1></div>";
		

echo "<br><div style=\"width:90%; position: relative; left: 5%; border-radius:5px; height:100%; background:#fff; overflow-wrap: break-word;\">{$row['description']}";


if($row['file'] != ""){
	
echo "<br><br>File:";
echo "<br><a href=\"uploads/{$row['file']}\" download>Download File</a>";
}
echo "<br><br>";

if(isCompletedHw(getIdOfUser($_SESSION['username'],$db),$row['assignmentid'],$db) != 1){
echo "<div style=\"text-align: center;\"><a href=\"addhw.php?a={$row['assignmentid']}\" class=\"btn\">Upload Homework</a></div>";
}else{

echo "<div style=\"text-align: center;\"><a href=\"delhw.php?a={$row['assignmentid']}\" class=\"btn\">Delete My Homework</a></div>";

echo "<br><br>";

$fname = "/school/uploads/". getDataRaw("filename","homeworks","assignmentid = '{$row['assignmentid']}' AND userid = '".getIdOfUser($_SESSION['username'],$db)."'",$db);


echo "<h3>My Homework:</h3><br>";
echo "<embed src=\"$fname\" style=\"max-height: 1000px; width: 100%;\" />";


//echo "<a href=\"$fname\" download>Download My Uploaded Homework</a>";

}
echo "<br></div>";
echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
?>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</body>


</html>
