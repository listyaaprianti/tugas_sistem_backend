<?php
require_once "../config/database.php";
require_once "../src/ProductRepository.php";

$productRepo = new ProductRepository($pdo);

$id = $_GET['id'] ?? null;
if ($id) {
    // Hapus gambar dulu
    $product = $productRepo->getById($id);
    if ($product && file_exists("../uploads/" . $product['image'])) {
        unlink("../uploads/" . $product['image']);
    }

    $productRepo->delete($id);
}

header("Location: index.php");
exit();
