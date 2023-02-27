<?php

class DVD extends Product
{
  public $size;

  public function __construct($sku, $name, $price, $category, $attr_value)
  {
    parent::__construct($sku, $name, $price, $category);
    $this->set_attr_value($attr_value);
  }

  public function set_attr_value($attr_value)
  {
    $this->size = $attr_value . 'MB';
  }
}
