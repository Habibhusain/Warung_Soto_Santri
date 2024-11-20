<?php
session_start();
require "functions.php";

if (!isset($_SESSION['id'])) {
    echo "<script>
    alert('Login Terlebih Dahulu');
    window.location = 'index.php';
    </script>";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (catat_pengeluaran()) {
        echo "<script>
        alert('Pengeluaran Berhasil di Tambah');
        window.location = 'dashboard.php';
        </script>";
    } else {
        echo "<script>
        alert('Pengeluaran Gagal di Tambah');
        window.location = 'pengeluaran.php';
        </script>";
    }
}

$tampil_pengeluaran = tampil_pengeluaran();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Pengeluaran - Warung Soto Santri</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navigasi">
    <div class="navbar-links">
        <a href="dashboard.php">Kembali ke Dashboard</a>
    </div>
        </nav>
    <div class="content-pengeluaran">
        <div class="content-pengeluaran-judul">
            <h2>Catat Pengeluaran</h2>
        </div>
            <div class="content-pengeluaran-box">
                <form method="post">
                    <label for="deskripsi">Deskripsi Pengeluaran:</label>
                    <input type="text" name="deskripsi" required>
                    <label for="jumlah_pengeluaran">Jumlah Pengeluaran:</label>
                    <input type="number" name="jumlah_pengeluaran" required>
                    <button type="submit" name="submit">Catat Pengeluaran</button>
                </form>
            </div>
        <h3>Pengeluaran</h3>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Pengeluaran</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($tampil_pengeluaran as $pengeluaran): ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $pengeluaran['deskripsi']; ?></td>
                        <td><?php echo $pengeluaran['jumlah_pengeluaran']; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($pengeluaran['tanggal_pengeluaran'])); ?></td>
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