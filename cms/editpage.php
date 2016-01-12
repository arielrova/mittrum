<?php 
require('includes/config.php'); 

if(!isset($_GET['id']) || $_GET['id'] == ''){ //if no id is passed to this page take user back to previous page
	header('Location: '.DIRADMIN); 
}

if(isset($_POST['submit'])){

	$pageID = $_POST['pageID'];
	
	$title = mysqli_real_escape_string($conn, $_POST['pageTitle']);
	$content = mysqli_real_escape_string($conn,  $_POST['pageCont']);
  $type = mysqli_real_escape_string($conn,  $_POST['pageType']);
  $StartEventDate = mysqli_real_escape_string($conn, $_POST['StartEventDate']);
  $EndEventDate = mysqli_real_escape_string($conn, $_POST['EndEventDate']);
  $StartEventDate = date('Y-m-d', strtotime(str_replace('/', '-', $StartEventDate)));
  $EndEventDate = date('Y-m-d', strtotime(str_replace('/', '-', $EndEventDate)));
  
	mysqli_query($conn, "UPDATE pages SET pageTitle='$title', pageCont='$content', pageType='$type', StartEventDate='$StartEventDate', EndEventDate='$EndEventDate' WHERE pageID='$pageID'")or die(mysqli_error($conn));
	$_SESSION['success'] = 'Page Updated';
	header('Location: '.DIRADMIN);
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

<div id="logo"><a href="<?php echo DIR;?>"><img src="images/logo.png" alt="<?php echo SITETITLE;?>" title="<?php echo SITETITLE;?>" border="0" /></a></div><!-- close logo -->

<!-- NAV -->
<div id="navigation">
<ul class="menu">
<li><a href="<?php echo DIRADMIN;?>">Admin</a></li>
<li><a href="<?php echo DIRADMIN;?>logout">Logout</a></li>
<?php echo "<li><a href=\"".DIRADMIN."indexxml.php?id=$userID\">View Website</a></li>" ?>
</ul>
</div>
<!-- END NAV -->

<div id="content">

<h1>Edit Page</h1>

<?php
$id = $_GET['id'];
$id = mysqli_real_escape_string($conn, $id);
$q = mysqli_query($conn, "SELECT * FROM pages WHERE pageID='$id'");
$row = mysqli_fetch_object($q);
?>


<form action="" method="post">
<input type="hidden" name="pageID" value="<?php echo $row->pageID;?>" />
<p>Title:<br /> <input name="pageTitle" type="text" value="<?php echo $row->pageTitle;?>" size="103" />
</p>
<p>content<br /><textarea name="pageCont" cols="100" rows="20"><?php echo $row->pageCont;?></textarea>
</p>
<p>Startdate(yyyy-mmd-d):<br />
  <input name="StartEventDate" type="date" value="<?php echo $row->StartEventDate;?>" size="50" />
</p>
<p>Enddate(yyyy-mm-d):<br />
  <input name="EndEventDate" type="date" value="<?php echo $row->EndEventDate;?>" size="50" />
</p>
<p>Type<br />Education <br /> <input name="pageType" type="radio" value="" />
       <br />Employment<br /> <input name="pageType" type="radio" value="" />
       <br />Life      <br /> <input name="pageType" type="radio" value="" />
       <br />Youtube   <br /> <input name="pageType" type="radio" value="" /></p>
<p><input type="submit" name="submit" value="Submit" class="button" /></p>

</form>

</div>

<div id="footer">	
		<div class="copy">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>
</div><!-- close footer -->
</div><!-- close wrapper -->

</body>
</html>