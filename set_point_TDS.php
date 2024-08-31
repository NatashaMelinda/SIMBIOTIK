<?php
include("koneksi.php");

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nilai_tds'])) {
        $nilai_tds = $_POST['nilai_tds'];

        // Sanitize input
        $nilai_tds = floatval($nilai_tds);

        // Check if the input is valid
        if ($nilai_tds <= 0) {
            echo "Nilai TDS tidak valid.";
            exit;
        }

        // Query to insert the data into the database
        $sql = "INSERT INTO input_data_tds (TDS) VALUES ($nilai_tds)";

        if ($konek->query($sql) === TRUE) {
            echo "Data TDS berhasil disimpan";
        } else {
            echo "Error: " . $sql . "<br>" . $konek->error;
        }
    } else {
        echo "Nilai TDS tidak ditemukan dalam request.";
    }
} else {
    echo "Request method tidak valid.";
}

$konek->close();
?>