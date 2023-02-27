<?php

class ProductRequest
{
  public $sku;
  public $name;
  public $price;
  public $category_id;
  public $attr_value;

  public function __construct($request_body)
  {
    $this->sku = $request_body->sku;
    $this->name = $request_body->name;
    $this->price = $request_body->price;
    $this->attr_value = $request_body->attr_value;
    $this->set_category_id($request_body->category);
  }

  public function set_category_id($category)
  {
    switch ($category) {
      case 'furniture':
        $this->category_id = 1;
        break;
      case 'dvd':
        $this->category_id = 2;
        break;
      case 'book':
        $this->category_id = 3;
        break;
    }
  }
}
