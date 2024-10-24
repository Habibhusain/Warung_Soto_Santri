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

// Ambil ID produk dari URL
$id_produk = $_GET['id'];
$produk = ambil_produk_by_id($id_produk);

// Proses edit produk
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (edit_produk($id_produk)) {
        echo "<script>
        alert('Produk berhasil diupdate.');
        window.location = 'produk.php'; 
        </script>";
    } else {
        echo "<script>
        alert('Gagal mengupdate produk.');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Warung Soto Santri</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<nav class="navigasi">
    <div class="navbar-links">
        <a href="../dashboard.php">Kembali ke Dashboard</a>
        <a href="produk.php">Kembali ke Daftar Produk</a>
    </div>
</nav>
<div class="container-produk">
    <div class="container-produk-judul">
        <h2>Edit Produk</h2>
        <form method="post" enctype="multipart/form-data">
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" name="nama_produk" value="<?php echo $produk['nama_produk']; ?>" required>

            <label for="foto">Foto Produk (jika ingin mengganti):</label>
            <input type="file" name="foto">

            <button type="submit">Update Produk</button>
        </form>
    </div>
</div>
<footer>
        <p>&copy; 2024 by Habib Husain Nurrohim. All rights reserved.</p>
    </footer>
</body>
</html>
