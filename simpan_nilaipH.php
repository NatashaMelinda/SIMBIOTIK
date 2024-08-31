<?php
// Mengambil nilai pH dari POST
$pH = $_POST['pH'];

// Menyimpan koneksi ke database (sesuaikan dengan konfigurasi Anda)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "simbiotik_pkmpi";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Menyiapkan query SQL untuk menyimpan nilai pH ke dalam tabel sensor
$sql = "INSERT INTO tabel_sensor (nilai_pH) VALUES ('$pH')";

if ($conn->query($sql) === TRUE) {
    echo "Nilai pH berhasil disimpan ke database.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi database
$conn->close();
?>