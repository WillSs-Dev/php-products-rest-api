<?php

  class ProductModel{
    private $db;

    public function __construct($db) {
      $this->db = $db;
    }

    public function getAll() {
      $query = "SELECT P.sku, P.name, P.price,C.category_name, P.attr_value FROM products AS P INNER JOIN categories AS C;";
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      return $stmt;
    }

  }

?>