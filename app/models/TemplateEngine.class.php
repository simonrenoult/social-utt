<?php

namespace app\models;

class TemplateEngine {
  
  // ------------ CONSTANTS ------------ //
  
  const TEMPLATE_DIR = './app/views/';
  
  // ------------ ATTRIBUTES ------------ //
  
  private $_vars;
  
  // ------------ CONSTRUCTORS ------------ //
  
  public function __construct () {
    $this -> _vars = array ( );
  }
  public function __get ( $name ) {
    return $this -> _vars[$name];
  }
  
  public function __set ( $name, $value ) {
    $this -> _vars[$name] = $value;
  }
    
  // ------------ METHODS ------------ //
  
  
  public function runOn ( $template_file ) {
    $path = self :: TEMPLATE_DIR . $template_file;
    if ( file_exists ( $path ) ) {
      include $path;
    } else {
      throw new \Exception( 'Template file not found for : ' . $template_file, 404 );
    }
  }
}

?>
