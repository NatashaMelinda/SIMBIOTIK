<?php
include 'koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Ambil parameter dari GET request
if (isset($_GET['device']) && isset($_GET['status'])) {
    $device = $_GET['device'];
    $status = $_GET['status'];

    // Update status device ke database
    $query = "UPDATE tb_pompa SET ";
    if ($device === 'water_pump') {
        $query .= "status_pompa = ?";
    } else if ($device === 'aerator') {
        $query .= "status_aerator = ?";
    } else {
        echo "Device tidak dikenali";
        exit;
    }

    $stmt = $konek->prepare($query);
    $stmt->bind_param("i", $status);

    if ($stmt->execute()) {
        echo "Status $device berhasil diupdate menjadi $status";
    } else {
        echo "Gagal mengupdate status $device";
    }

    $stmt->close();
} else {
    echo "Parameter tidak lengkap";
}
$konek->close();
?>
