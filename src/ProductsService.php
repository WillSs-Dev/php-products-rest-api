<?php

class ProductsService
{
  private $model;

  public function __construct()
  {
    $this->model = new ProductsModel();
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
      $response = [];
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        switch ($category_name) {
          case 'furniture':
            $product = new Furniture($sku, $name, $price, $category_name, $attr_value);
            break;
          case 'dvd':
            $product = new Dvd($sku, $name, $price, $category_name, $attr_value);
            break;
          case 'book':
            $product = new Book($sku, $name, $price, $category_name, $attr_value);
            break;
        }
        array_push($response, $product);
      }
      echo json_encode($response);
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
    $productRequest = new ProductRequest(json_decode($body));

    if ($this->sku_already_in_use($productRequest->sku)) {
      $this->handle_http_status(400);
      echo json_encode(['message' => 'SKU already in use']);
      return;
    }

    $this->model->create($productRequest);
    $this->handle_http_status(201);
    echo json_encode(['message' => 'Product created']);
  }
}
