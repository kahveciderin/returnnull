
<?php
$allcount_query = "SELECT count(*) as allcount FROM posts";
$allcount_result = mysqli_query($con,$allcount_query);
$allcount_fetch = mysqli_fetch_array($allcount_result);
$allcount = $allcount_fetch['allcount'];
?>
<!DOCTYPE HTML>
<html lang="en" xml:lang="en">
<head>
	<meta name="propeller" content="559dadafbd1e73e809ba98ed62544510">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ReturnNull Home - The Best Social Media Platform</title>
  
<meta name="description" content="The best social media platform! Join us and have fun sharing your photos with members all around the world!">
  <link rel="stylesheet" href="/style.css"/>
  <link rel="stylesheet" href="style.css"/>
  <link rel="stylesheet" href="modal.css"/>
<script src="/scripts/jquery.min.js"></script>
<script src="/scripts/jquery.lazyload.js"></script>
<script data-ad-client="ca-pub-1915189298630638" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body>
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

</div>
<?php 
	
	include 'db.php';
	include_once 'like.php';
	$act=1; include('topbar.php');
	if(isset($_GET['logout'])){
		session_destroy();
		setcookie("uname", "", time() - 3600);
		setcookie("pwd", "", time() - 3600);
		header('Location: /');
		}
		if(isset($_POST['togglelike'])){
		if(isset($_SESSION['username'])){
			toggleLike($_POST['togglelike'],getIdOfUser($_SESSION['username'],$db),$db);
		}
		}
		
		if(isset($_COOKIE['uname']) && !isset($_SESSION['username'])){
			header('Location: /registration/login.php');
			}
			
		if(getTchrOfUser(getIdOfUser($_SESSION['username'],$db),$db) == 1){
			header('Location: /school');
		}
			$adcounter = 0;
	 ?>
<div id="posts"></div>
            <h1 style="text-align: center;" class="load-more">Load More</h1>
            <input type="hidden" id="row" value="0">
            <input type="hidden" id="all" value="<?php echo $allcount; ?>">
            <script>$(document).ready(function(){
  $(".load-more").click(function(){
    $.get("/getthreeposts.php?row=3", function(data, status){
		document.getElementById("posts").innerHTML += data;
    });
  });
});
</script>

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
<br><br>
</body>
