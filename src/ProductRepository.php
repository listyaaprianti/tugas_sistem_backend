<?php

class ProductRepository {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM products ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO products (name, category, price, stock, image_path, status) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $data['name'], 
            $data['category'], 
            $data['price'], 
            $data['stock'], 
            $data['image_path'], 
            $data['status']
        ]);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare(
            "UPDATE products SET name=?, category=?, price=?, stock=?, image_path=?, status=? WHERE id=?"
        );
        $stmt->execute([
            $data['name'], 
            $data['category'], 
            $data['price'], 
            $data['stock'], 
            $data['image_path'], 
            $data['status'], 
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id=?");
        $stmt->execute([$id]);
    }
}
