<?php

require('includes/config.php');
session_start();
if(logged_in()) {header('Location: '.DIRADMIN);}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SITETITLE;?></title>
<link rel="stylesheet" href="<?php echo DIR;?>style/login.css" type="text/css" />
</head>
<body>
<div class="lwidth">
	<div class="page-wrap">
		<div class="content">
      <h2>Welcome to Mitt rum</h2>
		
		<?php
		if(!empty($_POST['loginsubmit'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $_SESSION['username'] = $username;
      $_SESSION['password'] = $password;
      
			login($conn, $username, $password);
		}
		?>
		<?php
		if(!empty($_POST['signupsubmit'])) {
      if ($_POST["signuppassword"] == $_POST["confirmpassword"]) {
          SignUp($conn);
      }
      else {
         echo "Password doesn't match";
      }
		}
		?>

<div id="login">
	<p><?php echo messages();?></p>      
	<form method="post" action="">
  <p>Log in:</p>
	<p><label><input type="text" name="username" placeholder="username" value="" /></label></p>
	<p><label><input type="password" name="password" placeholder="password"  /></label></p>
	<p><input type="submit" name="loginsubmit" class="button" value="  log in  " /></p>                       
	</form>       
	<form method="post" action="">
  <p>Register:</p>
	<p><label><input type="text" name="signupusername" placeholder="username"  /></label></p>
	<p><label><input type="text" name="signupname" placeholder="real name" /></label></p>
	<p><label><input type="password" name="signuppassword" placeholder="password" /></label></p>
  <p><label><input type="password" name="confirmpassword" placeholder="confirm password" /></label></p>
	<p><input type="submit" name="signupsubmit" class="button" value="register" /></p>                
	</form>
</div>
</div>
</body>
</html>