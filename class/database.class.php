<?php
date_default_timezone_set("Asia/Manila");
class Database{
  # set variables here.
  private static $dbName = 'visitmozilla';
  private static $host = 'localhost';
  private static $dbUsername = 'root';
  private static $dbPassword = '';
  private static $conn = null;

  public function __construct(){
  }

  public function connect(){
    if(self::$conn == null){
      try{
        self::$conn = new PDO("mysql:host=".self::$host.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbPassword);
      }
      catch(PDOException $e){
        die($e->getMessage());
      }
    }
    return self::$conn;
  }

  public function disconnect(){
    self::$conn = null;
  }
}
?>
