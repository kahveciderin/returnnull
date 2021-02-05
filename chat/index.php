<?php
ob_start();
$lcpath = $_SERVER['DOCUMENT_ROOT'];
$lcpath .= "/login-check.php";
include($lcpath);
?>
<?php
include '../db.php';
include '../topbar.php';

?>


<html>
	
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<title>Live Chat</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="/style.css">
	<script src="/scripts/jquery.min.js"></script>
<script src="/scripts/jquery.lazyload.js"></script>
</head>
<body>

<?php
$chatnt = 0;
//echo $_SESSION['username'];
?>

<div id="box">
<br><br>
	<?php
	
	if(isset($_POST['textmsg'])){
		
	$msg = $_POST['textmsg'];
	
	$uname = $_SESSION['username'];
	//echo $uname;
	$uidforthis = mysqli_query($db,"SELECT id FROM users WHERE username='$uname'");
   $fuid = array();
   $uidrow = mysqli_fetch_array($uidforthis, MYSQLI_ASSOC);
	   
	   $fuid[] = $uidrow;
	   
	  
	$uid = $fuid[0]['id'];
	
	$addmsg = "insert into chat(userid , body) values ('$uid','$msg')";
	mysqli_query($db, $addmsg);
	
unset($_POST['textmsg']);
}


        

	
	
	//print_r($msgarray[0]);
	
	
	
	?>
	
</div>
<br><br>
<form name="messagesender" action="/chat/index.php" method="POST">
Message: <input type="text" id="textmsg" name="textmsg">
<input type="submit" value=Send>
<input type="hidden" id="token" name="token" value="<?php	echo $token	?>">
</form>
<script>
	
	
	var norow = document.getElementById("chatcnt");
	if(norow == null){
		var row = 0;
		}else{
	var row = norow.innerHTML;}
	
	
	function loadlink () {
		var norow = document.getElementById("chatcnt");
	if(norow == null){
		var row = 0;
		}else{
	var row = norow.innerHTML;}
	
    $.get("chat-data.php?row="+row, function(data, status){
		document.getElementById("box").innerHTML += data;
    });
    var objDiv = document.getElementById("box");
objDiv.scrollTop = objDiv.scrollHeight;
}

loadlink(); // This will run on page load
setInterval(function(){
    loadlink() // this will run after every 5 seconds
}, 5000);
      if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
    </script>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</body>
</html>
