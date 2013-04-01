<?php

namespace app\models;

class DatabaseConnector {

  // -------- CONSTANTS -------- //

  const PATH_TO_CONF_FILE = './config/config.ini';

  // -------- ATTRIBUTES -------- //
  
  private static $SINGLETON;
  
  private $_connection;
  private $_configuration;

  // -------- CONSTRUCTORS -------- //
  
  /**
   * Build a new DatabaseConnector object.
   * Initiate its configuration and connection attributes depending on the
   * configuration file content.
   */
  private function __construct ( ) {
    $confFile = parse_ini_file ( self :: PATH_TO_CONF_FILE );
    $this -> setConf ( $confFile );
    
    $dbConnection = $this -> connect ( );
    $this -> setConnection ( $dbConnection );
  }

  // -------- METHODS -------- //

  public static function getConnection ( ) {
    if ( self :: $SINGLETON === null ) {
      self :: $SINGLETON = new DatabaseConnector ( );
    }
    
    return self :: $SINGLETON -> _connection;
  }
    
  private function connect ( ) { 
    $conn = null;
    
    try {
      $conn = new \PDO ( 
        "mysql:host=" . $this -> _configuration['host'] 
        . ";dbname=" . $this -> _configuration['dbName']
        , $this -> _configuration['user']
        , $this -> _configuration['pwd']
      );
      
      $conn -> setAttribute ( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
    } catch ( Exception $e ) {
      echo 'Connection failed.';
    }
    
    return $conn;
  }

  // -------- SETTERS -------- //
  
  private function setConf ( $c ) {
    if ( is_null ( $c ) ) {
      throw new \Exception ( 'Configuration file is null.' );
    } else {
      $this -> _configuration = $c;
    }
  }
  
  private function setConnection ( $c ) {
    if ( is_null ( $c ) ) {
      throw new \Exception ( 'PDO connection is null.' );
    } else {
      $this -> _connection = $c;
    }
  }
}

?>