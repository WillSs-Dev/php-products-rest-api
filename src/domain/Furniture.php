<?php

class Furniture extends Product
{
  public $dimensions;

  public function __construct($sku, $name, $price, $category, $attr_value)
  {
    parent::__construct($sku, $name, $price, $category);
    $this->set_attr_value($attr_value);
  }

  public function set_attr_value($attr_value)
  {
    $this->dimensions = $attr_value;
  }
}
