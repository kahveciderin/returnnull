<?php error_reporting(0); session_start();


 ?>
 
 
<?php
$lcpath = $_SERVER['DOCUMENT_ROOT'];
$lcpath .= "/login-check.php";
include($lcpath);
?>


<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<div class="header">
	<h2>Account Settings</h2>
</div><link rel="stylesheet" type="text/css" href="../style.css">

<?php $ulpath = $_SERVER['DOCUMENT_ROOT']; $ulpath .= "/topbar.php";$act=3; include($ulpath); ?>

<div class="content">
<?php
$unasdasd = $_SESSION['username'];
$resultasdasd = mysqli_query($db,"SELECT profilepic FROM users WHERE username='$unasdasd'");
while ($rowas = mysqli_fetch_array($resultasdasd, MYSQLI_ASSOC)) {
	$ppiccurruser = $rowas['profilepic'];
	}
	echo "<img src=\"/uploads/ppictures/$ppiccurruser\" width=\"150\" height=\"150\">";

	?>
<form action="ppicture.php"> <input type="submit" value="Profile Picture" /> </form>

<br> <br> <br> <br>


</form>

<?php  if (isset($_SESSION['username'])) : ?>
    	
	<p class="center"> <a href="../index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>



</div>

</html>


