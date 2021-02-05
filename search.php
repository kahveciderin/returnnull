<?php error_reporting(0);?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
	<title>Search - Returnnull</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
	
</head>
<?php $disableloading = true; $ulpath = $_SERVER['DOCUMENT_ROOT']; $ulpath .= "/topbar.php";$act=4; include($ulpath); ?>

<?php
$search = "";
if(isset($_GET['search'])){ $search=$_GET['search'];}
$in = "";
if(isset($_GET['in'])){ $in=$_GET['in'];}


?>
<body>
	<div class="lheader">
<form action="/search.php" method="get">
<input type="text" name="search" id="search" style="position:relative; left:5px;" value="<?php echo $search;?>">


    <label class="radio-inline">
      <input type="radio" name="in" value="1" <?php if($in==1 || empty($search))echo "checked";?>>Posts
    </label>
    <label class="radio-inline">
      <input type="radio" name="in" value="2" <?php if($in==2)echo "checked";?>>Users
    </label>
    <label class="radio-inline">
      <input type="radio" name="in" value="3" <?php if($in==3)echo "checked";?>>Comments
    </label>
    
    <input type="submit" value="Search">
</form>
</div>


<?php
include 'db.php';
$asd =  preg_replace("/[*<>]/", "", $search);
if(!empty($search)){
echo "Searching for <b>$asd</b> in ";
if($in==1)echo "posts:";
else if($in==2)echo "users:";
else if($in==3)echo "comments:";
}
?>


<div class="content">
<?php

$query = $search;
if($in==1){
$resultasdasd = mysqli_query($db,"SELECT description,postid FROM posts WHERE description LIKE '%$query%' ORDER BY date DESC");
while ($rowas = mysqli_fetch_array($resultasdasd, MYSQLI_ASSOC)) {
	$entered[] = $rowas['description'];
	$pids[] = $rowas['postid'];
	
	foreach($entered as $index => $result) {
    echo "<a href=\"/#{$pids[$index]}\">$result </a><br>";
}
	}
}else if($in==2){
	
$resultasdasd = mysqli_query($db,"SELECT username,id FROM users WHERE username LIKE '%$query%' ORDER BY datejoined DESC");
while ($rowas = mysqli_fetch_array($resultasdasd, MYSQLI_ASSOC)) {
	$entered[] = $rowas['username'];
	$pids[] = $rowas['id'];
	}
	
	foreach($entered as $index => $result) {
   // echo $result;
    
    echo "<a href=\"/account/pages/?id={$pids[$index]}\">$result </a><br>";
}
}else if($in==3){
	
	
$resultasdasd = mysqli_query($db,"SELECT body,postid FROM comments WHERE body LIKE '%$query%' ORDER BY date DESC");
while ($rowas = mysqli_fetch_array($resultasdasd, MYSQLI_ASSOC)) {
	$entered[] = $rowas['body'];
	$pids[] = $rowas['postid'];
	}
	
	foreach($entered as $index => $result) {
   // echo $result;
    
    echo "<a href=\"/#{$pids[$index]}\">$result </a><br>";
}
	
	
}
	?>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</body>
</html>
