<?php
 
    define ( 'EXTENSION', '.php' );
    define ( 'CLASS_EXTENSION', '.class' . EXTENSION );
    
    require_once ( './app/autoloader.php' );
  
    use app\models as Models;
    use app\controllers as Controllers;

?>