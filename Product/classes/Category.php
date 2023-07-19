<?php

class Category
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllCategories()
    {
        $stmt = $this->conn->query('SELECT * FROM categories');
        return $stmt->fetchAll();
    }

    public function getCategory($categoryId)
    {
        $query = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $categoryId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createCategory($name)
    {
        $stmt = $this->conn->prepare('INSERT INTO categories (name) VALUES (?)');
        $stmt->execute([$name]);
    }

    public function updateCategory($categoryId, $name)
    {
        $query = "UPDATE categories SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $categoryId);
        $stmt->execute();
    }

    public function deleteCategory($id)
    {
        $stmt = $this->conn->prepare('DELETE FROM categories WHERE id = ?');
        $stmt->execute([$id]);
    }
}
