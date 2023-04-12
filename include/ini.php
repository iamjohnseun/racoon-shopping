<?php session_start() ?>
<?php include('constants.php'); ?>
<?php include('core.php'); ?>
<?php
  //CACHE CONTROL
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
  header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
  header("Cache-Control: no-cache, must-revalidate" );
  header('Cache-Control: post-check=0, pre-check=0', FALSE);
  header("Pragma: no-cache" );
  //SHOW PLAIN TEXT
  // header("Content-Type: text/plain; charset=utf-8");
  //SET DEFAULT TIMEZONE
  date_default_timezone_set('Africa/Harare');
  // ALLOW URL INCLUDE
  // ERROR HANDLING
  ini_set('display_errors', debug ? '1' : '0');
  ini_set('log_errors', debug ? 'True' : 'False');
?>
