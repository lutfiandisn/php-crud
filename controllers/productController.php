<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../models/product.php');

class ProductController {
    public function addProduct($data) {
        if (isset($_SESSION['id'])) {
            $userId = $_SESSION['id'];
            return Product::add($data['nama'], $data['jumlah'], $data['hargaBeli'], $data['hargaJual'], $data['keterangan'], $userId);
        }
        return false;
    }

    public function getProducts() {
        return Product::getAll();
    }

    public function getProductById($idProduct) {
        return Product::getById($idProduct);
    }

    public function updateProduct($idProduct, $data) {
        return Product::update($idProduct, $data['nama'], $data['jumlah'], $data['hargaBeli'], $data['hargaJual'], $data['keterangan']);
    }

    public function deleteProduct($idProduct) {
        return Product::delete($idProduct);
    }

    public function restockProduct($idProduct, $data) {
        if (isset($_SESSION['id'])) {
            $userId = $_SESSION['id'];
            return Product::restockProduct($idProduct, $data['jumlah'], $data['hargaBeli'], $userId);
        }
        return false;
    }

    public function jualProduct($idProduct, $data)
    {
        if (isset($_SESSION['id'])) {
            $userId = $_SESSION['id'];
            return Product::jualProduct($idProduct, $data['jumlah'], $data['hargaJual'], $userId);
        }
        return false;
    }

    public function getAllPembelianProduct() {
        return Product::getAllPembelianProduct();
    }

    public function getAllPenjualanProduct()
    {
        return Product::getAllPenjualanProduct();
    }

    public function getAnalisaLabaRugi() {
        return Product::getAnalisaLabaRugi();
    }
}
?>
