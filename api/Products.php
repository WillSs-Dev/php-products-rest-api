<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');

include_once 'models/ProductsModel.php';
include_once 'services/ProductsService.php';
include_once 'config/DbConnection.php';

class ProductController{
  private $service;
  private $method;

  public function __construct() {
    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->handle_request();
  }

  public function handle_request() {
    switch ($this->method) {
      case 'GET':
        $this->get();
        break;
    }
  }

  public function get() {
    $this->service = new ProductsService();
    $result = $this->service->getAll();
    echo $result;
  }
}

new ProductController();

?>
