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
$sql="SELECT * FROM pages WHERE pageID = '".$q."'";

echo "<table>";
	echo "<tr>";
		echo "<th>userID</th>";
		echo "<th>pageID</th>";
		echo "<th>pageTitle</th>";
		echo "<th>Edit</th>";
		echo "<th>Delete</th>";
	echo "</tr>";
	$returnPosts = '';
		$posts = mysqli_query($conn, $sql);
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
  
?>