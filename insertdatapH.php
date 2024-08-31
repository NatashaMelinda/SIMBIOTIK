<?php

require_once "koneksi.php";


// Periksa apakah parameter 'nilai_pH' ada
if (isset($_GET['pH'])) {
    $pH = $_GET['pH'];
} else {
    echo "Parameter pH tidak ditemukan.";
    exit;
}

// Validasi nilai pH
if (($pH <=3) || ($pH >=15))  {
    echo json_encode(['success' => false, 'message' => "Nilai pH tidak valid."]);
    exit;
}

// Query untuk memasukkan nilai pH
$query = "INSERT INTO tb_ph (pH) VALUES ('$pH')";
$insert = mysqli_query($konek, $query);

// Periksa apakah query berhasil
if ($insert) {
    // Query untuk mengambil nilai pH terbaru
    $query = "SELECT pH FROM tb_ph ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($konek, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $pH = $row['pH'];
        }
        if ($pH > 7) {
        // Kirim notifikasi ke Telegram
        $text = "pH Mencapai Batas Maksimal yaitu " . $pH . " Silahkan dicek!";
        $telegram_url = "https://api.telegram.org/bot7421032219:AAFh_AKAWv8aA6Xyi4e8ZRmDWmBJfqE8UdI/sendMessage?chat_id=1983630958&text=" . urlencode($text);
        file_get_contents($telegram_url);

        echo "Nilai pH berhasil diambil dan notifikasi dikirim.";
    } else {
        echo "Tidak ada data pH yang ditemukan di database.";
    }
} else {
    echo "Gagal mengambil data dari database: " . mysqli_error($konek);
}
} else {
    echo "Gagal menginput nilai pH: " . mysqli_error($konek);
}

// Tutup koneksi
$konek->close();
?>