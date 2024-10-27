<?php
require_once('../functions/helper.php');
require_once('../functions/koneksi.php');

// Menangkap data dari form register
$username = $_POST['username'];
$password = md5($_POST['password']); // Menggunakan md5 untuk hashing password
$email = $_POST['email']; // Ganti dengan 'noTelf'
$address = $_POST['address']; // Ganti dengan 'alamat'
$roleID = 1; // Role ID untuk user

// Memasukkan data pengguna baru ke dalam database
$query = "INSERT INTO user_app (username, password, email, address, roleID) VALUES ('$username', '$password', '$email', '$address', '$roleID')";
$result = mysqli_query($koneksi, $query);

// Mengecek apakah pendaftaran berhasil
if ($result) {
    // Mengarahkan ke halaman login setelah pendaftaran sukses
    header("location: " . BASE_URL . "views/auth/login.php?success=1");
    exit;
} else {
    // Mengarahkan kembali ke halaman register dengan parameter error
    header("location: " . BASE_URL . "views/auth/register.php?error=true");
    exit;
}
?>
