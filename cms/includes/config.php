<?php
ob_start();
session_start();

// db properties
define('DBHOST','localhost');
define('DBUSER','vigu');
define('DBPASS','vigu-xmlpub13');
define('DBNAME','vigu');

// make a connection to mysql here
$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// define site path
//Önödig nu?
define('DIR','http://xml.csc.kth.se/~vigu/DM2517/project/cms/');

// define admin site path
define('DIRADMIN','http://xml.csc.kth.se/~vigu/DM2517/project/cms/');

// define site title for top of the browser
define('SITETITLE','Mitt Rum');

//define include checker
define('included', 1);

include('functions.php');
?>
