<?php
require_once "../config/database.php";
require_once "../src/ProductRepository.php";

$productRepo = new ProductRepository($pdo);

$id = $_GET['id'] ?? null;
if($id){
    $productRepo->delete($id);
}

header("Location: index.php");
exit();
