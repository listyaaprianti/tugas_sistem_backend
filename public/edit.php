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

    $image = $product['image'];
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $image);
    }

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
    <h2>Edit Produk</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Nama Produk:</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br><br>

        <label>Harga:</label><br>
        <input type="number" name="price" value="<?= $product['price'] ?>" required><br><br>

        <label>Gambar:</label><br>
        <img src="../uploads/<?= $product['image'] ?>" width="100"><br>
        <input type="file" name="image"><br><br>

        <button type="submit">Update</button>
    </form>
    <a href="index.php">Kembali</a>
</body>
</html>
