<?php

namespace app\models;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HTTPResponse
 *
 * @author g4llic4
 */
class HTTPResponse {

  // ------------ ATTRIBUTES ------------ //
  
  private $_httpCode;
  private $_message;
  
  // ------------ CONSTRUCTORS ------------ //
  
  public function __construct ( $httpCode, $message ) {
    $this -> setHttpCode ( $httpCode );
    $this -> setMessage ( $message );
  }
  
  public function setHttpCode ( $httpCode ) {
    $this -> _httpCode = $httpCode;
  }
  
  public function setMessage ( $message) {
    $this -> _message = $message;
  }
}

?>
