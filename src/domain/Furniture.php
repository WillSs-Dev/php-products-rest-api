<?php

class Furniture extends Product
{
  public $height;
  public $width;
  public $length;

  public function __construct($sku, $name, $price, $category, $attr_value)
  {
    parent::__construct($sku, $name, $price, $category);
    $this->set_attr_value($attr_value);
  }

  public function set_attr_value($attr_value)
  {
    $attr_value = explode('x', $attr_value);
    $this->height = $attr_value[0] . 'm';
    $this->width = $attr_value[1] . 'm';
    $this->length = $attr_value[2] . 'm';
  }
}
