<?php
session_start();
require "../functions.php";

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id'])) {
    echo "<script>
    alert('Login Terlebih Dahulu');
    window.location = '../index.php';
    </script>";
}

// Proses tambah produk
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (tambah_produk()) {
        echo "<script>
        alert('Produk berhasil ditambahkan.');
        </script>";
    } else {
        echo "<script>
        alert('Gagal menambahkan produk.');
        </script>";
    }
}

$daftar_produk = ambil_produk();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Produk - Warung Soto Santri</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<nav class="navigasi">
<div class="navbar-links">
    <a href="../dashboard.php">Kembali ke Dashboard</a>
</div>
    </nav>
    <div class="container-produk">
    <div class="container-produk-judul">
        <h2>Daftar Produk</h2>
        <div class="container-daftar-produk">
            <!-- Form Tambah Produk -->
            <h3>Tambah Produk</h3>
    <form method="post" enctype="multipart/form-data">
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" name="nama_produk" required>

        <label for="foto">Foto Produk:</label>
        <input type="file" name="foto" required>

        <button type="submit">Tambah Produk</button>
    </form>
</div>
<!-- Tabel Daftar Produk -->
<h3>Produk Tersedia</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Foto</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($daftar_produk as $produk): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $produk['nama_produk']; ?></td>
                    <td><img src="../image/<?php echo $produk['foto']; ?>" alt="<?php echo $produk['nama_produk']; ?>" width="50" height="50"></td>
                    <td>
                    <div class="table-action">
                         <a class="edit" href="edit_produk.php?id=<?php echo $produk['id']; ?>">Edit</a>
                         <a class="hapus" href="hapus_produk.php?id=<?php echo $produk['id']; ?>" onclick="return confirm('Yakin Mau Hapus Data ini???')">Hapus</a>
                    </div>
                    </td>
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
