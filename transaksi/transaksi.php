<?php
session_start();
require "../functions.php";

if(!isset($_SESSION['id'])){
    echo "<script>
        alert('Login Terlebih Dahulu');
        window.location = '../index.php';
        </script>";
        exit();
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(catat_transaksi()){
        echo "<script>
        alert('Transaksi Berhasil di Tambah');
        window.location = '../dashboard.php';
        </script>";
    }else{
        echo "<script>
        alert('Transaksi Gagal di Tambah');
        window.location = '../transaksi.php';
        </script>";
    }
}

$tampil_transaksi = tampil_transaksi();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Transaksi - Warung Soto Santri</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<nav class="navigasi">
    <div class="navbar-links">
        <a href="../dashboard.php">Kembali ke Dashboard</a>
    </div>
        </nav>
    <div class="boxes-catat">
    <div class="boxes-catat-transaksi-judul">
<h2>Catat Transaksi</h2>
<div class="boxes-catat-transaksi">
<form method="post">
    <label for="nama_barang">Nama Barang:</label>
    <input type="text" name="nama_barang" required>
    <label for="jumlah">Jumlah:</label>
    <input type="number" name="jumlah" required>
    <label for="harga_satuan">Harga Satuan:</label>
    <input type="number" name="harga_satuan" required>
    <button type="submit" name="submit">Catat Transaksi</button>
</form>
</div>
</div>
<footer>
        <p>&copy; 2024 by Habib Husain Nurrohim. All rights reserved.</p>
    </footer>
</body>
</html>