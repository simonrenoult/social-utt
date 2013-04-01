<?php
  require_once ( '/app/autoloader.php' );
  
  use app\models as Models;
  use app\controllers as Controllers;
  
  // 1 : check the cookies
  Controllers\CookiesManager::checkExistance ();
  
?>