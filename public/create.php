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

    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imagePath = time().'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$imagePath);
    }

    $productRepo->create([
        'name' => $name,
        'category' => $category,
        'price' => $price,
        'stock' => $stock,
        'image_path' => $imagePath,
        'status' => $status
    ]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>
    <h1>Tambah Produk</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Nama:</label><br>
        <input type="text" name="name" required><br>

        <label>Kategori:</label><br>
        <input type="text" name="category" required><br>

        <label>Harga:</label><br>
        <input type="number" name="price" required><br>

        <label>Stok:</label><br>
        <input type="number" name="stock" required><br>

        <label>Status:</label><br>
        <select name="status" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select><br>

        <label>Gambar:</label><br>
        <input type="file" name="image" accept="image/*"><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
