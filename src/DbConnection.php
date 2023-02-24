<?php
  class DbConnection{
    private $host = "localhost";
    private $user = "Willian";
    private $pass = '12345';
    private $db = null;

    public function connect() {
      try {
        $this->db = new PDO("mysql:host=$this->host;dbname=store", $this->user, $this->pass);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo "Connection Error: " . $e->getMessage();
      }
      return $this->db;
    }
  }

?>
