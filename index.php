<?php
 
define ( 'EXTENSION', '.php' );
define ( 'CLASS_EXTENSION', '.class' . EXTENSION );

require_once ( PATH . 'app/autoloader.php' );

use app\models as Models;
use app\controllers as Controllers;
use app\tools as Tools;

$conn = Tools\DatabaseConnector::getConnection ( );
$user = new Models\User ( array ( 
    "login" => "simon",
    "email" => "simon@gmail.com",
    "password" => "test"
) );

$manager = new Controllers\UserManager ( $conn, $user );
$status = $manager -> save ( );

var_dump ( $status -> toArray ( ) );
?>
