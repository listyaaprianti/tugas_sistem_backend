<?php

class ProductRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Ambil semua produk
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM products ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil produk berdasarkan ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah produk baru
    public function create($name, $price, $image_path) {
        $stmt = $this->pdo->prepare("INSERT INTO products (name, price, image_path) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $price, $image_path]);
    }

    // Update produk
    public function update($id, $name, $price, $image_path) {
        $stmt = $this->pdo->prepare("UPDATE products SET name = ?, price = ?, image_path = ? WHERE id = ?");
        return $stmt->execute([$name, $price, $image_path, $id]);
    }

    // Hapus produk
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
