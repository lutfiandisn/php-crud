<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Menghapus semua variabel sesi
$_SESSION = array();

// Menghancurkan sesi
session_destroy();

// Mengalihkan pengguna kembali ke halaman login
header("Location: ../views/auth/login.php");
exit;
?>
