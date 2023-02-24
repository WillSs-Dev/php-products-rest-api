<?php
class DbConnection
{
  private $host;
  private $user;
  private $pass;
  private $db = null;

  public function __construct()
  {
    $this->host = getenv('DB_HOST');
    $this->user = getenv('DB_USER');
    $this->pass = getenv('DB_PASS');
  }

  public function connect()
  {
    try {
      $this->db = new PDO("mysql:host=$this->host;dbname=store", $this->user, $this->pass);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Connection Error: " . $e->getMessage();
    }
    return $this->db;
  }
}
