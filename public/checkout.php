<?php
session_start();
if(isset($_SESSION['cart'])) unset($_SESSION['cart']);
?>
<h1>Checkout berhasil!</h1>
<a href="index.php">Kembali ke Produk</a>
