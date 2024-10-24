<?php

require "config.php";

function connect_db(){
    $db = new mysqli (HOSTNAME,USERNAME, PASSWORD, DATABASE);
    return $db;
}

function login(){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login_soto = "SELECT * FROM pengguna WHERE username = '$username'";
    $login = connect_db()->query($login_soto);

    if($login ->num_rows > 0){
        $pengguna = $login->fetch_assoc();
        $_SESSION['id'] = $pengguna['id'];
        return $pengguna;
    }else{
        return false;
    }
}
function ambil_produk() {
    $sql = "SELECT * FROM produk";
    $result = connect_db()->query($sql);
    $produk = [];

    while ($row = $result->fetch_assoc()) {
        $produk[] = $row;
    }

    return $produk;
}

function tambah_produk() {
    $nama_produk = $_POST['nama_produk'];
    $foto_produk = upload_foto_produk();

    if ($foto_produk) {
        $sql_tambah_produk = "INSERT INTO produk (nama_produk, foto) VALUES ('$nama_produk', '$foto_produk')";
        return connect_db()->query($sql_tambah_produk);
    }
}
function upload_foto_produk()
{
    $ambil_ukuran_file = $_FILES['foto']['size'];
    $ukuran_diizinkan = 10000000;

    if ($ambil_ukuran_file > $ukuran_diizinkan) {
        echo 'Ukuran file maksimal 10 MB !!';
        exit();
    }

    $ambil_nama_file = $_FILES['foto']['name'];
    $ambil_ektensi_file = pathinfo($ambil_nama_file, PATHINFO_EXTENSION);
    $extensi_diizinkan = ['jpg', 'jpeg', 'png', 'svg', 'JPG', 'avif'];

    if (in_array($ambil_ektensi_file, $extensi_diizinkan)) {
        $ambil_tmp_file = $_FILES['foto']['tmp_name'];
        $tujuan_folder = "../image/";
        $target_file = $tujuan_folder . basename($ambil_nama_file);

        if (move_uploaded_file($ambil_tmp_file, $target_file)) {
            return $ambil_nama_file;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}
function catat_transaksi(){
    $id_pengguna = $_SESSION['id']['id'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $harga_satuan =  $_POST['harga_satuan'];
    $total_harga = $jumlah * $harga_satuan;

    $sql_catat_transaksi = "INSERT INTO transaksi (id_pengguna,nama_barang,jumlah,harga_satuan,total_harga)
                             VALUES ('$id_pengguna','$nama_barang','$jumlah','$harga_satuan','$total_harga')";
    $eksekusi_catat_transaksi = connect_db()->query($sql_catat_transaksi);

    return $eksekusi_catat_transaksi;

}

function catat_pengeluaran(){
    $deskripsi = $_POST['deskripsi'];
    $jumlah_pengeluaran = $_POST['jumlah_pengeluaran'];

    $catat_pengeluaran = "INSERT INTO pengeluaran (deskripsi, jumlah_pengeluaran) VALUES ('$deskripsi', '$jumlah_pengeluaran')";
    $eksekusi_pengeluaran = connect_db()->query($catat_pengeluaran);

    return $eksekusi_pengeluaran;

}

function laporan_transaksi(){
    $id_pengguna = $_SESSION['id']['id'];

    $sql_laporan_transaksi = "SELECT * FROM transaksi WHERE id_pengguna = '$id_pengguna'";
    $laporan_transaksi = connect_db()->query($sql_laporan_transaksi);
    $laporan = array();

    while ($row = $laporan_transaksi->fetch_assoc()){
        $laporan[]=$row;
    }
    
    return $laporan;
}

function total_pemasukan() {
    $sql_total_pemasukan = "SELECT SUM(total_harga) AS total_pemasukan FROM transaksi ";
    $result = connect_db()->query($sql_total_pemasukan);
    return $result->fetch_assoc();
}

function total_pengeluaran() {
    $id_pengguna = $_SESSION['id']['id'];
    $sql_total_pengeluaran = "SELECT SUM(jumlah_pengeluaran) AS total_pengeluaran FROM pengeluaran";
    $result = connect_db()->query($sql_total_pengeluaran);
    return $result->fetch_assoc();
}

function total_saldo() {
    $pemasukan = total_pemasukan()['total_pemasukan'] ?? 0; 
    $pengeluaran = total_pengeluaran()['total_pengeluaran'] ?? 0; 
    return $pemasukan - $pengeluaran;
}

function tambah_stok() {
    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $satuan = $_POST['satuan'];

        $sql_tambah_stok = "INSERT INTO stok (nama_barang, jumlah, satuan ) VALUES ('$nama_barang', '$jumlah', '$satuan')";
        return connect_db()->query($sql_tambah_stok);
}

function ambil_stok() {
    $sql = "SELECT * FROM stok";
    $result = connect_db()->query($sql);
    $stok = [];

    while ($row = $result->fetch_assoc()) {
        $stok[] = $row;
    }

    return $stok;
}

function tampil_pengeluaran(){
    $tampil_pengeluaran = "SELECT * FROM pengeluaran";
    $pengeluaran = connect_db()->query($tampil_pengeluaran);
    $result = array();

    while($row = $pengeluaran->fetch_assoc()){
        $result[] = $row;
    }

    return $result;
}
function ambil_produk_by_id($id) {
    $query = "SELECT * FROM produk WHERE id = $id";
    $result = connect_db()->query($query);
    return $result->fetch_assoc();
}
function edit_produk($id) {
    $nama_produk = $_POST['nama_produk'];
    
    // Proses upload foto jika ada
    if (!empty($_FILES['foto']['name'])) {
        $target_dir = "../image/";
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        
        // Upload file gambar
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $foto = basename($_FILES["foto"]["name"]);
            $query =connect_db()->query("UPDATE produk SET nama_produk = '$nama_produk', foto = '$foto' WHERE id = $id");
        } else {
            return false; // Gagal upload file
        }
    } else {
        // Jika tidak ada gambar baru, hanya update nama produk
        $query =connect_db()->query("UPDATE produk SET nama_produk = '$nama_produk' WHERE id = $id");
    }

    return $query;
}

function delete_produk()
{
    $id_produk = $_GET['id'];

    $delete_produk = "DELETE FROM produk WHERE id = '$id_produk'";
    $delete = connect_db()->query($delete_produk);

    return $delete;
}

function tampil_transaksi(){
    $tampil_transaksi = "SELECT * FROM transaksi";
    $transaksi = connect_db()->query($tampil_transaksi);
    $result = array();

    while($row = $transaksi->fetch_assoc()){
        $result[]=$row;
    }
    return $result;
}