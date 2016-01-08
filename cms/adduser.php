<?php 

  // ** Funkar ej men skulle vara snyggare ** //
  //Radio button has been set to "true"
  //if(isset($_POST['admin']) && $_POST['admin'] == "true" ) $_POST['admin'] = TRUE;
  //Radio button has been set to "false" or a value was not selected
  //else $_POST['admin'] = FALSE;

require('includes/config.php');
session_start(); 


if(isset($_POST['submit'])){
	$userN = $_POST['userN'];
	$passW = $_POST['passW'];
  $realN = $_POST['realN'];
  $admin = $_POST['admin'];
	
	$userN = mysqli_real_escape_string($conn, $userN);
	$passW = mysqli_real_escape_string($conn, $passW);
	$realN = mysqli_real_escape_string($conn, $realN);
  $realN = mysqli_real_escape_string($conn, $admin);
	
	mysqli_query($conn, "INSERT INTO users (username,password,realname,admin) VALUES ('$userN','$passW', '$realN', '$admin')")or die(mysqli_error($conn));
	$_SESSION['success'] = 'User added';
	header('Location: '.DIRADMIN);
	exit();
	}

if(isset($_POST['submitUserChanges'])) {

	$userID = $_POST['userID'];
	$userNedit = $_POST['userNedit'];
	$passWedit = $_POST['passWedit'];
	$realNedit = $_POST['realNedit'];
	$adminEdit = $_POST['adminEdit'];

	mysqli_query($conn, 
	"UPDATE users  
	SET username='$userNedit', password='$passWedit', realname='$realNedit', admin='$adminEdit'
	WHERE userID = $userID");
	$_SESSION['success'] = 'User modified';
	header('Location: '.DIRADMIN);
	exit();
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

  if(isset($_GET['deluser'])){
  	$deluser = $_GET['deluser'];
  	$deluser = mysqli_real_escape_string($conn, $deluser);
  	mysqli_query($conn, "DELETE FROM users WHERE userID = '$deluser'");
  	$_SESSION['success'] = "User Deleted";
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
		  window.location.href = '?delpage=' + id;
	   }
	}
	function deluser(id, name)
	{
	   if (confirm("Are you sure you want to delete '" + name + id + "'"))
	   {
		  window.location.href = '?deluser=' + id;
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
<?php echo "<li><a href=\"".DIRADMIN."indexxml.php?id=$userID\">View Website</a></li>" ?>
</ul>
</div>
<!-- END NAV -->

<div id="content">

<h1>Add user</h1>
<div id="addUser">
<form action="" method="post">
<p>username:<br /> <input name="userN" type="text" value="" size="20" /></p>
<p>password:<br /> <input name="passW" type="text" value="" size="20" /></p>
<p>realname:<br /> <input name="realN" type="text" value="" size="20" /></p>
<p>admin?:<br />yes <br /> <input name="admin" type="radio" value="admin" />
          <br />no  <br /> <input name="admin" type="radio" value="0" /></p>
<p><input type="submit" name="submit" value="Submit" class="button" /></p>
</form>
</div>
<div id="editUser">
<?php
	echo "<h1>Edit users</h1>";

	echo "<table>";
		echo "<tr>";
			echo "<th>userID</th>";
			echo "<th>Username</th>";
			echo "<th>Password</th>";
			echo "<th>realname</th>";
			echo "<th>Admin</th>";
			echo "<th>Execute</th>";
			echo "<th>Delete</th>";
		echo "</tr>";

		$returnUsers = '';
		$users = mysqli_query($conn, "SELECT * FROM users ORDER BY userID ASC");
		while ($row = mysqli_fetch_object($users)) {
			$userID = $row->userID;
			$username = $row->username;
			$password = $row->password;
			$realname = $row->realname;
			$admin = $row->admin;

			$returnUsers .= "<tr>";
			$returnUsers .= "<form action=\"\" method=\"post\">";
			$returnUsers .= "<td><input name=\"userID\" type=\"text\" value=\"$userID\" size=\"10\" readonly /></td>";
			$returnUsers .= "<td><input name=\"userNedit\" type=\"text\" value=\"$username\" size=\"10\" /></td>";
			$returnUsers .= "<td><input name=\"passWedit\" type=\"text\" value=\"$password\" size=\"10\" /></td>";
			$returnUsers .= "<td><input name=\"realNedit\" type=\"text\" value=\"$realname\" size=\"10\" /></td>";
			$returnUsers .= "<td><select name=\"adminEdit\"><option value=\"$admin\">$admin</option><option value=\"admin\">admin</option><option value\"0\">0</option></select></td>";
			$returnUsers .= "<td><input type=\"submit\" name=\"submitUserChanges\" value=\"Do!\" class=\"button\" /></td>";
			$returnUsers .= "</form>";
			$returnUsers .= "<td><a href=\"javascript:deluser('$userID','$username');\">Delete</a></td>";
			$returnUsers .= "</tr>";
		}
		echo $returnUsers;
		echo "</table>";
	?>
</div>
<div id="editPosts">
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

		$returnPosts = '';
			$posts = mysqli_query($conn, "SELECT userID, pageID, pageTitle FROM pages ORDER BY userID ASC");
			while ($row = mysqli_fetch_object($posts)) {
				$userID = $row->userID;
				$pageID = $row->pageID;
				$pageTitle = $row->pageTitle;

				$returnPosts .= "<tr>";
				$returnPosts .= "<td>$userID</td>"; 
				$returnPosts .= "<td>$pageID</td>";
				$returnPosts .= "<td>$pageTitle</td>";
				$returnPosts .= "<td><a href=\"".DIRADMIN."editpage.php?id=$row->pageID\">Edit</a></td>";
				$returnPosts .= "<td><a href=\"javascript:delpage('$row->pageID','$row->pageTitle');\">Delete</a></td>";
				$returnPosts .= "</tr>";
			}
			echo $returnPosts;
	echo "</table>";
} ?>
</div>
</div>

<div id="footer">	
		<div class="copy">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>
</div><!-- close footer -->
</div><!-- close wrapper -->

</body>
</html>

