<?php
class ProductRepository {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $category, $price, $stock, $status, $image_path) {
        $stmt = $this->pdo->prepare("INSERT INTO products (name, category, price, stock, status, image_path) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $category, $price, $stock, $status, $image_path]);
    }

    public function update($id, $name, $category, $price, $stock, $status, $image_path = null) {
        if ($image_path) {
            $stmt = $this->pdo->prepare("UPDATE products SET name=?, category=?, price=?, stock=?, status=?, image_path=? WHERE id=?");
            $stmt->execute([$name, $category, $price, $stock, $status, $image_path, $id]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE products SET name=?, category=?, price=?, stock=?, status=? WHERE id=?");
            $stmt->execute([$name, $category, $price, $stock, $status, $id]);
        }
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id=?");
        $stmt->execute([$id]);
    }
}
?>
