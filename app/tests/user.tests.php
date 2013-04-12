<?php
  
  define ( 'APP_PATH', '../' );
  require_once './../scaffhold.php';
  
  $testData = array (
    "login" => md5 ( rand ( 0, 1000 ) ),
    "password" => md5 ( rand ( 1001, 2000 ) ),  
    "email" => md5 ( rand ( 2001, 3000 ) )
  );
  
  $conn = Tools\DatabaseConnector::getConnection ( );
  $user = new Models\User ( $testData );

  $manager = new Controllers\UserManager ( $conn, $user );
  $status = $manager -> save ( );

  var_dump ( $status );
?>