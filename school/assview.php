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

$classcode = $_GET['c'];


$uid = getIdOfUser($_SESSION['username'],$db);
  if($uid == getDataRaw("ownerid","classes","classid='$classcode'",$db)){
			

$result = mysqli_query($db,"SELECT assignmentid,description,date FROM assignments WHERE class='$classcode' AND assignmentid='{$_GET['a']}' ORDER BY date DESC");
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
echo "<div class=\"header\"><h1>Given: {$row['date']}</h1></div>";
		

echo "<div style=\"width:90%; position: relative; left: 5%; border-radius:5%; height:100%; background:#fff; overflow-wrap: break-word;\">{$row['description']}";

echo "<br><br>";


echo "<div style=\"text-align: center;\"><button class=\"btn\" onclick=\"myFunction()\">RESULTS</button></div>";
echo "<br>";

 $result_cnt = mysqli_query($db,"SELECT count(1) FROM homeworks WHERE assignmentid='{$_GET['a']}'");
 
  $result_cntt = mysqli_query($db,"SELECT count(1) FROM joinedclasses WHERE classid = '$classcode'");
  $cntt = mysqli_fetch_array($result_cntt)[0];
	  $cnt = mysqli_fetch_array($result_cnt)[0];
	  
	  echo "<p>DELIVERED: <b>$cnt</b></p>";
	  $cnt = $cntt - $cnt;
	  echo "<p style=\"color: #FF0000;\">NOT DELIVERED: <b>$cnt</b></p>";
  $result = mysqli_query($db,"SELECT userid FROM joinedclasses WHERE classid = '$classcode'");
  
    echo "<div id=\"myDIV\">";
    echo "<b><div class=\"unmtable\" >";
    echo "<p>- USERNAME</p>";
    echo "<p>DATE -</p>";
    echo "</div></b>";
    
    
	 
    
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	  
	  
	  
	  echo "<div class=\"unmtable\" >";
      $uidcurr = $row['userid'];
      $unm = getNameOfUser($uidcurr,$db);
	  $result_hw = mysqli_query($db,"SELECT date,filename FROM homeworks WHERE userid = '$uidcurr' AND assignmentid='{$_GET['a']}'");
	  
	  $row_hw = mysqli_fetch_array($result_hw, MYSQLI_ASSOC);
	  
	  if(isset($row_hw['date'])){
		  
		  
      echo "<a href=\"uploads/{$row_hw['filename']}\" download>- $unm</a>";
	  
	  echo "<p>{$row_hw['date']} -</p>";
	  
	  }else{
		  
		  echo "<p>- ".$unm."</p>";
		  echo "<p style=\"color: #C41919;\"><b>NOT DELIVERED -</b></p>";
	  }
      echo "</div>";
}
echo "</div>";

echo "</div>";


}else{
	
	header("Location: /school");
	
	}

?>



  


<?php
echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
?>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</body>
<script>
function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>

</html>
