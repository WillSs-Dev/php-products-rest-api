<?php

// pre-loads all classes

spl_autoload_register(function ($class_name) {
    include 'src/' . $class_name . '.php';
});

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');

new ProductsController();
