<?php
require_once "../config/database.php";
require_once "../src/ProductRepository.php";

$productRepo = new ProductRepository($pdo);
$products = $productRepo->getAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">

    <div class="header">
        <a href="create.php" class="btn-add">+ Tambah Produk</a>
        <h1>Daftar Produk</h1>
        <div></div> <!-- Placeholder agar header seimbang -->
    </div>

    <div class="product-container">
        <?php foreach($products as $product): ?>
            <div class="product-card">
                <img src="../uploads/<?= htmlspecialchars($product['image_path']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p><strong>Kategori:</strong> <?= htmlspecialchars($product['category']) ?></p>
                <p><strong>Harga:</strong> Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                <p><strong>Stok:</strong> <?= htmlspecialchars($product['stock']) ?></p>
                <p><strong>Status:</strong> 
                    <span class="status <?= $product['status'] ?>"><?= ucfirst($product['status']) ?></span>
                </p>
                <div class="card-buttons">
                    <a href="edit.php?id=<?= $product['id'] ?>" class="btn-edit">Edit</a>
                    <a href="delete.php?id=<?= $product['id'] ?>" class="btn-delete">Hapus</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
</body>
</html>
