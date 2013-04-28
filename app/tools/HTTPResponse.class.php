<?php

namespace app\tools;

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

  // ------------ CONSTANTS ------------ //
  
  const CONTENT_TYPE = "text/html; charset=UTF-8";
  
  const CREATED = 201;
  
  // ------------ ATTRIBUTES ------------ //
  
  private $_httpCode;
  private $_message;
  
  // ------------ CONSTRUCTORS ------------ //
  
  public function __construct ( $httpCode = null, $message = null) {
    $this -> setHttpCode ( $httpCode );
    $this -> setMessage ( $message );
  }
  
  // ------------ METHODS ------------ //
  
  public function toArray( ) {
    return array (
        "headers" => array ( 
          "content-type" => self :: CONTENT_TYPE,
          "status" => $this -> _httpCode,
        ), 
        "body" => $this -> _message
    );
  }
  
  // ------------ SETTERS ------------ //
  
  public function setHttpCode ( $httpCode ) {
    $this -> _httpCode = $httpCode;
  }
  
  public function setMessage ( $message ) {
    $this -> _message = $message;
  }
}

?>
