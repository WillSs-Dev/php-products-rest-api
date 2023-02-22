<?php

  class ProductModel{
    private $db;
    private $table = 'products';
    // public $id;
    // public $name;
    // public $price;

    public function __construct($db) {
      $this->db = $db;
    }

    public function getAll() {
      $query = 'SELECT * FROM ' . $this->table;
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      return $stmt;
    }

  }

?>