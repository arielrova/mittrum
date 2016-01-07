<?php 
require('includes/config.php');
session_start(); 

//make sure user is logged in, function will redirect use if not logged in
login_required();
$username = $_SESSION['username'];
$password = $_SESSION['password'];

// Denna rad kanske ska tillhöra ett auth-system som koppar ihop anvdändare med username hela tiden SENARE.
$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
while($row = mysqli_fetch_object($result)){
	$userID = $row->userID;
	$userPrivilege = $row->admin;
}

$_SESSION["userPrivilege"] = $userPrivilege;

echo "Logged in as: ".$username."";
echo " USERID: ".$userID."";
echo " Privilege: ".$userPrivilege."";

//if logout has been clicked run the logout function which will destroy any active sessions and redirect to the login page
if(isset($_GET['logout'])){
	logout();
}

//run if a page deletion has been requested
if(isset($_GET['delpage'])){
		
	$delpage = $_GET['delpage'];
	$delpage = mysqli_real_escape_string($conn, $delpage);
	$sql = mysqli_query($conn, "DELETE FROM pages WHERE pageID = '$delpage'");
    $_SESSION['success'] = "Page Deleted"; 
    header('Location: ' .DIRADMIN);
   	exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SITETITLE;?></title>
<link href="<?php echo DIR;?>style/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript">
	function delpage(id, title)
	{
	   if (confirm("Are you sure you want to delete '" + title + "'"))
	   {
		  window.location.href = '<?php echo DIRADMIN;?>?delpage=' + id;
	   }
	}
</script>
</head>
<body>

<div id="wrapper">

<div id="logo"><a href="<?php echo DIRADMIN;?>"><img src="images/logo.png" alt="<?php echo SITETITLE;?>" border="0" /></a></div>

<!-- NAV -->
<div id="navigation">
	<ul class="menu">
		<li><a href="<?php echo DIRADMIN;?>">Admin</a></li>
    <!-- Här bör vi titta på hur länkningen till varje users unika sida ska gå till. XSL-grejor? UPDATE KANSKE KLART-->
		<?php echo "<li><a href=\"".DIRADMIN."indexUSERHEM.php?id=$userID\">View Website</a></li>" ?>
		<?php if($userPrivilege == 'superuser' or $userPrivilege == 'admin') {
			echo "<li><a href=\"".DIRADMIN."adduser.php\">Edit users</a></li>"; 
		} ?>
		<li><a href="<?php echo DIRADMIN;?>?logout">Logout</a></li>
	</ul>
</div>
<!-- END NAV -->

<div id="content">

<?php 
	//show any messages if there are any.
	messages();
?>

<h1>Manage Pages</h1>

<table>
<tr>
	<th><strong>Title</strong></th>
	<th><strong>Action</strong></th>
</tr>

<?php
// Query här: Matcha pages på user inloggad. 
$sql = mysqli_query($conn, "SELECT * FROM pages WHERE userID='$userID' ORDER BY pageID");
while($row = mysqli_fetch_object($sql)) 
{
	echo "<tr>";
		echo "<td>$row->pageTitle</td>";
		if($row->pageID == 1){ //home page hide the delete link
			echo "<td><a href=\"".DIRADMIN."editpage.php?id=$row->pageID\">Edit</a></td>";
		} else {
			echo "<td><a href=\"".DIRADMIN."editpage.php?id=$row->pageID\">Edit</a> | <a href=\"javascript:delpage('$row->pageID','$row->pageTitle');\">Delete</a></td>";
		}
		
	echo "</tr>";
}
?>
</table>

<p><a href="<?php echo DIRADMIN;?>addpage.php" class="button">Add Page</a></p>
<p><a href="<?php echo DIRADMIN;?>adduser.php" class="button">Add User</a></p>
</div>

<div id="footer">	
		<div class="copy">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>
</div><!-- close footer -->
</div><!-- close wrapper -->

</body>
</html>