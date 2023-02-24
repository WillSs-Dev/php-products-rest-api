<?php
class DbConnection
{
  private $host;
  private $user;
  private $pass;
  private $db_name;
  private $port;
  private $db = null;

  public function __construct()
  {
    $this->host = getenv('MYSQLHOST');
    $this->user = getenv('MYSQLUSER');
    $this->pass = getenv('MYSQLPASSWORD');
    $this->db_name = getenv('MYSQLDATABASE');
    $this->port = getenv('MYSQLPORT');
  }

  public function connect()
  {
    try {
      $this->db = new PDO("mysql:host=$this->host;dbname=$this->db_name;port=$this->port", $this->user, $this->pass);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Connection Error: " . $e->getMessage();
    }
    return $this->db;
  }
}
