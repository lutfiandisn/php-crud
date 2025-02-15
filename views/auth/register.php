<?php
require_once(__DIR__ . "/../../functions/helper.php");
require_once(__DIR__ . "/../../functions/koneksi.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'assets/style.css' ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <!-- SweetAlert library -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="topbar">
        <h3 class="text-topbar">Binus</h3>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#344D67" fill-opacity="1" d="M0,192L60,192C120,192,240,192,360,208C480,224,600,256,720,261.3C840,267,960,245,1080,218.7C1200,192,1320,160,1380,144L1440,128L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
    </svg>

    <div class="content">
        <div class="card-login">
            <div class="card-main">
                <div class="card-header">Form Register</div>
                <div class="card-body">
                    <form class="form-login" method="POST" action="<?= BASE_URL . 'process/register.php' ?>">
                        <label class="form-label">Username</label>
                        <input type="username" name="username" class="form-input">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-input">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input">
                        <label class="form-label">address</label>
                        <input type="address" name="address" class="form-input">
                        <button type="submit" class="btn btn-login">Register</button>
                    </form>
                    <div class="register-link">
                        <?php if (isset($_GET['error'])): ?>
                            <p class="error-message">Username sudah terdaftar.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mengambil parameter dari URL jika terdapat parameter error
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');

        // Mengecek jika terdapat parameter error
        if (error) {
            // Menampilkan sweet alert dengan pesan error
            swal("Error", "Username or password is incorrect", "error");
        }
    </script>
</body>

</html>


