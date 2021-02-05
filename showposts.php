

<?php
echo '
		<script>

		function dropdown(postid) {
		
  var x = document.getElementById("dropdown-content-"+postid);

  x.classList.toggle("active-dropdown");
} 

function showEdit(postid){
var x = document.getElementById("desc-" + postid );
x.setAttribute("contenteditable", true);
var raw = document.getElementById("desc-raw-" + postid ).innerHTML;
var temp = x.innerHTML;
x.innerHTML = raw;
x.classList.add("active-editpart");
var xd = document.getElementById("dropdown-content-"+postid);
xd.classList.toggle("active-dropdown");
document.getElementById("editbtn-"+postid).classList.remove("savebtn-active");
}

function saveEdit(postid){
var loading = document.getElementById("loading-cover");
loading.style.opacity = 1;
loading.style.visibility = "visible";
var x = document.getElementById("desc-" + postid );
x.setAttribute("contenteditable", false);
x.classList.remove("active-editpart");
document.getElementById("editbtn-"+postid).classList.add("savebtn-active");
xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
if(xhr.readyState === XMLHttpRequest.DONE) {
loading.style.opacity = "0";

loading.style.visibility = "hidden";
}};
//xhr.open(\'GET\', \'/editpost.php?postid=\'+postid+\'&editeddata=\'+x.innerHTML);
xhr.open(\'GET\', \'/editpost.php?postid=\'+postid+\'&editeddata=\'+x.innerText);
xhr.send();
x.innerHTML = x.innerText;
document.getElementById("desc-raw-" + postid ).innerHTML = x.innerText;
}

function showModalReport(postid){
var x = document.getElementById("reportmodal-"+postid);
x.style.display = "block";
}

