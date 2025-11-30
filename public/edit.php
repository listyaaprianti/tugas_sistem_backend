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
    $price = $_POST['price'];

    // Ambil gambar lama
    $image = $product['image_path'] ?? null;

    // Jika upload gambar baru
    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $image);
    }

    // Update produk
    $productRepo->update($id, $name, $price, $image);

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

            <label>Harga:</label>
            <input type="number" name="price" value="<?= $product['price'] ?>" required>

            <label>Gambar:</label>
            <?php 
            $imgPath = "../uploads/" . ($product['image_path'] ?? '');
            if (!empty($product['image_path']) && file_exists($imgPath)): ?>
                <img src="<?= $imgPath ?>" width="150" alt="<?= htmlspecialchars($product['name']) ?>">
            <?php else: ?>
                <div class="no-image">No Image</div>
            <?php endif; ?>
            <input type="file" name="image">

            <button type="submit">Update</button>
        </form>
        <a href="index.php">Kembali</a>
    </div>
</body>
</html>
