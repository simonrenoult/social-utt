<?php

namespace app\controllers;

/**
 * Description of CookiesManager
 *
 * @author g4llic4
 */
class CookiesManager {
  
  // ------------ CONSTANTS ------------ //
  
  // ------------ METHODS ------------ //
  
  /**
   * Return true whetehr the paramater passed as an argument exist (as a cookie).
   * 
   * @param string $name
   * @return boolean
   */
  public static function exists ( $name ) {
    return isset ( $_COOKIE[$name] );
  }
  
  /**
   * Return true whether the cookie does not exist or is empty for this name.
   * 
   * @param string $name
   * @return boolean
   */
  public static function isEmpty ( $name ) {
    return empty ( $_COOKIE[$name] );
  }
  
  /**
   * Return the value of the given cookie. Return the default value if the
   * cookie does not exist.
   * 
   * @param string $name
   * @param string $defaultValue
   * @return mixed
   */
  public static function get ( $name, $defaultValue = '' ) {
    return self :: exists ( $name )  ? $_COOKIE[$name] : $defaultValue;
  }
  
  public static function set ( $name, $value, $expirationValue ) {
    setcookie ( $name, $value, $expirationValue );
  }
  
}

?>
