<?php

namespace app\controllers;

use \app\models as Models;
use app\tools\HTTPResponse as HTTPResponse;
use app\tools\DatabaseConnector as DatabaseConnector;

class UserManager extends ModelManager {

  // ------------ CONSTANTS ------------ //
  
  public static $DELETION_FIELDS = array ( 'login', 'email' );
  
  // ------------ ATTRIBUTES ------------ //
  
  private $_user;
  
  // ------------ CONSTRUCTORS ------------ //
   
  public function __construct ( $db, $user ) {
    parent::__construct ( $db );
    $this -> setUser ( $user );
  }
  
  // ------------ METHODS ------------ //
 
  /**
   * 
   * TODO : handle PDO exception.
   * 
   * @return \HTTPResponse
   * @throws \Exception
   */
  public function save ( ) {
    if ( is_null ( $this -> _user ) ) {
      throw new \Exception ( 'User has not been defined.' );
    } else {
      $keysAsArray = array_keys ( $this -> _user -> getData ( ) );
      $keysAsString = implode ( ',', $keysAsArray );
      
      $sql = '
      INSERT INTO
        users ( ' . $keysAsString . ' )
      VALUES
        (?,?,?)
      ';

      $statement = $this -> _db -> prepare ( $sql );
      $httpCode = null;
      try {
        $statement -> execute ( array_values (  $this -> _user -> getData ( ) ) );
      } catch ( \PDOException $e ) {
        if ( $e -> errorInfor[1] == DatabaseConnector::DUPLICATE_ENTRY ) {
          // TODO Handle PDO Duplicate entry exception.
        }
      } 
      
      return new HTTPResponse ( HTTPResponse::CREATED, 'Resource has been saved.' );
    }
  }
  
  public function delete ( ) {
    if ( is_null ( $this -> _user ) ) {
      throw new \Exception ( 'User has not been defined.' );
    } else {
      // foreach ( $this -> getExistingTuple () as $field => $fieldValue ) break;
      $tuple = $this -> getExistingTuple ( );
      $field = key ( $tuple );
      $fieldValue = $tuple[$field];
      
      $sql = '
        DELETE FROM
          users
        WHERE
          ' . $field . ' = ?
      ';
      
      $statement = $this -> _db -> prepare ( $sql );
      $statement -> execute ( array ( $fieldValue ) );
    }
  }
  
  public function read ( $id = null ) {
    if ( is_null ( $id ) ) {
      return $this -> readFromMap ( );
    } else {
      return $this -> readFromId ( $id );
    }
  }
  
  private function readFromMap ( ) {
    if ( is_null ( $this -> _user ) ) {
      throw new \Exception ( 'User has not been defined.' );
    } else {
      $tuple = $this -> getExistingTuple ( );
      $field = key ( $tuple );
      $fieldValue = $tuple[$field];
      
      $sql = '
        SELECT * FROM
          users
        WHERE
          ' . $field . ' = ?
      ';
      
      $statement = $this -> _db -> prepare ( $sql );
      $statement -> execute ( array ( $fieldValue ) );
      $userData = $statement -> fetchAll ( );
      
      return new Models\User( $userData  );
    }
  }
  
  private function readFromId ( $id ) {
    if ( is_null ( $id ) ) {
      throw new \Exception ( 'ID is not defined.' );
    } else {
      $sql = '
        SELECT * FROM
          users
        WHERE
          id = ?
      ';
      
      $statement = $this -> _db -> prepare ( $sql );
      $statement -> execute ( array ( $id ) );
      $userData = $statement -> fetchAll ( );
      
      return new Models\User( $userData  );
    }
  }
  
  public function update ( $id = null ) {
    if ( is_null ( $id ) ) {
      return $this -> updateFromMap ( );
    } else {
      return $this -> updateFromId ( $id );
    }
  }
  
  private function updateFromMap ( ) {
    throw new Exception ( 'Not implemented yet.' );
  }
  
  private function updateFromId ( $id ) {
    throw new Exception ( 'Not implemented yet.' );
    if ( is_null ( $id ) ) {
      throw new \Exception ( 'ID is not defined.' );
    } else {
    }
  }
  
  private function getExistingTuple ( ) {
    foreach ( $this -> _user -> getData ( ) as $key => $value ) {
      if ( in_array ( $key, self::$DELETION_FIELDS ) ) {
        return array ( $key => $value );
      }
    }
  }
  
  // ------------ SETTERS ------------ //
  
  public function setUser ( Models\User $user ) {
    if ( is_null ( $user ) ) {
      throw new \Exception ( 'User has not been defined.' );
    } else {
      $this -> _user = $user;
    }
  }
}

?>