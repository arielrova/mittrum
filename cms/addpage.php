<?php 
require('includes/config.php');
session_start();

// Auth variables from login
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$userID = $_SESSION['userID'];
$userPrivilege = $_SESSION['admin'];

if(isset($_POST['submit'])){

	$title = mysqli_real_escape_string($conn, $_POST['pageTitle']);
	$content = mysqli_real_escape_string($conn,  $_POST['pageCont']);
  $type = mysqli_real_escape_string($conn,  $_POST['pageType']); 
  $StartEventDate = mysqli_real_escape_string($conn, $_POST['StartEventDate']);
  $EndEventDate = mysqli_real_escape_string($conn, $_POST['EndEventDate']);
  $StartEventDate = date('Y-m-d', strtotime(str_replace('/', '-', $StartEventDate)));
  $EndEventDate = date('Y-m-d', strtotime(str_replace('/', '-', $EndEventDate)));
  
  // Denna rad kanske ska tillhöra ett auth-system som koppar ihop anvdändare med username hela tiden SENARE.
  $result = mysqli_query($conn, "SELECT userID FROM users WHERE username='$username' AND password='$password'");
  while($row = mysqli_fetch_object($result)){
  $userID = $row->userID;
  }
  //
  
  mysqli_query($conn, "INSERT INTO pages (pageTitle,pageCont,userID,pageType,StartEventDate,EndEventDate) VALUES ('$title','$content','$userID','$type','$StartEventDate','$EndEventDate')")or die(mysqli_error($conn));
	$_SESSION['success'] = 'Page Added';
	header('Location: '.DIRADMIN);
  //mysqli_free_result($result);
	exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE;?></title>
<link href="<?php echo DIR;?>style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">

<!-- NAV -->
<div id="navigation">
	<ul class="menu">
		<li><a href="<?php echo DIRADMIN;?>">ADMIN</a></li>
		<?php echo "<li><a href=\"".DIRADMIN."indexxml.php?id=$userID\">ROOM</a></li>" ?>
		<?php if($userPrivilege == 'superuser' or $userPrivilege == 'admin') {
			echo "<li><a href=\"".DIRADMIN."adduser.php\">EDIT USERS</a></li>"; 
		} ?>
		<li><a href="<?php echo DIRADMIN;?>?logout">LOGOUT</a></li>
	</ul>
  <ul class="logInfo"><li><?php echo " Privilege: ".$userPrivilege.""; ?></li>
                      <li><?php echo " UserID: ".$userID.""; ?></li>
                      <li><?php echo "Logged in as: ".$username.""; ?></ul>
</div>
<!-- END NAV -->

<div id="content">

<h1>Add Event</h1>

<form action="" method="post">
<p>Title:<br /> <input name="pageTitle" type="text" value="" size="103" /></p>
<p>Startdate(yyyy/mm/dd):<br /><input name="StartEventDate" type="date" value="" size="103" /></p>
<p>Enddate(yyyy/mm/dd):<br /><input name="EndEventDate" type="date" value="" size="103" /></p>
<p>Content<br /><textarea name="pageCont" cols="100" rows="20"></textarea></p>
<p>Type:<br /><br />Education <br /> <input name="pageType" type="radio" value="education" />
       <br />Employment<br /> <input name="pageType" type="radio" value="employment" />
       <br />Life      <br /> <input name="pageType" type="radio" value="life" />
       <br />Youtube   <br /> <input name="pageType" type="radio" value="youtube" /></p>
<p><input type="submit" name="submit" value="Submit" class="button" /></p>
</form>

</div>
</div><!-- close wrapper -->

</body>
</html>