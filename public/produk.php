<?php
require_once "../config/database.php";
require_once "../src/ProductRepository.php";

$productRepo = new ProductRepository($pdo);
$products = $productRepo->getAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk (Tabel)</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #1e88e5;
            color: #fff;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }
        .btn-edit, .btn-delete {
            padding: 5px 10px;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            margin-right: 5px;
        }
        .btn-edit { background-color: #F14A00; }
        .btn-edit:hover { background-color: #c13a00; }
        .btn-delete { background-color: #3A0519; }
        .btn-delete:hover { background-color: #290415; }
        .add-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            background-color: #1e88e5;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }
        .add-btn:hover { background-color: #1565c0; }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align:center;">Daftar Produk</h1>
        <a href="create.php" class="add-btn">+ Tambah Produk</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($products) > 0): ?>
                    <?php foreach($products as $index => $product): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td>
                                <?php 
                                $imgPath = "../uploads/" . ($product['image'] ?? '');
                                if (!empty($product['image']) && file_exists($imgPath)): ?>
                                    <img src="<?= $imgPath ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                                <?php else: ?>
                                    No Image
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td>Rp <?= number_format($product['price'], 0, ',', '.') ?></td>
                            <td>
                                <a href="edit.php?id=<?= $product['id'] ?>" class="btn-edit">Edit</a>
                                <a href="delete.php?id=<?= $product['id'] ?>" class="btn-delete" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">Tidak ada produk</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
