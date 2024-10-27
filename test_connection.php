<?php
// Memasukkan file database.php untuk menggunakan koneksi
include 'functions/koneksi.php';

// Memeriksa apakah koneksi berhasil
if ($koneksi) {
    echo "Koneksi ke database berhasil!";
} else {
    echo "Koneksi ke database gagal: " . mysqli_connect_error();
}
?>