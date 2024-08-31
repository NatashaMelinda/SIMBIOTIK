<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "simp8565_simbiotik"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil parameter filter dari query string
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';

// Menyusun query dengan filter
$sql = "SELECT ts.created_at, ts.suhu, tp.pH, tj.jarak, tt.TDS 
        FROM tb_suhu ts 
        JOIN tb_pH tp ON ts.created_at = tp.created_at
        JOIN tb_jarak tj ON ts.created_at = tj.created_at
        JOIN tb_tds tt ON ts.created_at = tt.created_at";

if ($startDate && $endDate) {
    $sql .= " WHERE ts.created_at BETWEEN '$startDate' AND '$endDate'";
}
$sql .= " ORDER BY ts.created_at DESC LIMIT 10";

$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = [];
}

$conn->close();

// Mengembalikan data dalam format JSON
echo json_encode($data);
?>