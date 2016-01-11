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
	<p><label><strong>Username</strong><input type="text" name="username" /></label></p>
	<p><label><strong>Password</strong><input type="password" name="password" /></label></p>
	<p><br /><input type="submit" name="loginsubmit" class="button" value="login" /></p>                       
	</form>
</div>
<div id="signup">
	<p><?php echo messages();?></p>
  <p>New user? Sign Up:</p>        
	<form method="post" action="">
	<p><label><strong>Username</strong><input type="text" name="signupusername" /></label></p>
	<p><label><strong>Realname</strong><input type="text" name="signupname" /></label></p>
	<p><label><strong>Password</strong><input type="password" name="signuppassword" /></label></p>
  <p><label><strong>Confirm password</strong><input type="password" name="confirmpassword" /></label></p>
	<p><br /><input type="submit" name="signupsubmit" class="button" value="sign up" /></p>                       
	</form>
</div>


    </div>
		<div class="clear"></div>		
	</div>
<div class="footer">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>	
</div>
</body>
</html>