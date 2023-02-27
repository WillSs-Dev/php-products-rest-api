<?php

abstract class Product
{
  public $sku;
  public $name;
  public $price;
  public $category;

  public function __construct($sku, $name, $price, $category)
  {
    $this->sku = $sku;
    $this->name = $name;
    $this->price = $price;
    $this->category = $category;
  }

  abstract function set_attr_value($attr_value);
}
