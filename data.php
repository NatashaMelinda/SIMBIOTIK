<?php
include 'koneksi.php';

// Query to get the latest temperature
$sql_suhu = "SELECT suhu FROM tb_suhu ORDER BY id DESC LIMIT 1";
$result_suhu = $konek->query($sql_suhu);

$suhu = "Data tidak ditemukan";
if ($result_suhu->num_rows > 0) {
    $row_suhu = $result_suhu->fetch_assoc();
    $suhu = $row_suhu['suhu'];
}

// Query to get the latest pH
$sql_pH = "SELECT pH FROM tb_ph ORDER BY id DESC LIMIT 1";
$result_pH = $konek->query($sql_pH);

$pH = "Data tidak ditemukan";
if ($result_pH->num_rows > 0) {
    $row_pH = $result_pH->fetch_assoc();
    $pH = $row_pH['pH'];
}

// Query to get the latest TDS
$sql_TDS = "SELECT TDS FROM tb_tds ORDER BY id DESC LIMIT 1";
$result_TDS = $konek->query($sql_TDS);

$TDS = "Data tidak ditemukan";
if ($result_TDS->num_rows > 0) {
    $row_TDS = $result_TDS->fetch_assoc();
    $TDS = $row_TDS['TDS'];
}

// Query to get the latest jarak
$sql_jarak = "SELECT jarak FROM tb_jarak ORDER BY id DESC LIMIT 1";
$result_jarak = $konek->query($sql_jarak);

$jarak = "Data tidak ditemukan";
if ($result_jarak->num_rows > 0) {
    $row_jarak = $result_jarak->fetch_assoc();
    $jarak = $row_jarak['jarak'];
}

// Return the data as JSON
echo json_encode([
    'suhu' => $suhu,
    'pH' => $pH,
    'TDS' => $TDS,
    'jarak' => $jarak
]);

$konek->close();
?>
