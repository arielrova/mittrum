<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Mittrum</title>
  </head>

  <body>
<?php

  include_once('_class/cms.php');
  $obj = new simpleCMS();
  $obj->host = 'localhost';
  $obj->username = 'vigu';
  $obj->password = 'vigu-xmlpub13';
  $obj->table = 'vigu';
  $obj->connect();

  if ( $_POST )
    $obj->write($_POST);

  echo ( $_GET['admin'] == 1 ) ? $obj->display_admin() : $obj->display_public();

?>
  </body>

</html>