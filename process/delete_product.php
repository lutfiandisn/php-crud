<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../controllers/productController.php');

$productController = new ProductController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProduct = $_POST['idProduct'];
    if ($productController->deleteProduct($idProduct)) {
        header("Location: ../views/dashboard.php?page=product&success=delete");
    } else {
        header("Location: ../views/dashboard.php?page=product&error=delete");
    }
}
?>
