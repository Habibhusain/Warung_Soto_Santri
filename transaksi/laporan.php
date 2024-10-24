<?php
session_start();
require "../functions.php";

if(!isset($_SESSION['id'])){
echo "<script>
alert('Login Terlebih Dahulu');
window.location = '../index.php';
</script>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi - Warung Soto Santri</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<nav class="navbar">
        <div class="navbar-links">
            <a href="../dashboard.php">Kembali ke Dashboard</a>
        </div>
    </nav>
<div class="content-laporan">
    <div class="content-laporan-transaksi-judul">
        <h2>Laporan Transaksi</h2>
    </div>
    
    <div class="content-laporan-transaksi">
    <table >
        <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Transaksi</th>
            <th>Pengguna</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total Harga</th>
        </tr>
        </thead>
        <tbody>
        <?php $no= 1; foreach(laporan_transaksi() as $row): ?>

            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo date ('d-m-Y, H:i:s', strtotime($row['tanggal_transaksi']));?></td>
                <td><?php echo $row['id_pengguna'];?></td>
                <td><?php echo $row['nama_barang'];?></td>
                <td><?php echo $row['jumlah'];?></td>
                <td>Rp<?php echo number_format($row['harga_satuan'], 0, ',', '.');?></td>
                <td>Rp<?php echo number_format($row['total_harga'], 0, ',','.');?></td>
            </tr>
        <?php $no++; endforeach; ?>
        </tbody>
    </table>
</div>

</div>
<footer>
        <p>&copy; 2024 by Habib Husain Nurrohim. All rights reserved.</p>
    </footer>
</body>
</html>
