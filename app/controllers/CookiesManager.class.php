<?php

namespace app\controllers;

/**
 * Description of CookiesManager
 *
 * @author g4llic4
 */
class CookiesManager {
  
  // ------------ CONSTANTS ------------ //
  
  const ONE_DAY = 86400;
  const SEVEN_DAYS = 604800;
  const THIRTY_DAYS = 2592000;
  const SIX_MONTHS = 15811200;
  const ONE_YEAR = 31536000;
  const LIFE8_TIME = 1893456000; // 2030-01-01 00:00:00
  
  const DEFAULT_PATH = '/';
  
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
  
  public static function set ( $name, $value, $expiry = self :: THIRTY_DAYS ) {
    $cookieIsSet = false;
    if ( ! headers_sent ( ) ) {
      
      if ( is_numeric ( $expiry ) ) {
        $expiry += time ( );
      } else {
        $expiry = strtotime ( $expiry );
      }
      
      $cookieIsSet = @setcookie ( $name, $value, $expiry );
    }
    
    return $cookieIsSet;
  }
  
  public static function delete ( $name ) {
    $cookieIsSet = false;
    if ( ! headers_sent ( ) ) {
      $cookieIsSet = @setcookie( $name, '', 1 );
    }
    
    return $cookieIsSet;
  }
}

?>
