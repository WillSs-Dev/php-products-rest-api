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
      $products_arr = array();

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $product_item = array(
          'id' => $id,
          'name' => $name,
          'price' => $price
        );
        array_push($products_arr, $product_item);
      }

      echo json_encode($products_arr);
    } else {
      echo json_encode(array('message' => 'No products found'));
    }
  }
}

?>
