
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

	
	$uid = getIdOfUser($_SESSION['username'],$db);
	
	echo "<div style=\"text-align: center;\">";
	if(isset($_GET['lv'])){
		if($uid == getDataRaw("ownerid","classes","classid='{$_GET['lv']}'",$db)){
			
			
			mysqli_query($db,"DELETE FROM joinedclasses WHERE classid='{$_GET['lv']}'");
			mysqli_query($db,"DELETE FROM classes WHERE classid='{$_GET['lv']}'");
			
		header("Location: /school");
			}
		else{
		mysqli_query($db,"DELETE FROM joinedclasses WHERE userid='$uid' AND classid='{$_GET['lv']}'");
		header("Location: /school");
	}}
	if(isset($_POST['cid'])){
		//echo getDataRaw("count(1)","joinedclasses","userid='$uid' AND classid='{$_POST['cid']}'",$db);
		if(getDataRaw("count(1)","joinedclasses","userid='$uid' AND classid='{$_POST['cid']}'",$db) ==  0){
			
			if(getDataRaw("count(1)","classes","ownerid='$uid' AND classid='{$_POST['cid']}'",$db) ==  0){
			
		mysqli_query($db,"INSERT INTO joinedclasses (userid,classid) VALUES ($uid,{$_POST['cid']})");
		
		header("Location: /school");
		//echo $_POST['cid'];
	}else{
		
		echo "You are the owner of the class {$_POST['cid']}.";
	}
	}else{
		
		echo "You are already in the class {$_POST['cid']}. <a href=?lv={$_POST['cid']}>Leave</a>";
		}
	}
	echo "<br></div>";
	
	if(isset($_GET['c'])){
		$cid = $_GET['c'];
	echo '<div class="main-school" >';
	
	$resin1 = mysqli_query($db,"SELECT name,ownerid FROM classes WHERE classid = '$cid'");
	$rowin1 = mysqli_fetch_array($resin1, MYSQLI_ASSOC);
	echo "<p style=\"color: white; font-size: 230%;\">- {$rowin1['name']}</p><br>";
	$oname = getNameOfUser($rowin1['ownerid'],$db);
	$opic= getPicOfUser($rowin1['ownerid'],$db);
	echo "<img class=\"ppic\" width=\"50\" src=\"/uploads/ppictures/$opic\"><p style=\"position: relative; left: 60px; color: white; font-size: 130%;\">$oname</p>";
	echo "<br><p style=\"float: right; color: white; font-size: 80%;\">Class Code: {$_GET['c']} -</p>";
	echo '</div><br>';
	
	echo '<div class="school" >';
	
	if($oname == $_SESSION['username']){
	echo "<a href=\"assign.php?c=$cid\" style=\"width: 25%; margin: auto; padding: 15px 15px; text-align: center;\" class=\"btn\">Assign an Homework<br></a><br>";echo "<a href=\"checkassignments.php?c=$cid\" style=\"width: 25%; padding: 15px 15px; margin: auto; text-align: center;\" class=\"btn\">Check Assigned Homeworks<br></a><br>";
	echo "<a href=\"?lv=$cid\" style=\"position: relative; top: 200px; right: 55px;\">Delete Class</a>";
	}else{
		echo "<a href=\"assigned.php?c=$cid\" style=\"width: 25%; padding: 15px 15px; margin: auto;  text-align: center;\" class=\"btn\">My Assigned Homeworks<br></a><br>";
		echo "<a href=\"completed.php?c=$cid\" style=\"width: 25%; padding: 15px 15px; margin: auto;  text-align: center;\" class=\"btn\">My Completed Homeworks<br></a><br>";
		
	}	
	
	echo "</div>";
}else{
	
	
	echo '<div class="school" >';
	echo "<button style=\"width: 25%;  text-align: center;\" class=\"btn btn-school\" id=\"createclass\">Create A Class<br></button><br>";
	echo "<p>- OR -</p><form method=\"post\">
		<input type=\"text\" name=\"cid\">
		<input type=\"submit\" class=\"btncmt\" value=\"Join a Class\">";
	echo "</form></div>";
	?>
	
	
<!-- The Modal -->
<div id="classcreate" class="modal-s">

  <!-- Modal content -->
  <div class="modal-content-s">
    <span class="close-s">&times;</span>
    <h2>Create a class</h2><br>
    <p>By creating a class, you can share homeworks and materials with your students.</p><br>
    
    <form action="createclass.php" method="post">
    <input type="text" name="classname" placeholder="class name">
    <input type="submit" value="Create Class" class="btncmt btn-school">
    
    </form>
  </div>

</div>
	
	<br><br><div style="text-align: center;"><hr>
	<h2>My Classes</h2>
	</div><div style="text-align: center;">
	<?php
	
$result = mysqli_query($db,"SELECT name,classid FROM classes WHERE ownerid = '$uid'");
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	
	echo "<a class=\"classname_o\" href=\"?c={$row['classid']}\"><div class=\"responsive\"><div class=\"rin\">".$row['name']."</div></div></a>";
	
	}


$result = mysqli_query($db,"SELECT classid FROM joinedclasses WHERE userid = '$uid'");
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	$resin1 = mysqli_query($db,"SELECT name,ownerid FROM classes WHERE classid = '{$row['classid']}'");
	$rowin1 = mysqli_fetch_array($resin1, MYSQLI_ASSOC);
	$oname = getNameOfUser($rowin1['ownerid'],$db);
	echo "<a class=\"classname\" href=\"?c={$row['classid']}\"><div class=\"responsive\"><div class=\"rin\">".$rowin1['name']."<br><small><small>$oname</small></small></div></div></a>";
	
	}  
	
	echo "</div>";
	
	
}
	
	echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
	include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>
<script>

// Get the modal
var modal = document.getElementById("classcreate");

// Get the button that opens the modal
var btn = document.getElementById("createclass");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close-s")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</body>
</html>
