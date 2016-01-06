<?php 

require('includes/config.php'); 
login_required();
$username = $_SESSION['username'];
$password = $_SESSION['password'];

// Denna rad kanske ska tillhöra ett auth-system som koppar ihop anvdändare med username hela tiden SENARE.
$result = mysqli_query($conn, "SELECT userID FROM users WHERE username='$username' AND password='$password'");
while($row = mysqli_fetch_object($result)){
$userID = $row->userID;
}
//

echo "Logged in as: ".$username."";
echo "USERID: ".$userID."";

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

	<div id="logo"><a href="<?php echo DIR;?>"><img src="images/logo.png" alt="<?php echo SITETITLE;?>" title="<?php echo SITETITLE;?>" border="0" /></a></div><!-- close logo -->
	
	<!-- NAV -->
	<div id="navigation">
	<ul class="menu">
	  <li><a href="<?php echo DIR;?>">Admin</a></li>
	</ul>
	</div>
	<!-- END NAV -->
	
	<div id="content">
	
	<?php	
	//if no page clicked on load home page default to it of 1
	if(!isset($_GET['p'])){
		$q = mysqli_query($conn, "SELECT * FROM pages WHERE pageID='1'");
	} else { //load requested page based on the id
		$id = $_GET['p']; //get the requested id
		$id = mysqli_real_escape_string($conn, $id); //make it safe for database use
		$q = mysqli_query($conn, "SELECT * FROM pages WHERE pageID='$id'");
	}

	 //get the rest of the pages
		$sql = mysqli_query($conn, "SELECT * FROM pages WHERE isRoot='1' AND userID='$userID' ORDER BY pageID");
	  while ($row = mysqli_fetch_object($sql))
		{
			echo "<li><a href=\"".DIR."indexUSERHEM.php?p=$row->pageID\">$row->pageTitle</a></li>"; 
  }
  
	//get page data from database and create an object
	$r = mysqli_fetch_object($q);
	
	//print the pages content
	echo "<h1>$r->pageTitle</h2>";
	echo $r->pageCont;
	?>
	
	</div><!-- close content div -->

	<div id="footer">	
			<div class="copy">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>
	</div><!-- close footer -->
</div><!-- close wrapper -->

</body>
</html>