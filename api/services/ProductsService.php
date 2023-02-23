<?php

class ProductsService
{
  private $model;

  public function __construct()
  {
    $db = new DbConnection();
    $this->model = new ProductModel($db->connect());
  }

  public function getAll()
  {
    $stmt = $this->model->getAll();
    $num = $stmt->rowCount();

    if ($num > 0) {
      echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    } else {
      echo json_encode(['message' => 'No products found']);
    }
  }

  private function skuAlreadyInUse($sku)
  {
    $stmt = $this->model->findBySku($sku);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? true : false;
  }

  public function create($body)
  {
    $product = json_decode($body);

    if ($this->skuAlreadyInUse($product->sku)) {
      echo json_encode(['message' => 'SKU already in use']);
      return;
    }

    $category_id = [
      'furniture' => 1,
      'dvd' => 2,
      'book' => 3,
    ];

    $product->category_id = $category_id[$product->category];

    $this->model->create($product);

    echo json_encode(['message' => 'Product created']);
  }
}
