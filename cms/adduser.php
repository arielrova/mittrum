<?php 
require('includes/config.php');
session_start(); 

if(isset($_POST['submit'])){

	$userN = $_POST['userN'];
	$passW = $_POST['passW'];
  $realN = $_POST['realN'];
  $admin = $_POST['admin'];
  
  // ** Funkar ej men skulle vara snyggare ** //
  //Radio button has been set to "true"
  //if(isset($_POST['admin']) && $_POST['admin'] == "true" ) $_POST['admin'] = TRUE;
  //Radio button has been set to "false" or a value was not selected
  //else $_POST['admin'] = FALSE;
	
	$userN = mysqli_real_escape_string($conn, $userN);
	$passW = mysqli_real_escape_string($conn, $passW);
	$realN = mysqli_real_escape_string($conn, $realN);
  $realN = mysqli_real_escape_string($conn, $admin);
	
	mysqli_query($conn, "INSERT INTO users (username,password,realname,admin) VALUES ('$userN','$passW', '$realN', '$admin')")or die(mysqli_error($conn));
	$_SESSION['success'] = 'User added';
	header('Location: '.DIRADMIN);
	exit();

	//run if a page deletion has been requested
	if(isset($_GET['delpage'])){
		
	$delpage = $_GET['delpage'];
	$delpage = mysqli_real_escape_string($conn, $delpage);
	$sql = mysqli_query($conn, "DELETE FROM pages WHERE pageID = '$delpage'");
    $_SESSION['success'] = "Page Deleted"; 
    header('Location: ' .DIRADMIN);
   	exit();
   }
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

<div id="logo"><a href="<?php echo DIR;?>"><img src="images/logo.png" alt="<?php echo SITETITLE;?>" title="<?php echo SITETITLE;?>" border="0" /></a></div><!-- close logo -->

<!-- NAV -->
<div id="navigation">
<ul class="menu">
<li><a href="<?php echo DIRADMIN;?>">Admin</a></li>
<li><a href="<?php echo DIRADMIN;?>?logout">Logout</a></li>
<li><a href="<?php echo DIR;?>" target="_blank">View Website</a></li>
</ul>
</div>
<!-- END NAV -->

<div id="content">

<h1>Add user</h1>

<form action="" method="post">
<p>username:<br /> <input name="userN" type="text" value="" size="50" /></p>
<p>password:<br /> <input name="passW" type="text" value="" size="50" /></p>
<p>realname:<br /> <input name="realN" type="text" value="" size="50" /></p>
<p>admin?:<br />yes <br /> <input name="admin" type="radio" value="true" />
          <br />no  <br /> <input name="admin" type="radio" value="false" /></p>
<p><input type="submit" name="submit" value="Submit" class="button" /></p>
</form>

<?php if ($_SESSION["userPrivilege"] == 'superuser') {

	echo "<h1>Edit posts</h1>";

	echo "<table>";
		echo "<tr>";
			echo "<th>userID</th>";
			echo "<th>pageID</th>";
			echo "<th>pageTitle</th>";
			echo "<th>Edit</th>";
			echo "<th>Delete</th>";
		echo "</tr>";

		$return = '';
			$posts = mysqli_query($conn, "SELECT userID, pageID, pageTitle FROM pages ORDER BY userID ASC");
			while ($row = mysqli_fetch_object($posts)) {
				$userID = $row->userID;
				$pageID = $row->pageID;
				$pageTitle = $row->pageTitle;

				$return .= "<tr>";
				$return .= "<td>$userID</td>"; 
				$return .= "<td>$pageID</td>";
				$return .= "<td>$pageTitle</td>";
				$return .= "<td><a href=\"".DIRADMIN."editpage.php?id=$row->pageID\">Edit</a></td>";
				$return .= "<td><a href=\"javascript:delpage('$row->pageID','$row->pageTitle');\">Delete</a></td>";
				$return .= "</tr>";
			}
			echo $return;
	echo "</table>";
} ?>

</div>

<div id="footer">	
		<div class="copy">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>
</div><!-- close footer -->
</div><!-- close wrapper -->

</body>
</html>