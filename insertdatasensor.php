<?php

require_once "koneksi.php";

// Ambil data dari parameter GET
$nilai_suhu = $_GET['nilai_suhu'];
$nilai_pH = $_GET['nilai_pH'];
$nilai_tds = $_GET['nilai_tds'];
$nilai_tinggi = $_GET['nilai_tinggi'];

// Masukkan data ke dalam tabel sensor
$insert = mysqli_query($konek, "INSERT INTO tabel_sensor (nilai_suhu, nilai_pH, nilai_tds, nilai_tinggi) VALUES ('$nilai_suhu', '$nilai_pH', '$nilai_tds', '$nilai_tinggi')");

// Periksa apakah operasi penyisipan berhasil
if($insert) {
    echo "Berhasil memasukkan data ke dalam tabel sensor";    
} else {
    echo "Gagal memasukkan data ke dalam tabel sensor";
}
?>