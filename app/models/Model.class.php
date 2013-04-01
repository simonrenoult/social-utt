<?php

namespace app\models;

/**
 * Description of Model
 *
 * @author g4llic4
 */
abstract class Model {
    
  // ------------ ATTRIBUTES ------------ //
    
  protected $_data;
  
  // ------------ CONSTRUCTORS ------------ //

  /**
   * Build a new model based on an associative arraty of data and the 
   * keys authorized by the model. 
   *
   * @param {Array} $data Content of the model.
   * @param {Array} $authorized_keys Keys used (and authorized) in $data.
   */
  protected function __construct ( Array $data, Array $authorized_keys ) {
    if ( $this -> keysAreAuthorized ( $authorized_keys, $data ) ) {
      $this -> setData ( $data );
    } else {
      throw new \Exception ( 'Unknown key found.' );
    }
  }
  
  // ------------ METHODS ------------ //
    
  /**
   * Check whether the $data array contains some unauthorized keys.
   . If so, return false, else true.
   *
   * @param {Array} $authorized_keys Array of authorized keys.
   * @param {Array} $data Associative array to test.
   * @return {Boolean} Whetehr the associative array contains unauthorized keys.
   */
  private function keysAreAuthorized ( Array $authorized_keys, Array $data ) {
    $isOk = true;
    foreach ( $data as $key => $val ) {
      if ( ! in_array ( $key, $authorized_keys ) ) {
        $isOk = false;
      }
    }
    
    return $isOk;
  }
  
  // ------------ GETTERS ------------ //  
  
  public function getData ( ) {
    return $this -> _data;
  }
  
  public function __get ( $name ) {
    return $this -> _data[$name];
  }
    
  // ------------ SETTERS ------------ //

  public function setData ( Array $data ) {
    $this -> _data = $data;
  }

  public function __set ( $name, $value ) {
    $this -> _data[$name] = $value;
  }
  
}

?>
