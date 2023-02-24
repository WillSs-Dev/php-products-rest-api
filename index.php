<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');

class AutoLoad
{

  private $endpoint;

  public function __construct()
  {
    spl_autoload_register(function ($class_name) {
      include 'src/' . $class_name . '.php';
    });

    $this->endpoint = $_SERVER["REQUEST_URI"];
    $this->getController();
  }

  public function getController()
  {
    switch ($this->endpoint) {
      case '/products':
        new ProductsController();
        break;
    }
  }
}

new AutoLoad();
