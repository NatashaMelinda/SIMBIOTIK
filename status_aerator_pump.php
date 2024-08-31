<?php
require_once "koneksi.php";

$query = "SELECT status_aerator FROM tb_pompa LIMIT 1";
$result = $konek->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    echo json_encode(['success' => true, 'status_aerator' => $row['status_aerator']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal mengambil status aerator']);
}

$konek->close();
?>
