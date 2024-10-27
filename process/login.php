<?php
require_once('../functions/helper.php');
require_once('../functions/koneksi.php');

// Menangkap request user
$username = $_POST['username'];
$password = md5($_POST['password']);

// Query untuk cek apakah pengguna adalah admin
$query = mysqli_query($koneksi, "SELECT * FROM user_app WHERE username = '$username' AND password = '$password'");

// Mengecek pengguna dan memastikan hanya admin yang bisa login
if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);

    // Cek apakah pengguna adalah admin
    if ($row['roleID'] == 1) { // roleID 1 untuk admin
        session_start();
        $_SESSION['id'] = $row['idUser']; // Sesuaikan dengan nama kolom yang benar
        $_SESSION['role'] = $row['roleID']; // Sesuaikan dengan nama kolom yang benar
        header("location: " . BASE_URL . 'views/dashboard.php?page=admin');
        exit;
    } else {
        // Bukan admin, kembali ke login dengan pesan error
        header("location: " . BASE_URL . "views/auth/login.php?error=not_admin");
        exit;
    }
} else {
    // Kredensial tidak cocok, kembali ke login dengan pesan error
    header("location: " . BASE_URL . "views/auth/login.php?error=invalid_credentials");
    exit;
}
?>
