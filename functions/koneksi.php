<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "php_crud";

// Membuat koneksi
$koneksi = mysqli_connect($server, $username, $password, $dbname);

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set karakter set untuk menghindari masalah karakter
mysqli_set_charset($koneksi, "utf8");
?>