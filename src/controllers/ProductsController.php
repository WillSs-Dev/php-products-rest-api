<?php

class ProductsController
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
        break;
      case 'DELETE':
        $this->delete(file_get_contents('php://input'));
        break;
    }
  }

  public function get()
  {
    $result = $this->service->get_all();
    echo $result;
  }

  public function post($body)
  {
    $result = $this->service->create($body);
    echo $result;
  }

  public function delete($body)
  {
    $result = $this->service->mass_delete($body);
    echo $result;
  }
}
