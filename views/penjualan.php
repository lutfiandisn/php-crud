<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} else {
    header('Location:' . BASE_URL . 'views/auth/login.php');
}
require_once('../controllers/productController.php');

$productController = new ProductController();
$daftarPenjualan = $productController->getAllPenjualanProduct();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>System Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">System Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pembelian.php">Pembelian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-primary" aria-current="page" href="penjualan.php">Penjualan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="analisa.php">Analisa</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <a href="../process/logout.php" class="btn btn-outline-danger ml-auto">Logout</a>
                </form>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h2>Daftar Penjualan</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Product</th>
                    <th>Jumlah</th>
                    <th>Harga Jual Satuan</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($penjualan = mysqli_fetch_assoc($daftarPenjualan)): ?>
                    <tr>
                        <td><?php echo $penjualan['idPenjualan']; ?></td>
                        <td><?php echo $penjualan['nama']; ?></td>
                        <td><?php echo $penjualan['jumlahTerjual']; ?></td>
                        <td><?php echo $penjualan['hargaJualPerSatuan']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>