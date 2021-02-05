
<!DOCTYPE html>
<html>
	
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	
	<title>User Profile</title>
	<link rel="stylesheet" type="text/css" href="/style.css">
		<link rel="stylesheet" href="/modal.css"/>
<script src="/scripts/jquery.min.js"></script>
<script src="/scripts/jquery.lazyload.js"></script>
</head>
<body>
	<div id="allcontainer">
<script type="text/javascript" charset="utf-8">
    // Get the modal


function initmodal(mid){
	
	var myImg = "myImg";
	var myModal = "myModal";
	var img = "img";
	var caption = "caption";
	var close = "close";
document.getElementById(myImg.concat(mid)).onclick = function(){
  document.getElementById(myModal.concat(mid)).style.display = "block";
  document.getElementById(img.concat(mid)).src = this.dataset.original;
	$( "#allcontainer" ).toggleClass("noscroll");
  //document.getElementById(img.concat(mid)).dataset.original = this.dataset.original;
  document.getElementById(caption.concat(mid)).innerHTML = this.alt;
}


// When the user clicks on <span> (x), close the modal
document.getElementById(close.concat(mid)).onclick = function() {
	document.getElementById(myModal.concat(mid)).style.display = "none";
	
	$( "#allcontainer" ).toggleClass("noscroll");
}

}
</script>

<div id="783280483">

    <script type="text/javascript">

        try {

            window._mNHandle.queue.push(function (){

                window._mNDetails.loadTag("783280483", "300x250", "783280483");

            });

        }

        catch (error) {}

    </script>


<div class="content">
<?php $ulpath = $_SERVER['DOCUMENT_ROOT']; $ulpath .= "/topbar.php";$act=3; include($ulpath); ?>

<?php
include '../db.php';
$unasdasd = $_SESSION['username'];


$resultasdasd = mysqli_query($db,"SELECT id FROM users WHERE username='$unasdasd'");
while ($rowas = mysqli_fetch_array($resultasdasd, MYSQLI_ASSOC)) {
	$uidcurruser = $rowas['id'];
	}

$id = $uidcurruser;
$unforthis = mysqli_query($db,"SELECT username, profilepic, datejoined FROM users WHERE id='$id'");
   $fun = array();
   $unrow = mysqli_fetch_array($unforthis, MYSQLI_ASSOC);
	$fun[] = $unrow;
	$un = $fun[0]['username'];
	$up = $fun[0]['profilepic'];
	$ujd = $fun[0]['datejoined'];
	
	echo "<div align=\"center\">";
	echo "<img src=\"/uploads/ppictures/$up\" width=\"100\" height=\"100\" align:\"center\" style=\"border:5px solid #4CAF50\">";
	echo "<br><a href=\"ppicture.php\" class=\"btn\">Change</a>";
	echo "<br> <br>";
	echo "<p style=\"
  background-color: #3897f0;
  border: 1px solid #3897f0;
  color: #fff;
  font-weight: bold;\">$un</p>";
//  echo "<br><br><a href=\"/notifications\" class=\"btn\">Notifications</a>";
	echo "</div>";
	echo "<br>";
	echo "<small><small style=\"float: right;\" > Joined: $ujd <br><br><a href=\"../index.php?logout='1'\" style=\"color: red; float: right;\" >logout</a> </small></small>";
?>

<?php $request = "SELECT * WHERE deleted=0 AND userid='$id' ORDER BY date DESC"; include '../showposts.php';?>

</div>
<script type="text/javascript" charset="utf-8">
    $(function () {
        $("img.lazy").lazyload();
    });
    
    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}


function showLikes(namid) {
	var wl = 'wholiked';
	
  var x = document.getElementById(wl.concat(namid));
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}


function showComments(namid) {
	var wl = 'cmts';
	
  var x = document.getElementsByName(wl.concat(namid))[0];
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>

</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>

</body>
</html>
