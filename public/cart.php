<?php
require_once "../config/database.php";
require_once "../src/ProductRepository.php";

$productRepo = new ProductRepository($pdo);
$products = $productRepo->getAll();

// Siapkan data untuk chart
$labels = [];
$dataPrice = [];

foreach ($products as $product) {
    $labels[] = $product['name'];
    $dataPrice[] = (float)$product['price'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chart Produk</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Grafik Harga Produk</h2>
    <canvas id="productChart" width="600" height="400"></canvas>

    <script>
        const ctx = document.getElementById('productChart').getContext('2d');
        const productChart = new Chart(ctx, {
            type: 'bar', // Bisa diganti line, pie, dll
            data: {
                labels: <?= json_encode($labels) ?>,
                datasets: [{
                    label: 'Harga Produk (Rp)',
                    data: <?= json_encode($dataPrice) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</body>
</html>
