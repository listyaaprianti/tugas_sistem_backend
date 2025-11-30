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
    <h1>Daftar Produk</h1>
    <a href="create.php" class="btn-add">+ Tambah Produk</a>

    <div class="product-container">
        <?php foreach($products as $product): ?>
            <div class="product-card">
                <?php if($product['image_path'] && file_exists("../uploads/".$product['image_path'])): ?>
                    <img src="../uploads/<?= htmlspecialchars($product['image_path']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                <?php else: ?>
                    <img src="assets/img/no-image.png" alt="No Image">
                <?php endif; ?>
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p><strong>Kategori:</strong> <?= htmlspecialchars($product['category']) ?></p>
                <p><strong>Harga:</strong> Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                <p><strong>Stok:</strong> <?= $product['stock'] ?></p>
                <p><strong>Status:</strong> 
                    <?php if($product['status'] === 'active'): ?>
                        <span class="status ready">Active</span>
                    <?php else: ?>
                        <span class="status out">Inactive</span>
                    <?php endif; ?>
                </p>
                <a href="edit.php?id=<?= $product['id'] ?>" class="btn-edit">Edit</a>
                <a href="delete.php?id=<?= $product['id'] ?>" class="btn-delete" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
