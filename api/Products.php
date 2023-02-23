<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');

include_once 'models/ProductsModel.php';
include_once 'services/ProductsService.php';
include_once 'config/DbConnection.php';

class ProductController
{
  private $service;
  private $method;

  public function __construct()
  {
    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->service = new ProductsService();
    $this->handle_request();
  }

  public function handle_request()
  {
    switch ($this->method) {
      case 'GET':
        $this->get();
        break;
      case 'POST':
        $this->post(file_get_contents('php://input'));
    }
  }

  public function get()
  {
    $result = $this->service->getAll();
    echo $result;
  }

  public function post($body)
  {
    $result = $this->service->create($body);
    echo $result;
  }
}

new ProductController();
