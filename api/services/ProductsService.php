<?php

class ProductsService
{
  private $model;

  public function __construct() {
    $db = new DbConnection();
    $this->model = new ProductModel($db->connect());
  }

  public function getAll() {
    $stmt = $this->model->getAll();
    $num = $stmt->rowCount();
    
    if ($num > 0) {
      echo(json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)));
    } else {
      echo json_encode(['message' => 'No products found']);
    }
  }
}
