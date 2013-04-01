<?php

namespace app\models;

class User extends Model {
  
  // ------------ ATTRIBUTES ------------ //

  public static $AUTHORIZED_KEYS = array ( 'login', 'password', 'email' );
  
  // ------------ CONSTRUCTORS ------------ //
  
  /**
   * 
   * @param array $data
   * Mandatory keys are : 'login', 'password' and 'email'.
   */
  public function __construct ( array $data ) {
    parent::__construct ( $data, self::$AUTHORIZED_KEYS );
  }
  
  // ------------ GETTERS ------------ //
  
  // ------------ SETTERS ------------ //
  
  public function __set ( $name, $value ) {
    parent::__set ( $name, $name == 'password' ? md5 ( $value ) : $value );
  }
  
  public function setData ( array $data ) {
    foreach ( $data as $key => $value ) {
      if ( $key === 'password' ) {
        $data[$key] = md5 ( $value );
      }
    } 
    parent::setData ( $data );
  }
}

?>