<?php
include 'koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Periksa apakah semua parameter yang dibutuhkan diatur dalam permintaan GET
if (isset($_GET['id']) && isset($_GET['status_pompa']) && isset($_GET['status_aerator'])) {
    // Simpan nilai dari GET ke variabel lokal
    $id = $_GET['id'];
    $status_pompa = $_GET['status_pompa'];
    $status_aerator = $_GET['status_aerator'];

    // Query SQL untuk meng-update data
    $query = "UPDATE tb_pompa SET id = ?, status_pompa = ?, status_aerator = ? WHERE id = ?";
    $stmt = $konek->prepare($query);
    $stmt->bind_param("iiii", $id, $status_pompa, $status_aerator, $id); // Mengikat parameter sebagai integer

    // Jalankan query
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Data berhasil di-update']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal meng-update data: ' . $stmt->error]);
    }

    // Tutup statement
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Parameter tidak lengkap']);
}

// Tutup koneksi database
$konek->close();
?>
