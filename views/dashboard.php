<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} else {
    header('Location:' . BASE_URL . 'views/auth/login.php');
}
require_once('../controllers/productController.php');

$productController = new ProductController();
$products = $productController->getProducts();
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
                        <a class="nav-link active text-primary" aria-current="page" href="dashboard.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pembelian.php">Pembelian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="penjualan.php">Penjualan</a>
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
        <h2>Daftar Produk</h2>
        <div class="container mx-0 px-0">
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#beliProdukModal">
                Tambah Produk
            </button>

            <div class="modal fade" id="beliProdukModal" tabindex="-1" aria-labelledby="beliProdukModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="../process/add_product.php" method="POST">

                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="beliProdukModalLabel">Tambah Produk Baru</h1>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama Produk</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                                </div>
                                <div class="form-group">
                                    <label for="hargaBeli">Harga Beli Satuan</label>
                                    <input type="number" class="form-control" id="hargaBeli" name="hargaBeli" required>
                                </div>
                                <div class="form-group">
                                    <label for="hargaJual">Harga Jual Satuan</label>
                                    <input type="number" class="form-control" id="hargaJual" name="hargaJual" required>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($product = mysqli_fetch_assoc($products)): ?>
                    <tr>
                        <td><?php echo $product['idProduct']; ?></td>
                        <td><?php echo $product['nama']; ?></td>
                        <td><?php echo $product['jumlah']; ?></td>
                        <td><?php echo $product['keterangan']; ?></td>
                        <td>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $product['idProduct']; ?>">Ubah</button>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#restockProdukModal">
                                Restock
                            </button>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#jualProdukModal">
                                Jual
                            </button>
                            <form action="../process/delete_product.php" method="POST" style="display:inline;">
                                <input type="hidden" name="idProduct" value="<?php echo $product['idProduct']; ?>">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal untuk restock produk -->
                    <div class="modal fade" id="restockProdukModal" tabindex="-1" aria-labelledby="restockProdukModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="../process/restock_product.php" method="POST">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="restockProdukModalLabel">Restock Produk</h1>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="idProduct" value="<?php echo $product['idProduct']; ?>">
                                        <div class="form-group">
                                            <label for="nama">Nama Produk</label>
                                            <input type="text" class="form-control" value="<?php echo $product['nama']; ?>" id="nama" name="nama" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="hargaBeli">Harga Beli Satuan</label>
                                            <input type="number" class="form-control" value="<?php echo $product['hargaBeli']; ?>" name="hargaBeli" disabled>
                                            <input type="hidden" name="hargaBeli" value="<?php echo $product['hargaBeli']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal untuk jual produk -->
                    <div class="modal fade" id="jualProdukModal" tabindex="-1" aria-labelledby="jualProdukModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="../process/jual_product.php" method="POST">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="jualProdukModalLabel">Jual Produk</h1>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="idProduct" value="<?php echo $product['idProduct']; ?>">
                                        <div class="form-group">
                                            <label for="nama">Nama Produk</label>
                                            <input type="text" class="form-control" value="<?php echo $product['nama']; ?>" id="nama" name="nama" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="hargaJual">Harga Jual Satuan</label>
                                            <input type="number" class="form-control" value="<?php echo $product['hargaJual']; ?>" name="hargaJual" disabled>
                                            <input type="hidden" name="hargaJual" value="<?php echo $product['hargaJual']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal untuk update produk -->
                    <div class="modal fade" id="updateModal<?php echo $product['idProduct']; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="../process/update_product.php" method="POST">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="updateModalLabel">Edit Produk</h1>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="idProduct" value="<?php echo $product['idProduct']; ?>">
                                        <div class="form-group">
                                            <label for="nama">Nama Produk</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $product['nama']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $product['jumlah']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="hargaBeli">Harga Beli</label>
                                            <input type="number" class="form-control" id="hargaBeli" name="hargaBeli" value="<?php echo $product['hargaBeli']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="hargaJual">Harga Jual</label>
                                            <input type="number" class="form-control" id="hargaJual" name="hargaJual" value="<?php echo $product['hargaJual']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" required><?php echo $product['keterangan']; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>