function hideModalReport(postid){
var x = document.getElementById("reportmodal-"+postid);
x.style.display = "none";
}



		</script>
		';
	error_reporting(0);
	
	if(!isset($reply)){
	 
	 $reply = '-1';
	 }
	if(!isset($request)){
	 
	 $request = "SELECT * FROM posts WHERE deleted=0 AND reply=$reply ORDER BY date DESC";
	 }
	session_start();
	include $_SERVER['DOCUMENT_ROOT'] . '/db.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/like.php';

	$result = mysqli_query($db,$request);
	echo "<br>";
	if($disableshare != 1){
	//	echo "<div id=\"borderpost\">";
	//echo '<div class="addthis_inline_share_toolbox"></div> ';
	
	//echo "</div>";
	}
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$adcounter += 1;
		
		if(!isBlocked($row['userid'],getIdOfUser($_SESSION['username'],$db),$db)){
		//print the post
		echo "<br><div id=\"{$row['postid']}\"><div id=\"borderpost\" onclick=\"postClick(event, this, {$row['postid']});\">";
		if(isset($_SESSION['username'])){
		echo "<div class=\"dropdown\" style=\"position: relative; right:0;\">";
		
		
		
		if($row['reply'] == -1){
		
		if(isset($back)){
		echo "<a href=\"/#{$row['postid']}\" ><div style=\"font-size: 30px; float: left;\" class=\"dropbtn\">\n&lt </div></a>";
		}
			
		}else{
			
			
			if(isset($back)){
		echo "<a href=\"/post.php?post={$row['reply']}\" ><div style=\"font-size: 30px; float: left;\" class=\"dropbtn\">\n&lt </div></a>";
		}
		}
			
			
		
		
		echo "<div style=\"font-size: 30px;\" class=\"dropbtn\" onclick=\"dropdown({$row['postid']})\">\n&#x2807 </div>";
		


		
			if($row['userid'] == getIdOfUser($_SESSION['username'],$db)){
			$retto = "$_SERVER[REQUEST_URI]";
			echo '
			<div class="dropdown-content" id="dropdown-content-'.$row['postid'].'">
			
			<a href="javascript:showEdit('.$row['postid'].');">Edit</a>
			<a href="/delete.php?d='.$row['postid'].'&r='.$retto.'&p='.$oldpost.'">Delete</a>
			</div></div>';
		}else{
			if(getDataRaw("count(1)","moderators","userid = ".getIdOfUser($_SESSION['username'],$db),$db) > 0){
				
			$retto = "$_SERVER[REQUEST_URI]";
					echo '
			<div class="dropdown-content" id="dropdown-content-'.$row['postid'].'">
			<a href="javascript:showModalReport('.$row['postid'].');">Report</a>
			
			<a href="javascript:blockUser'.$row['userid'].'();">Block User</a>
			<p style="text-align:center; color: black; padding: 0px 16px;"><hr>Mod Tools<hr></p>
			
			<a href="javascript:showEdit('.$row['postid'].');">Edit</a>
			<a href="/delete.php?d='.$row['postid'].'&r='.$retto.'&p='.$oldpost.'">Delete</a>
			</div></div>';
		}else{
			echo '
			<div class="dropdown-content" id="dropdown-content-'.$row['postid'].'">
			<a href="javascript:showModalReport('.$row['postid'].');">Report</a>
			<a href="javascript:blockUser'.$row['userid'].'();">Block User</a>
			</div></div>';
		}
	}
	
			echo '<script>
		function blockUser'.$row['userid'].'(){
	var xhr = new XMLHttpRequest();
	xhr.open(\'GET\', \'/block.php?b='.$row['userid'].'\');
	xhr.onreadystatechange = function() {
	if(xhr.readyState === XMLHttpRequest.DONE) {
	window.location.replace(\'/#'.$oldpost.'\');
	}};
	xhr.send();
}
		</script>';
		}
		
		
	
	
	
	
		echo '<div id="reportmodal-'.$row['postid'].'" class="modal-report">

  <!-- Modal content -->
  <div class="report-modal-content">
    <div class="modal-header">
      <span onclick="javascript:hideModalReport('.$row['postid'].');" class="close-rep">&times;</span>
      <h2 style="text-align: center;">Report</h2>
    </div>
    
   <form method="post" action="/report.php">
    <div class="modal-body">
    
      <input type="radio" name="repres" id="viol" value="Violence">
      <label for="viol">Violence</label><br>
      <input type="radio" name="repres" id="terr" value="Terrorism/violent extremism">
      <label for="terr">Terrorism/violent extremism</label><br>
      <input type="radio" name="repres" id="abse"  value="Abuse/harrasment">
      <label for="abse">Abuse/harassment</label><br>
      <input type="radio" name="repres" id="hatf"  value="Hateful conduct">
      <label for="hatf">Hateful conduct</label><br>
      <input type="radio" name="repres" id="scsh"  value="Promoting/emcouraging suicide or self-harm">
      <label for="scsh">Promoting/encouraging suicide or self-harm</label><br>
      <input type="radio" name="repres" id="nude"  value="Nudity">
      <label for="nude">Nudity</label><br>
      <input type="radio" name="repres" id="ileg"  value="Selling/buying illegal or certain regulated goods or services">
      <label for="ileg">Selling/buying illegal or certain regulated goods or services</label><br>
      <input type="radio" name="repres" id="prvt"  value="Posting private information">
      <label for="prvt">Posting private information</label><br>
      <input type="radio" name="repres" id="pstr"  value="Sharing photos that do not belong to the poster">
      <label for="pstr">Sharing photos that do not belong to the poster</label><br>
      <input type="radio" name="repres" id="spam"  value="Platform manipulation and spam">
      <label for="spam">Platform manipulation and spam</label><br>
      <input type="radio" name="repres" id="impr"  value="Impersonation">
      <label for="impr">Impersonation</label><br>
      <input type="radio" name="repres" id="manm"  value="Synthetic and manipulated media">
      <label for="manm">Synthetic and manipulated media</label><br>
      <input type="radio" name="repres" id="cprt"  value="Copyright and trademark">
      <label for="cprt">Copyright and trademark</label><br>
      <input type="radio" name="repres" id="othr"  checked="checked"  value="Other">
      <label for="othr">Other, please specify: </label><input name="reason" type="text"><br>	
    </div>
    <div class="modal-footer" >
      <button class="btncmt" style="position: relative; float: right;">Next ></button>
    </div>
    <input type="hidden" name="postid" value="'.$row['postid'].'">
    </form>
  </div>

</div>';
	
		echo "<a href=\"/account/pages/{$row['userid']}\"><img alt=\"".getNameOfUser($row['userid'],$db)."\" class=\"ppic lazy\" width=\"50\" src=\"/loading_new.gif\" data-original=\"/uploads/ppictures/".getPicOfUser($row['userid'],$db)."\"></a><br>";
		echo "<p style=\"position: relative; left: 60px;\"><b>".getNameOfUser($row['userid'],$db)."</b>  <small>{$row['date']}</small></p>";
		//if($row['userid'] == getIdOfUser($_SESSION['username'],$db)){
			//$retto = "$_SERVER[REQUEST_URI]";
		//echo "<small><small><a href=\"/delete.php?d={$row['postid']}&r=$retto&p=$oldpost\" style=\"color: red; float: right;\" >delete</a></small></small>";
	//}
		$content = $row['description'];
		//$content = preg_replace("/[*<>]/", "", $content);
		//$content =htmlspecialchars($content);
		$content = preg_replace('#<#','&lt;',$content);
		$content = preg_replace('#>#','&gt;',$content);
		echo "<br><div class=\"savebtn-active\"  id=\"desc-raw-";
		echo $row['postid'];
		echo "\">$content</div>";
		include 'mention.php';
		
		if($row['posttype'] == 1 && $row['imagename'] != ""){echo "<b>";}
		echo "<div class=\"desc-edit-area\" contenteditable=\"false\"  id=\"desc-";
		echo $row['postid'];
		
		
		echo "\"><p";
		
		if($row['posttype'] == 1 && $row['imagename'] != ""){
			echo " style=\"text-align: center;\" ";
		}
		echo ">$content</p></div><br>";
		if($row['posttype'] == 1 && $row['imagename'] != ""){echo "</b>";}
		echo "<button id=\"editbtn-{$row['postid']}\" onclick=\"saveEdit({$row['postid']});\" class=\"savebtn-active btncmt\" style=\"position: relative; right: 0; height: 30px; width: 80px;\">Update</button>";
		echo "<div id=\"postcontainer\" onclick=\"postClick(event, this, {$row['postid']});\">";
		
		if($row['posttype'] == 2){
		echo "<img id=\"myImg{$row['postid']}\" class=\"lazy shared\" alt=\"{$row['description']}\" src=\"/loading_new.gif\" width=\"300\" data-original=\"/uploads/uploads/{$row['imagename']}\" /><br>";
		
		}else if($row['posttype'] == 1){
			echo "<p>{$row['imagename']}</p><br><br>";
		}
		
		
		echo "	<div id=\"myModal{$row['postid']}\" class=\"modal\">
					<span class=\"close\" id=\"close{$row['postid']}\">&times;</span>
					<img alt=\"{$row['description']}\" class=\"modal-content lazy\" id=\"img{$row['postid']}\">
					<div class=\"caption\" id=\"caption{$row['postid']}\"></div>
					</div>";
					
					echo "<script>initmodal({$row['postid']});</script>";
		
		
		
		echo "<div name=\"cmts{$row['postid']}\" style=\"display:none;\" id=\"bigbox\">";
		echo "<p style=\"font-size: 30px;\">Comments:</p>";
		echo "<form method=\"post\" action=\"/comment.php?postid={$row['postid']}\">
		<input type=\"text\" style=\"width=100%;\" name=\"commentarea\">
		<input class=\"btncmt\" type=\"submit\" value=\"Comment!\">
		</form>";
		echo "<div id=\"rightbox\">";
		$cmtresult = mysqli_query($db,"SELECT userid,body FROM comments WHERE postid='{$row['postid']}' ORDER BY date DESC");
		while ($cmtrow = mysqli_fetch_array($cmtresult, MYSQLI_ASSOC)) {
		$content = preg_replace("/[*<>]/", "", $cmtrow['body']);
		include 'mention.php';
		echo "<a href=\"/account/pages/{$cmtrow['userid']}\"><img alt=\"".getNameOfUser($cmtrow['userid'],$db)."\" class=\"midppic lazy\" width=\"50\" src=\"/loading_new.gif\" data-original=\"/uploads/ppictures/".getPicOfUser($cmtrow['userid'],$db)."\"></a><b>".getNameOfUser($cmtrow['userid'],$db).": </b>";
		echo $content."<br>";	
		}
		echo "</div></div>";
		
		echo "</div>";
		echo "<input id=\"showLike\" class=\"btncmt\" type=\"button\" value=\"Likes: ".getTotalLikes($row['postid'],$db)."\" onclick=\"showLikes('{$row['postid']}');\" />";
		
		echo " <input id=\"showCmt\" class=\"btncmt\" type=\"button\" value=\"Comments: ".getTotalComments($row['postid'],$db)."\" onclick=\"postClick(event, this, {$row['postid']});\" />";
		
		
		
		
		
		
		
		
		echo "<p style=\"display: none;\" id=\"wholiked{$row['postid']}\">";
		
		echo "<b>Users liked this post:</b>";
		
		$likedresult = mysqli_query($db,"SELECT userid FROM likes WHERE liked=1 AND postid='{$row['postid']}' ORDER BY date ASC");
		while ($likedrow = mysqli_fetch_array($likedresult, MYSQLI_ASSOC)) {
		echo "<br>".getNameOfUser($likedrow['userid'],$db);	
		}
		
		echo "</p>";
		if(isset($_SESSION['username'])){
		echo "<form method=\"post\" action=\"#{$row['postid']}\"><input type=\"hidden\" name=\"togglelike\" value=\"{$row['postid']}\"><input type=\"image\"  alt=\"Submit\" name=\"ll\" src=\"/like.png\" width=\"50\" class=\"like ";
		if(!isLiked($row['postid'],getIdOfUser($_SESSION['username'],$db),$db)){
		echo " unlike ";
		}
		echo "\"></form>";}
		echo "</div></div><br>";
		
		
		if($adcounter == 5){
			$adcounter = 0;
			include $_SERVER['DOCUMENT_ROOT'] . '/ad.php';
				}
				
		if($adcounter == 2){
		echo '
		<!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_relatedposts_inline"></div> 
		';
		}
		$oldpost = $row['postid'];
		
	}
	}
  
?>

