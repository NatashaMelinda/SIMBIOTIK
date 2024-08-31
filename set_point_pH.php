<?php
include("koneksi.php");

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nilai_ph'])) {
        $nilai_ph = $_POST['nilai_ph'];

        // Sanitize input
        $nilai_ph = floatval($nilai_ph);

        // Check if the input is valid
        if ($nilai_ph <= 0) {
            echo "Nilai pH tidak valid.";
            exit;
        }

        // Query to insert the data into the database
        $sql = "INSERT INTO input_data_ph (pH) VALUES ($nilai_ph)";

        if ($konek->query($sql) === TRUE) {
            echo "Data pH berhasil disimpan";
        } else {
            echo "Error: " . $sql . "<br>" . $konek->error;
        }
    } else {
        echo "Nilai pH tidak ditemukan dalam request.";
    }
} else {
    echo "Request method tidak valid.";
}

$konek->close();
?>