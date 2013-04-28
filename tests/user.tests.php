<?php

define ( 'EXTENSION', '.php' );
define ( 'CLASS_EXTENSION', '.class' . EXTENSION );  

require_once ( '../app/autoloader.php' );
require_once ( '../app/tools/Misc.php' );

$conn = app\tools\DatabaseConnector::getConnection ( );

$user = new app\models\User ( array ( 
    "login" => generateRandomString ( ),
    "password" => generateRandomString ( ),
    "email" => generateRandomString ( ) . "@test.com"
) );

$user_manager = new app\controllers\UserManager ( $conn, $user );



?>