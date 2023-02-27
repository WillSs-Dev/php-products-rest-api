<?php

  class Book extends Product
  {
    public $weight;

    public function __construct($sku, $name, $price, $category, $attr_value)
    {
      parent::__construct($sku, $name, $price, $category);
      $this->set_attr_value($attr_value);
    }

    public function set_attr_value($attr_value)
    {
      $this->weight = $attr_value . 'kg';
    }
  }