<?php
session_start();
require "functions.php";

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id'])) {
    echo "<script>
    alert('Login Terlebih Dahulu');
    window.location = 'index.php';
    </script>";
    exit(); // Tambahkan exit untuk menghentikan eksekusi lebih lanjut
}

// Proses tambah stok
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (tambah_stok()) {
        echo "<script>
        alert('Stock berhasil ditambahkan.');
        window.location = 'stock.php'; 
        </script>";
    } else {
        echo "<script>
        alert('Gagal menambahkan stok.');
        window.location = 'stock.php'; 
        </script>";
    }
}

// Ambil daftar stok
$daftar_stok = ambil_stok();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Stok - Warung Soto Santri</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navigasi">
    <div class="navbar-links">
        <a href="dashboard.php">Kembali ke Dashboard</a>
    </div>
</nav>
<div class="container-stok">
    <div class="container-stok-judul">
        <h2>Daftar Stok</h2>
        <div class="container-daftar-stok">
            <!-- Form Tambah Stok -->
            <h3>Tambah Stok</h3>
            <form method="post" enctype="multipart/form-data">
                <label for="nama_barang">Nama Produk:</label>
                <input type="text" name="nama_barang" required>

                <label for="jumlah">Jumlah:</label>
                <input type="number" name="jumlah" required>

                <label for="satuan">Satuan:</label>
                <input type="text" name="satuan" required>

                <button type="submit">Tambah Stok</button>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Stok -->
    <h3>Stok Tersedia</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($daftar_stok as $stok): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $stok['nama_barang']; ?></td>
                    <td><?php echo $stok['jumlah']; ?></td>
                    <td><?php echo $stok['satuan']; ?></td>
                </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>
</div>
<footer>
        <p>&copy; 2024 by Habib Husain Nurrohim. All rights reserved.</p>
    </footer>
</body>
</html>
