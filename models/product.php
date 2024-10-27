<?php
require_once('../functions/koneksi.php');

class Product {
    public static function add($nama, $jumlah, $hargaBeli, $hargaJual, $keterangan, $userId)
    {
        global $koneksi;
        $nama = mysqli_real_escape_string($koneksi, $nama);
        $keterangan = mysqli_real_escape_string($koneksi, $keterangan);
        $jumlah = mysqli_real_escape_string($koneksi, $jumlah);
        $hargaBeli = mysqli_real_escape_string($koneksi, $hargaBeli);
        $hargaJual = mysqli_real_escape_string($koneksi, $hargaJual);
        $userId = (int)$userId;

        $query1 = "INSERT INTO Product (nama, jumlah, hargaBeli, hargaJual, keterangan, userId) VALUES ('$nama', '$jumlah', '$hargaBeli', '$hargaJual', '$keterangan', $userId)";
        $result1 = mysqli_query($koneksi, $query1);

        if ($result1) {
            $idProduct = mysqli_insert_id($koneksi);
            $now = date('Y-m-d H:i:s');

            $query2 = "INSERT INTO Pembelian (idProduct, jumlahPembelian, hargaBeliPerSatuan, userId, tanggalTransaksi) VALUES ('$idProduct', '$jumlah', '$hargaBeli', $userId, '$now')";
            $result2 = mysqli_query($koneksi, $query2);
            
            return $result2;
        } else {
            return false;
        }
    }

    public static function getAll() {
        global $koneksi;
        $query = "SELECT * FROM Product";
        return mysqli_query($koneksi, $query);
    }

    public static function getById($idProduct) {
        global $koneksi;
        $idProduct = (int)$idProduct; // Pastikan idProduct adalah integer
        $query = "SELECT * FROM Product WHERE idProduct = $idProduct";
        return mysqli_query($koneksi, $query);
    }

    public static function update($idProduct, $nama, $jumlah, $hargaBeli, $hargaJual, $keterangan) {
        global $koneksi;
        $idProduct = (int)$idProduct; // Pastikan idProduct adalah integer
        $nama = mysqli_real_escape_string($koneksi, $nama);
        $jumlah = mysqli_real_escape_string($koneksi, $jumlah);
        $hargaBeli = mysqli_real_escape_string($koneksi, $hargaBeli);
        $hargaJual = mysqli_real_escape_string($koneksi, $hargaJual);
        $keterangan = mysqli_real_escape_string($koneksi, $keterangan);

        $query1 = "UPDATE Pembelian SET hargaBeliPerSatuan = '$hargaBeli' WHERE idProduct = $idProduct";
        $result1 = mysqli_query($koneksi, $query1);

        if ($result1) {
            $query2 = "UPDATE Product SET nama = '$nama', jumlah = '$jumlah', hargaBeli = '$hargaBeli', hargaJual = '$hargaJual', keterangan = '$keterangan' WHERE idProduct = $idProduct";
            $result2 = mysqli_query($koneksi, $query2);

            return $result2;
        } else {
            return false;
        }
    }

    public static function delete($idProduct) {
        global $koneksi;
        $idProduct = (int)$idProduct; // Pastikan idProduct adalah integer
        $query1 = "DELETE FROM Pembelian WHERE idProduct = $idProduct";
        $result1 = mysqli_query($koneksi, $query1);

        if ($result1) {
            $query2 = "DELETE FROM Product WHERE idProduct = $idProduct";
            $result2 = mysqli_query($koneksi, $query2);

            return $result2;
        } else {
            return false;
        }
    }

    public static function restockProduct($idProduct, $jumlah, $hargaBeli, $userId) {
        global $koneksi;
        $idProduct = (int)$idProduct; 
        $jumlah = mysqli_real_escape_string($koneksi, $jumlah);
        $hargaBeli = mysqli_real_escape_string($koneksi, $hargaBeli);
        $userId = (int)$userId;

        $now = date('Y-m-d H:i:s');
        $query1 = "INSERT INTO Pembelian (idProduct, jumlahPembelian, hargaBeliPerSatuan, userId, tanggalTransaksi) VALUES ($idProduct, '$jumlah', '$hargaBeli', $userId, '$now')";
        $result1 =  mysqli_query($koneksi, $query1);

        if ($result1) {
            $query2 = "UPDATE Product SET jumlah = jumlah + '$jumlah' WHERE idProduct = $idProduct";
            $result2 = mysqli_query($koneksi, $query2);

            return $result2;
        } else {
            return false;
        }
    }

    public static function jualProduct($idProduct, $jumlah, $hargaJual, $userId)
    {
        global $koneksi;
        $idProduct = (int)$idProduct;
        $jumlah = mysqli_real_escape_string($koneksi, $jumlah);
        $hargaJual = mysqli_real_escape_string($koneksi, $hargaJual);
        $userId = (int)$userId;

        $now = date('Y-m-d H:i:s');
        $query1 = "INSERT INTO Penjualan (idProduct, jumlahTerjual, hargaJualPerSatuan, userId, tanggalTransaksi) VALUES ($idProduct, '$jumlah', '$hargaJual', $userId, '$now')";
        $result1 =  mysqli_query($koneksi, $query1);

        if ($result1) {
            $query2 = "UPDATE Product SET jumlah = jumlah - '$jumlah' WHERE idProduct = $idProduct";
            $result2 = mysqli_query($koneksi, $query2);

            return $result2;
        } else {
            return false;
        }
    }

    public static function getAllPembelianProduct() {
        global $koneksi;
        $query = "SELECT idPembelian, pr.nama, pe.jumlahPembelian, pe.hargaBeliPerSatuan FROM Pembelian pe LEFT JOIN Product pr ON pe.idProduct = pr.idProduct";
        return mysqli_query($koneksi, $query);
    }

    public static function getAllPenjualanProduct()
    {
        global $koneksi;
        $query = "SELECT idPenjualan, pr.nama, pe.jumlahTerjual, pe.hargaJualPerSatuan FROM Penjualan pe LEFT JOIN Product pr ON pe.idProduct = pr.idProduct";
        return mysqli_query($koneksi, $query);
    }

    public static function getAnalisaLabaRugi()
    {
        global $koneksi;
        $query = "SELECT p.nama AS namaProduct, IFNULL(SUM(pe.jumlahTerjual * pe.hargaJualPerSatuan),0) AS totalPenjualan, IFNULL(SUM(pb.jumlahPembelian * pb.hargaBeliPerSatuan),0) AS totalPembelian, (IFNULL(SUM(pe.jumlahTerjual * pe.hargaJualPerSatuan),0) - IFNULL(SUM(pb.jumlahPembelian * pb.hargaBeliPerSatuan),0)) AS labaRugi FROM product p LEFT JOIN penjualan pe ON p.idProduct = pe.idProduct LEFT JOIN pembelian pb ON p.idProduct = pb.idProduct GROUP BY p.idProduct;";
        return mysqli_query($koneksi, $query);
    }
}
?>
