<?php
include "koneksi.php";

// Query SQL untuk mengambil status_pompa
$sql = mysqli_query($konek, "SELECT status_pompa FROM tb_pompa LIMIT 1");

if ($sql) {
    // Ambil data hasil query
    $data = mysqli_fetch_array($sql);
    $status_pompa = $data['status_pompa'];
    echo $status_pompa;
} else {
    echo "Gagal mengambil status pompa";
}

// Tutup koneksi database
mysqli_close($konek);
?>