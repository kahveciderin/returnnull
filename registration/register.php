<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
  <title>ReturnNull Registration</title>
  <link rel="stylesheet" type="text/css" href="../style.css">
  <script src="/scripts/jquery.min.js"></script>
  <script src="https://www.google.com/recaptcha/api.js?render=6LdND8IZAAAAAPEsejCoeclXZ-h46I5wCpEw1t8P"></script>
</head>
<body>



<div id="header">

<div class="main-login">

	<img src="/call.png">
	
	
	
	<?php
	
	
	  if(!isset($_GET['location'])){
	  $refer = "/index.php";
	  
	  }else{
	  $ref = $_GET['location'];
	
	$refer = parse_url($ref)['path'];
}

	$refer = preg_replace("/[*<>]/", "", $refer);
	?>
	
  <form id="registerform" method="post" action="register.php?location=<?php echo $refer; ?>">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
<br> <br>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div><br> <br>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div><br><br>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	  <input type="hidden" name="reg_user" value="1">
  	</div><br> <br>
  	<div class="input-group">
  	  <button type="submit" class="btn">Join Now!</button>

</form>

  	</div><br> <br>

</div>

<div class="sub-content">


<div class="s-part">
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </div>
</div>




</div>

<script>
$('#registerform').submit(function(event) {
        event.preventDefault();
        var email = $('#email').val();
 
        grecaptcha.ready(function() {
            grecaptcha.execute('6LdND8IZAAAAAPEsejCoeclXZ-h46I5wCpEw1t8P', {action: 'register_to_the_site'}).then(function(token) {
                $('#registerform').prepend('<input type="hidden" name="token" value="' + token + '">');
                $('#registerform').prepend('<input type="hidden" name="action" value="register_to_the_site">');
                $('#registerform').unbind('submit').submit();
            });;
        });
  });
</script>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</body>
</html>
