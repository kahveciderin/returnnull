<link rel="icon" href="/icon.png">
 <link rel="stylesheet" href="/style.css"/>
<link rel="stylesheet" href="/scripts/abb/adblock-checker.css" />
<?php

if(!$disableloading){
	
echo "<div id=\"loading-cover\" class=\"loadback\"><img style=\"position: relative; top: 25%; display: block; margin: auto auto;\" src=\"/loading_new.gif\"><noscript><br><br><br><br><br><br><br><p style=\"text-align: center; display:block; \">ReturnNull.xyz won't function properly without JavaScript.
<br>Please enable JavaScript.<br><br>Don't know how to do that? <a target=\"_blank\" href=\"https://www.whatismybrowser.com/guides/how-to-enable-javascript/auto\">Click here!</a></p></noscript></div>";

echo '<script>
$(window).on("load",function(){
     
var loading = document.getElementById("loading-cover");
loading.style.opacity = "0";

loading.style.visibility = "hidden";
});

window.addEventListener("beforeunload", function(event) {
     var loading = document.getElementById("loading-cover");
loading.style.opacity = "100";

loading.style.visibility = "visible";
});

</script>';


}
?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-157909641-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-157909641-1');
</script>

<?php
error_reporting(0);
echo "<link rel=\"icon\" href=\"/favicon.ico\">";


include $_SERVER['DOCUMENT_ROOT'] . '/db.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/like.php';
session_start();
$active = 0;

if(isset($act)){
$active = $act;
}





//check if https being used regardless of certificate
function shapeSpace_check_https() { 
    if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
        return true; 
    }
    return false;
}


for ($x=0; $x<1; $x++) {
    //if https:// && www.
    if ( shapeSpace_check_https() && substr($_SERVER['HTTP_HOST'], 0, 4) === 'www.'){
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: http://' . substr($_SERVER['HTTP_HOST'], 4).$_SERVER['REQUEST_URI']);
            exit;
            break;
    //if only www.
    } elseif (substr($_SERVER['HTTP_HOST'], 0, 4) === 'www.') {
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: http://' . substr($_SERVER['HTTP_HOST'], 4).$_SERVER['REQUEST_URI']);
            exit;
            break;
    //if only https://
    } elseif ( shapeSpace_check_https() ) {
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
            exit;
            break;
    }
}










