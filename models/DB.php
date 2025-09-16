<?php
class DB {
  private static $pdo = null;
  public static function conn() {
    if (self::$pdo === null) {
      $dsn = "mysql:host=localhost;dbname=cafeteria_pit;charset=utf8mb4";
      $user = "root"; $pass = "";
      $opts = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC];
      self::$pdo = new PDO($dsn, $user, $pass, $opts);
    }
    return self::$pdo;
  }
}