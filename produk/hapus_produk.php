<?php

require "../functions.php";

if (delete_produk()) {
    echo "<script>
    alert('Produk Berhasil di Hapus.');
    window.location = 'produk.php'; 
    </script>";
} else {
    echo "<script>
    alert('Produk Gagal di Hapus.');
    window.location = 'produk.php'; 
    </script>";
}

?>