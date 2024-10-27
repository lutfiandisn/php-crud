<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../controllers/productController.php');

$productController = new ProductController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProduct = $_POST['idProduct'];
    $data = [
        'nama' => $_POST['nama'],
        'jumlah' => $_POST['jumlah'],
        'hargaBeli' => $_POST['hargaBeli'],
    ];

    if ($productController->restockProduct($idProduct, $data)) {
        header("Location: ../views/dashboard.php?page=product&success=add");
    } else {
        header("Location: ../views/dashboard.php?page=product&error=add");
    }
}
?>
