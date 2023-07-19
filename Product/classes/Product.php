<?php

class Product
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllProducts()
    {
        $stmt = $this->conn->query('SELECT * FROM products');
        return $stmt->fetchAll();
    }

    public function getProduct($productId)
    {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $productId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createProduct($name, $price, $categoryId)
    {
        $stmt = $this->conn->prepare('INSERT INTO products (name, price, category_id) VALUES (?, ?, ?)');
        $stmt->execute([$name, $price, $categoryId]);
    }

    public function updateProduct($productId, $name, $price, $categoryId)
    {
        $query = "UPDATE products SET name = :name, price = :price, category_id = :category_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->bindParam(':id', $productId);
        $stmt->execute();
    }

    public function deleteProduct($id)
    {
        $stmt = $this->conn->prepare('DELETE FROM products WHERE id = ?');
        $stmt->execute([$id]);
    }
}