echo "<ul class=\"navbar\">";
//echo "<li><a href=\"/index.php\"><img src=\"/icon.png\" width=\"30\"></a></li>" ;
if (isset($_SESSION['username'])){
$unasdasd = $_SESSION['username'];
$uidasdasd = getIdOfUser($unasdasd,$db);
echo "<li class=\"top\"><a ";	/*if($active == 1){	echo " class=\"active\" ";	}*/echo "href=\"/\"><img alt=\"ReturnNull.xyz Icon\" src=\"/icon.png\" width=\"30\"></a></li>";
//echo "<li><a ";	if($active == 2){	echo " class=\"active\" ";	}echo "href=\"/uploads/\">Post!</a></li>";

$resultasdasd = mysqli_query($db,"SELECT profilepic FROM users WHERE username='$unasdasd'");
while ($rowas = mysqli_fetch_array($resultasdasd, MYSQLI_ASSOC)) {
	$ppiccurruser = $rowas['profilepic'];
	}
	
	
	//<input type=\"text\" name=\"search\" id=\"search\" style=\"position:relative; left:3px; top:7px; width:40%;\" minlength = \"3\">  <input type=\"hidden\" name=\"in\" id=\"in\" value=\"1\"

//echo "<li class=\"top\"><a ";	if($active == 4){	echo " class=\"active\" ";	}echo "href=\"/search.php\">Search</a></li>";

echo "<li class=\"top\" style=\"float:right\"><a style = \"\"";	if($active == 3){	echo " class=\"active\" ";	}echo " href=\"/account/\"><img height=\"50\" alt=\"$unasdasd profile picture\" width=\"50\" class=\"cppic\" src=\"/uploads/ppictures/$ppiccurruser\"></a></li>";
	
	
	//$notifcount = getTotalNotifs($uidasdasd,$db);
	//if($notifcount != 0)
	//echo "<div class=\"badge\">$notifcount</div>";
	
	
	
  
  
  if($active != -1){
	  
	  if($active != 2 && $active != 7 && $active != 100){
echo "<form action=\"";

if($active != 6){
echo "/uploads";}else{echo "/blogs/createblog.php";}
echo "\">
         <button class=\"postbutton\" type=\"submit\" ><img alt=\"post\" style=\"filter:invert(100%);\" width=\"40\" height=\"40\" src=\"/post_icon.png\"></button>
      </form>";
  }

}
}else{
	
echo "<li class=\"top\"><a ";	if($active == 1){	echo " class=\"active\" ";	}echo "href=\"/\"><img alt=\"Returnnull icon\" src=\"/icon.png\" width=\"30\"></a></li>";
	echo "<li class=\"top\" style=\"float:right\"><a href=\"/registration/login.php\">Login</a></li>";
}
echo "</ul>";
if($active != -1){
  echo "<ul class=\"navbbar\">
  <li class=\"botl\"><a"; if($active == 1){	echo " class=\"active\" ";	} echo " href=\"/\"><img alt=\"Home\" style=\"filter:invert("; if($active != 1){	echo "10";	} echo "0%);\" src=\"/home.png\" width=\"30\"></a></li>";
  echo "<li style=\"left:33%\" class=\"botm\"><a"; if($active == 4){	echo " class=\"active\" ";	} echo " href=\"/search.php\"><img alt=\"Search\" style=\"filter:invert("; if($active != 4){	echo "10";	} echo "0%);\" src=\"/search.png\" width=\"30\"></a></li>";
  
  if(getDataRaw("count(1)","joinedclasses","userid='$uidasdasd'",$db) != 0 || getDataRaw("count(1)","classes","ownerid='$uidasdasd'",$db) != 0){
  echo "<li class=\"botm\"><a"; if($active == 100){	echo " class=\"active\" ";	} echo " href=\"/school\"><img alt=\"School\" style=\"filter:invert("; if($active != 100){	echo "10";	} echo "0%);\" src=\"/school.png\" width=\"30\"></a></li>";
}
  
  echo "<li class=\"botr\"><a"; if($active == 5){	echo " class=\"active\" ";	} echo " href=\"/notifications\"><img alt=\"Notifications\" style=\"filter:invert("; if($active != 5){	echo "10";	} echo "0%);\" src=\"/bell.png\" width=\"30\"></a></li>";
  
  echo "<li style=\"right:33%\" class=\"botm\"><a"; if($active == 6 || $active == 7){	echo " class=\"active\" ";	} echo " href=\"/blogs\"><img alt=\"Blogs\" style=\"filter:invert("; if($active != 6 && $active != 7){	echo "10";	} echo "0%);\" src=\"/blog.png\" width=\"30\"></a></li>";
  
  $notifcount = getTotalNotifs($uidasdasd,$db);
	if($notifcount != 0)
	echo "<div class=\"badge\"><small>$notifcount</small></div>";
	
echo "</ul>";
}

echo "
 <br><br> <br>";


?>
   <div id="wrapfabtest">
    <div class="adBanner">
    </div>
</div>


  <script>
  /* When the user scrolls down, hide the navbar. When the user scrolls up, show the navbar */
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementsByClassName("navbar")[0].style.top = "0";
  } else {
    document.getElementsByClassName("navbar")[0].style.top = "-50px";
  }
  prevScrollpos = currentScrollPos;
} 
//var modal = document.getElementById("adblockPopup");


$(document).ready(function(){
    if($("#wrapfabtest").height() > 0) {
        
    } else {

//modal.style.display = "block";
        
    }
});



  </script>
  
