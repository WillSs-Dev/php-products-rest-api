<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header("Access-Control-Max-Age", "3600");
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Access-Control-Allow-Credentials", "true");

class AutoLoad
{

  public function __construct()
  {
    spl_autoload_register(function ($class_name) {
      $sources = [
        'src/' . $class_name . '.php',
        'src/domain/' . $class_name . '.php',
        'src/controllers/' . $class_name . '.php',
        'src/services/' . $class_name . '.php',
        'src/models/' . $class_name . '.php',
        'src/db/' . $class_name . '.php',
      ];

      foreach ($sources as $source) {
        if (file_exists($source)) {
          require_once $source;
        }
      }
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
