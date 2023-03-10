<?php

class ProductsModel
{
  private $db;

  public function __construct()
  {
    $db = new DbConnection();
    $this->db = $db->connect();
  }

  public function get_all()
  {
    $query = "SELECT P.sku, P.name, P.price,C.category_name, P.attr_value FROM products AS P INNER JOIN categories AS C WHERE P.category_id = C.id GROUP BY P.id;";

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt;
  }

  public function find_by_sku($sku)
  {
    $query = "SELECT * FROM products WHERE sku = :sku";

    $stmt = $this->db->prepare($query);
    $stmt->execute(['sku' => $sku]);

    return $stmt;
  }

  public function create($product)
  {
    $query = "INSERT INTO products (sku, name, price, category_id, attr_value) VALUES (:sku, :name, :price, :category_id, :attr_value)";

    $stmt = $this->db->prepare($query);
    
    $stmt->execute([
      'sku' => $product->sku,
      'name' => $product->name,
      'price' => $product->price,
      'category_id' => $product->category_id,
      'attr_value' => $product->attr_value,
    ]);
  }

  public function delete($sku)
  {
    $query = "DELETE FROM products WHERE sku = :sku";

    $stmt = $this->db->prepare($query);
    $stmt->execute(['sku' => $sku]);
  }
}
