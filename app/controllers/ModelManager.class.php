<?php

namespace app\controllers;

abstract class ModelManager {

  // ------------ ATTRIBUTES ------------ //

  protected $_db;

  // ------------ CONSTRUCTORS ------------ //

  public function __construct ( $db ) {
    $this -> setDatabase ( $db );
  }

  // ------------ METHODS ------------ //
  
  public abstract function save ( );
  
  public abstract function delete ( );
  
  
  
  // ------------ SETTERS ------------ //
  
  public function setDatabase ( $db ) {
    if ( is_null ( $db ) ) {
      throw new Exception( 'Databse is null ' );
    } else {
      $this -> _db = $db;
    }
  }
  
}

?>