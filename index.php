<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json; charset=UTF-8');

class AutoLoad
{

  public function __construct()
  {
    spl_autoload_register(function ($class_name) {
      include 'src/' . $class_name . '.php';
    });

    $this->load_environtment();
    new ProductsController();
  }

  public function load_environtment()
  {
    if (file_exists('.env')) {
      $lines = file('.env');

      foreach ($lines as $line) {
        putenv(trim($line));
      }
    }
  }
}

new AutoLoad();
