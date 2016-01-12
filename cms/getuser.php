<?php 
require('includes/config.php');

if(isset($_POST['submitUserChanges'])) {
  
  echo $userNedit;
  
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
  header('Location: '.DIREDIT);
	exit();
	}

?>
<?php
$q = intval($_GET['q']);
$sql="SELECT * FROM users WHERE userID = '".$q."'";

echo "<table>";
	echo "<tr>";
		echo "<th>userID</th>";
		echo "<th>Username</th>";
		echo "<th>Password</th>";
		echo "<th>realname</th>";
		echo "<th>Privilege</th>";
		echo "<th>Execute</th>";
		echo "<th>Delete</th>";
	echo "</tr>";
	$returnUsers = '';
	$users = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_object($users)) {
		$userID = $row->userID;
		$username = $row->username;
		$password = $row->password;
		$realname = $row->realname;
		$admin = $row->admin;
		$returnUsers .= "<tr>";
		$returnUsers .= "<form action=\"getuser.php\" method=\"post\">";
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