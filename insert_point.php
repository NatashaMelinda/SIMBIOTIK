<?php
include 'koneksi.php';

// Mendapatkan parameter dari URL
$set_tds = isset($_GET['set_tds']) ? intval($_GET['set_tds']) : null;
$set_ph = isset($_GET['set_ph']) ? floatval($_GET['set_ph']) : null;

// Menyimpan nilai ke database
if ($set_tds !== null) {
    $sql = "INSERT INTO tb_set_tds (set_tds) VALUES ($set_tds)";
} elseif ($set_ph !== null) {
    $sql = "INSERT INTO tb_set_ph (set_pH) VALUES ($set_ph)";
}

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

