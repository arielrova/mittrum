<?php
require('includes/config.php'); 
$username = $_SESSION['username'];
$password = $_SESSION['password'];
// Denna rad kanske ska tillhöra ett auth-system som koppar ihop anvdändare med username hela tiden SENARE.
$result = mysqli_query($conn, "SELECT userID FROM users WHERE username='$username' AND password='$password'");
while($row = mysqli_fetch_object($result)){
$userID = $row->userID;
}

$debug = 0; #1 visar xml

if($debug) {
	header("Content-type:text/xml");
} else {
	include("prefix.php");
}
?>
<site>
<?php
$returnstring ="";

// the query
$query = "SELECT pageTitle, pageCont, pageType
          FROM pages
          WHERE userID='$userID'
          ORDER BY pageTitle";
        
// execute the query
$result = mysqli_query($conn, $query) or die("Query failed" . $query);

// loop over all lines returned by the query. Make sure special characters are replaced.
while ($line = mysqli_fetch_object($result)) {
    // store content in variables
    $pageTitle = htmlspecialchars($line->pageTitle); 
    $pageCont = htmlspecialchars($line->pageCont);
    $pageType = htmlspecialchars($line->pageType);
    
    // add one word to the result
    // concatenate strings with "."
    $returnstring = $returnstring . "<page>";
    $returnstring = $returnstring . "<pageTitle>$pageTitle</pageTitle>"; 
    $returnstring = $returnstring . "<pageCont>$pageCont</pageCont>";
    $returnstring = $returnstring . "<pageType>$pageType</pageType>";
    $returnstring = $returnstring . "</page>";
}

// convert the result to utf8 before it is printed (often not necessary)
print utf8_encode($returnstring);
?>
</site>
<?php 
if (!($debug)) {
	// do the transformations. Look in the file postfix.php to see how it works.
	include("postfix.php");
}
?>
