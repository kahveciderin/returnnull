<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
  <title>ReturnNull Login</title>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	
	
<div id="header">
	
<div class="main-login">
	<img src="/call.png">
	<?php
	  if(!isset($_SERVER['HTTP_REFERER'])){
	  $refer = "/index.php";
	  
	  }else{
	  $ref = $_SERVER['HTTP_REFERER'];
	
	$refer = parse_url($ref)['path'];
	if($refer == "/registration/login.php"){
	  $refer = "/index.php";
	  }

	if($refer == "/registration/register.php"){
	  $refer = "/index.php";
	  }



	  
  }
	
	
	if(isset($_COOKIE['uname'])){
		if(isset($_COOKIE['pwd'])){
			$cun = $_COOKIE['uname'];
			$cpd = $_COOKIE['pwd'];
			
			//echo "<script type=\"text/javascript\">
			//document.getElementById('cookiesubmit').submit(); // SUBMIT FORM
			//</script>";
			}
	}
	
	  
	$refer = preg_replace("/[*<>]/", "", $refer);
	echo "<form name=\"theForm\" method=\"post\" action=\"login.php?location=$refer\" id=\"flin\" >";
	//echo $refer;
	?>
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" value="<?php if(isset($cun)) echo $cun; ?>" >
  	</div>

<br> <br> 
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password" value="<?php if(isset($cpd)) echo $cpd; ?>" size="50">
  	</div>
  	<input type="hidden" name="login_user" value="1">
  	<div class="input-group">
<br> <br>
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>

<br> <br>
<br> <br>






  </form>
  
  </div>
  
<div class="sub-content">
<div class="s-part">
  	<p>
  		Not yet a member? <a href="register.php?location=<?php echo $refer; ?>">Join Us!</a>
  	</p>
</div>

</div>



</div>

</body>

<?php
	if(isset($_COOKIE['uname'])){
		if(isset($_COOKIE['pwd'])){
			
			//echo "<script type=\"text/javascript\">
			//document.theForm.submit();
			//</script>";
			
			$password = $_COOKIE['pwd'];
			$query = "SELECT * FROM users WHERE username='{$_COOKIE['uname']}' AND password='$password'";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) == 1) {
			$_SESSION['username'] =$_COOKIE['uname'];
			$_SESSION['success'] = "You are now logged in";
  	  
  	  
			$redirect = $_GET['location'];
	  
	  
	  
			setcookie('user', '1', time() + (86400 * 30), "/");
			header('location: ..'.$redirect);
			}
	}
}

?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</html>
