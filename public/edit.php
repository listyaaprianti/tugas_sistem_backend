<?php
require_once "../config/database.php";
require_once "../src/ProductRepository.php";

$productRepo = new ProductRepository($pdo);

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit();
}

$product = $productRepo->getById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $status = $_POST['status'];

    $image_path = $product['image_path'];
    if (!empty($_FILES['image']['name'])) {
        $image_path = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $image_path);
    }

    $productRepo->update($id, $name, $category, $price, $stock, $status, $image_path);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="form-container">
    <h2>Edit Produk</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Nama Produk:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

        <label>Kategori:</label>
        <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>" required>

        <label>Harga:</label>
        <input type="number" name="price" value="<?= $product['price'] ?>" required>

        <label>Stok:</label>
        <input type="number" name="stock" value="<?= $product['stock'] ?>" required>

        <label>Status:</label>
        <select name="status">
            <option value="active" <?= $product['status']=='active'?'selected':'' ?>>Active</option>
            <option value="inactive" <?= $product['status']=='inactive'?'selected':'' ?>>Inactive</option>
        </select>

        <label>Gambar:</label>
        <?php if($product['image_path']): ?>
            <img src="../uploads/<?= $product['image_path'] ?>" width="100" style="margin-bottom:10px;"><br>
        <?php endif; ?>
        <input type="file" name="image">

        <button type="submit">Update Produk</button>
        <a href="index.php">Kembali</a>
    </form>
</div>
</body>
</html>
