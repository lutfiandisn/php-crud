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
        'hargaJual' => $_POST['hargaJual'],
        'keterangan' => $_POST['keterangan'],
    ];

    if ($productController->updateProduct($idProduct, $data)) {
        header("Location: ../views/dashboard.php?page=product&success=update");
    } else {
        header("Location: ../views/dashboard.php?page=product&error=update");
    }
}
?>
