<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<?php
	foreach (glob("css/*.css") as $css) {
    echo "<link type='text/css' rel='stylesheet' href='$css'>\n";
	}
	?>
	
  <link rel="stylesheet" type="text/css" href="../style.css">
	
  <style>
      html, body, pre, code, kbd, samp {
          font-family: "Press Start 2P";
      }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
	
	
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
		}}
		
	$refer = preg_replace("/[*<>]/", "", $refer);
	?>
	
    <div class="container" style="padding-top:2%;">
        <div class="jumbotron mx-auto nes-container is-rounded" style="min-width:30%; max-width:90%;">
            <h3 style="text-align: center; padding-bottom:3%; font-size:140%;" >returnnull.xyz</h3>
            
            
            <?php	echo "<form name=\"theForm\" method=\"post\" action=\"login.php?location=$refer\" id=\"flin\" aria-label=\"login-form\">";	?>
            
  	<?php include('errors.php'); ?>
                <div class="nes-field">
                    <input type="text" name="username" id="name_field" placeholder="Username" style="width:90%;margin-left: 5%; margin-right:5%;" class="nes-input">
                    <div class="row" style="margin-top:10%;">
                        <div class="col-md-8 ml-auto" style="float: left;">
                            <input id="passwordField" placeholder="Password" name="password" type="password" style="float: left;width:100%;" class="nes-input">
                        </div>
                    <div class="col-md-3 mr-auto">
                        <button id="see"  class="nes-btn btn-block" type="button" onclick="myFunction();">See</button>
                    </div>
                    </div>
                    <div class="row mx-auto" style="width: 80%; background-color:white; margin-top:10%;">
                        <button type="submit"  class="nes-btn btn-block">Log In</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="container" style="padding-top: 3%;">
        <div class="jumbotron mx-auto nes-container is-rounded" style="min-width:30%; max-width:90%;text-align:center;">
            <h6>Not yet a member?<a href="register.php">Join us</a></h6>
        </div>
    </div>
    
    

    <script>
        function myFunction() {
          var x = document.getElementById("passwordField");
          if (x.type === "password") {
            x.type = "text";
            
            document.getElementById("see").classList.add('is-primary');
          } else {
            x.type = "password";
            document.getElementById("see").classList.remove('is-primary');
            
          }
        }
        </script>

 <?php
	foreach (glob("js/*.js") as $js) {
    echo "<script src=\"$js\">\n";
	}
	?>
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
</html>
