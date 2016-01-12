<?php 
require('includes/config.php');
session_start();

// Auth variables from login
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$userID = $_SESSION['userID'];
$userPrivilege = $_SESSION['admin'];

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

function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","getuser.php?q="+str,true);
        xmlhttp.send();
    }
}

function showPosts(str) {
    if (str == "") {
        document.getElementById("txtHint2").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint2").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","getposts.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>

</head>
<body>
<div id="wrapper">

<!-- NAV -->
<div id="navigation">
	<ul class="menu">
		<li><a href="<?php echo DIRADMIN;?>">ADMIN</a></li>
		<?php echo "<li><a href=\"".DIRADMIN."indexxml.php?id=$userID\">ROOM</a></li>" ?>
		<?php if($userPrivilege == 'superuser' or $userPrivilege == 'admin') {
			echo "<li><a href=\"".DIRADMIN."adduser.php\">CONTROL PANEL</a></li>"; 
		} ?>
		<li><a href="<?php echo DIRADMIN;?>?logout">LOGOUT</a></li>
	</ul>
  <ul class="logInfo"><li><?php echo " Privilege: ".$userPrivilege.""; ?></li>
                      <li><?php echo " UserID: ".$userID.""; ?></li>
                      <li><?php echo "Logged in as: ".$username.""; ?></ul>
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
<h1>Edit users</h1>
<?php echo messages();?>
<div id="editUser">
<?php
echo "<select name=users onchange=showUser(this.value)>";
echo "<form>";
echo "<option value=''>Pick a user:</option>";
  $returnUsers='';
  $users = mysqli_query($conn, "SELECT * FROM users ORDER BY userID ASC");
	while ($row = mysqli_fetch_object($users)) {
			$username = $row->username;
      $userID = $row->userID;
      
      $returnUsers .= "<option value=\"$userID\">$username</option>";
    }
      echo $returnUsers;
echo "</select>";
echo "</form>";
?>
<br>
</div>
<div id="txtHint"></div>
<h1>Edit users</h1>
<div id="editPosts">
<?php if ($_SESSION["userPrivilege"] == 'superuser') {

  echo "<select name=users onchange=showPosts(this.value)>";
  echo "<form>";
  echo "<option value=''>Choose a post:</option>";
    $returnPosts='';
    $posts = mysqli_query($conn, "SELECT * FROM pages ORDER BY pageTitle ASC");
  	while ($row = mysqli_fetch_object($posts)) {
  			$post = $row->pageTitle;
        $postID = $row->pageID;
      
        $returnPosts .= "<option value=\"$postID\">$post</option>";
      }
        echo $returnPosts;
  echo "</select>";
  echo "</form>";
} ?>
</div>
<div id="txtHint2"></div>
</div>
</div><!-- close wrapper -->

</body>
</html>