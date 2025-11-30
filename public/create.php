<?php
require_once "../config/database.php";
require_once "../src/ProductRepository.php";

$productRepo = new ProductRepository($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $status = $_POST['status'];

    $image_path = null;
    if (!empty($_FILES['image']['name'])) {
        $image_path = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $image_path);
    }

    $productRepo->create($name, $category, $price, $stock, $status, $image_path);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="form-container">
    <h2>Tambah Produk</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Nama Produk:</label>
        <input type="text" name="name" placeholder="Masukkan nama produk" required>

        <label>Kategori:</label>
        <input type="text" name="category" placeholder="Masukkan kategori produk" required>

        <label>Harga:</label>
        <input type="number" name="price" placeholder="Masukkan harga" required>

        <label>Stok:</label>
        <input type="number" name="stock" placeholder="Masukkan stok" required>

        <label>Status:</label>
        <select name="status" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>

        <label>Gambar:</label>
        <input type="file" name="image">

        <button type="submit">Tambah Produk</button>
        <a href="index.php">Kembali</a>
    </form>
</div>
</body>
</html>
