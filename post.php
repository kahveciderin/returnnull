<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ReturnNull Home - The Best Social Media Platform</title>
  
<meta name="description" content="The best social media platform! Join us and have fun sharing your photos with members all around the world!">
  <link rel="stylesheet" href="/style.css"/>
  <link rel="stylesheet" href="style.css"/>
  <link rel="stylesheet" href="modal.css"/>
<script src="/scripts/jquery.min.js"></script>
<script src="/scripts/jquery.lazyload.js"></script>
<script data-ad-client="ca-pub-1915189298630638" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

</head><body>

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


<?php
include 'db.php';
	include_once 'like.php';
	$act=1; include('topbar.php');
	
$back = 1;
$request = "SELECT * FROM posts WHERE deleted=0 AND postid={$_GET['post']} ORDER BY date DESC";
include('showposts.php');
unset($request);
$disableshare = 1;
unset($back);
$reply = $_GET['post'];
if(isset($_POST['togglelike'])){
		if(isset($_SESSION['username'])){
			toggleLike($_POST['togglelike'],getIdOfUser($_SESSION['username'],$db),$db);
		}
		}
echo "<br>";

echo "<a style=\"margin: 0 auto; text-align: center; display: block; width: 25%;\" class=\"btn\" href=\"/uploads?reply=$reply\">Add new comment</a>";
echo "<br><br>";
include('showposts.php');
?>
 
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
<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</body>
</html>
