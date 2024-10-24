<?php
session_start();
require "functions.php";

if(!isset($_SESSION['id'])){
    echo "<script>
    alert('Login Terlebih Dahulu');
    window.location = 'index.php';
    </script>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Warung Soto Santri</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar">
        <div class="navbar-links">
            <a href="logout.php" onclick="return confirm('Yakin Mau logout???')">Logout</a>
        </div>
    </nav>
    <div class="content-dashboard">
    <div class="content-dashboard-judul">
        <h1>Dashboard Warung Soto Santri</h1>
    </div>
    <div class="content-dashboard-box">
    <ul>
        <li><a href="produk/produk.php">Tambah Produk</a></li>
        <li><a href="stock.php">Catat stock</a></li>
        <li><a href="transaksi/transaksi.php">Catat Transaksi</a></li>
        <li><a href="pengeluaran.php">Catat Pengeluaran</a></li>
        <li><a href="transaksi/laporan.php">Lihat Laporan</a></li>
    </ul>
    </div>
    </div>

    <div class="box-omzet">
        <div class="box-total-omzet">
            <h2>Total Pemasukan dan Pengeluaran</h2>
            <p>
                <?php
                $total_pemasukan = total_pemasukan()['total_pemasukan'] ?? 0;
                $total_pengeluaran = total_pengeluaran()['total_pengeluaran'] ?? 0;
                $saldo = total_saldo();

                echo "Total Pemasukan Anda: Rp " . number_format($total_pemasukan, 0, ',', '.') . ",-<br>";
                echo "Total Pengeluaran Anda: Rp " . number_format($total_pengeluaran, 0, ',', '.') . ",-<br>";
                echo "Saldo Anda: Rp " . number_format($saldo, 0, ',', '.') . ",-";
                ?>
            </p>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 by Habib Husain Nurrohim. All rights reserved.</p>
    </footer>
</body>
</html>