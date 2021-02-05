<?php
$ulpath = $_SERVER['DOCUMENT_ROOT'];
include $ulpath.'/db.php';
include_once $ulpath.'/like.php';
$id = $_GET['id'];
session_start();
if($id == getIdOfUser($_SESSION['username'],$db)){
	header('Location: /account');
	exit;
}
?>
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

<script type="text/javascript" charset="utf-8">
	
	function postClick(event, element, postid) {
  if (event.target != element) {
    event.stopPropagation();
    return;
  }
  window.location.href = "/post.php?post="+postid;
}
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

<div id="allcontainer">
<?php  $ulpath .= "/topbar.php";$act=1; include($ulpath); ?>

<?php





		if(isset($_POST['togglelike'])){
		if(isset($_SESSION['username'])){
			toggleLike($_POST['togglelike'],getIdOfUser($_SESSION['username'],$db),$db);
		}
		}
$unforthis = mysqli_query($db,"SELECT username, profilepic, datejoined FROM users WHERE id='$id'");
   $fun = array();
   $unrow = mysqli_fetch_array($unforthis, MYSQLI_ASSOC);
	$fun[] = $unrow;
	$un = $fun[0]['username'];
	$up = $fun[0]['profilepic'];
	$ujd = $fun[0]['datejoined'];
	
	
	echo "<img src=\"/uploads/ppictures/$up\" width=\"200\"
	height=\"200\" class=\"profpage-ppic\">";
	echo "<br> <br>";
	echo "<p class=\"profpage-uname\">$un</p>";
	echo "<br>";
	echo "<small><small style=\"margin-top: 10%; margin-right: 20px; float: right;\" > Joined: $ujd <br><br><button onclick=\"blockthis();\" class=\"";
	
	if(isBlocked($id,getIdOfUser($_SESSION['username'],$db),$db)) echo "btncmt\" style=\"float: right;\">Unblock";
	else echo "blockbtn\" style=\"float: right;\">Block";
	echo "</button></small></small>";
?>
<!--<br><br><br><br><div style="text-align: center; "><p style="font-size:200%;">Posts:</p></div>--> <br><br><br><br><br><br><br><br><br>
<?php 
$request = "SELECT postid,imagename,description,userid,posttype,date FROM posts WHERE deleted=0 AND userid='$id' ORDER BY date DESC";include '../../showposts.php';?>

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

function blockthis(){
	var xhr = new XMLHttpRequest();
	xhr.open('GET', '/block.php?b=<?php echo $id ?>');
	xhr.onreadystatechange = function() {
	if(xhr.readyState === XMLHttpRequest.DONE) {
		location.reload(); 
	}};
	xhr.send();
}
</script>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</body>
</html>
