<?php
require_once "../config/database.php";
require_once "../src/ProductRepository.php";

$productRepo = new ProductRepository($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $image);
    }

    $productRepo->create($name, $price, $image);
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
            <input type="text" name="name" required>

            <label>Harga:</label>
            <input type="number" name="price" required>

            <label>Gambar:</label>
            <input type="file" name="image" required>

            <button type="submit">Simpan</button>
        </form>
        <a href="index.php">Kembali</a>
    </div>
</body>
</html>
