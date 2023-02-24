<?php

class ProductsService
{
  private $model;

  public function __construct()
  {
    $db = new DbConnection();
    $this->model = new ProductsModel($db->connect());
  }

  private function handle_http_status($status_code)
  {
    $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
    header($protocol . ' ' . $status_code);
  }

  public function get_all()
  {
    $stmt = $this->model->get_all();
    $num = $stmt->rowCount();

    if ($num > 0) {
      $this->handle_http_status(200);
      echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    } else {
      $this->handle_http_status(404);
      echo json_encode(['message' => 'No products found']);
    }
  }

  private function sku_already_in_use($sku)
  {
    $stmt = $this->model->find_by_sku($sku);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? true : false;
  }

  public function create($body)
  {
    $product = json_decode($body);

    if ($this->sku_already_in_use($product->sku)) {
      $this->handle_http_status(400);
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
    $this->handle_http_status(201);
    echo json_encode(['message' => 'Product created']);
  }
}
