<?php

class WZDB {
  
  public static $PDO;
  
  public static function login() {
    
    try {
      self::$PDO = new PDO('mysql:dbname='.WZConfig::$DB_NAME.';host='.WZConfig::$DB_HOST, WZConfig::$DB_USER, WZConfig::$DB_PASSWORD);
    } catch (Exception $e) {
      echo 'Erreur base de donn&eacute;es : '.$e->getMessage();
      die();
    }
    
  }
  
  public static function logout() {
    
    self::$PDO = null;
    
  }
  
}

?>
