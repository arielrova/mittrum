<?php
require('includes/config.php'); 
// Auth variables from login
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$userID = $_SESSION['userID'];
$userPrivilege = $_SESSION['admin'];


$debug = 0; #1 visar xml


if($debug) {
	header("Content-type:text/xml;charset=utf-8");
} else {
	include("prefix.php");
}

?>

<?php
$returnstring .= "<!DOCTYPE site SYSTEM \"http://xml.csc.kth.se/~arielr/DM2517/pro-mittrum/cms/mittrum.dtd\">";
$returnstring .= "<site>";
$returnstring .= "<siteTitle>$username's room</siteTitle>";


// the query
$query = "SELECT pageTitle, pageID, pageCont, pageType, StartEventDate, EndEventDate
          FROM pages NATURAL JOIN users
          WHERE userID='$userID'
          ORDER BY pageTitle";
        
// execute the query
$result = mysqli_query($conn, $query) or die("Query failed" . $query);

// loop over all lines returned by the query. Make sure special characters are replaced.
while ($line = mysqli_fetch_object($result)) {
    // store content in variables
    $pageTitle = htmlspecialchars($line->pageTitle);
    $pageID = htmlspecialchars($line->pageID); 
    $pageCont = htmlspecialchars($line->pageCont);
    $pageType = htmlspecialchars($line->pageType);
    $StartEventDate = htmlspecialchars($line->StartEventDate);
    $EndEventDate = htmlspecialchars($line->EndEventDate);
    
    // add one word to the result
    // concatenate strings with ".";
    $returnstring = $returnstring . "<page>";
    $returnstring = $returnstring . "<pageTitle>$pageTitle</pageTitle>";
    $returnstring = $returnstring . "<id>$pageID</id>";
    $returnstring = $returnstring . "<pageCont>$pageCont</pageCont>";
    $returnstring = $returnstring . "<pageType>$pageType</pageType>";
    $returnstring = $returnstring . "<starteventdate>$StartEventDate</starteventdate>";
    $returnstring = $returnstring . "<endeventdate>$EndEventDate</endeventdate>";
    $returnstring = $returnstring . "</page>";
}

$returnstring .= "</site>";

// convert the result to utf8 before it is printed (often not necessary)
//print utf8_encode($returnstring);
echo $returnstring;

?>

<?php 
if (!($debug)) {
	// do the transformations. Look in the file postfix.php to see how it works.
	include("postfix.php");
}
?>
