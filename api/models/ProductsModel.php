<?php

class ProductModel
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function getAll()
  {
    $query = "SELECT P.sku, P.name, P.price,C.category_name, P.attr_value FROM products AS P INNER JOIN categories AS C GROUP BY P.id;";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  public function findBySku($sku)
  {
    $query = "SELECT * FROM products WHERE sku = :sku";
    $stmt = $this->db->prepare($query);
    $stmt->execute(['sku' => $sku]);
    return $stmt;
  }

  public function create($product)
  {
    $query = "INSERT IGNORE INTO products (sku, name, price, category_id, attr_value) VALUES (:sku, :name, :price, :category_id, :attr_value)";
    $stmt = $this->db->prepare($query);
    $stmt->execute([
      'sku' => $product->sku,
      'name' => $product->name,
      'price' => $product->price,
      'category_id' => $product->category_id,
      'attr_value' => $product->attr_value,
    ]);
  }
}
