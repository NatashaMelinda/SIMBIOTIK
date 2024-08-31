<?php
require_once "koneksi.php";

$query = "SELECT status_pompa FROM tb_pompa LIMIT 1";
$result = $konek->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    echo json_encode(['success' => true, 'status_pompa' => $row['status_pompa']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal mengambil status pompa']);
}

$konek->close();
?>
