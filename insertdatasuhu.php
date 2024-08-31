<?php

require_once "koneksi.php";

$suhu = $_GET['suhu'];

$insert = mysqli_query($konek, "INSERT INTO tb_suhu(suhu) VALUES ('$suhu');");

// $suhu = $row['suhu'];

//         // Kirim notifikasi ke Telegram
//         $text = "Suhu Mencapai Batas Maksimal yaitu " . $suhu . " Silahkan dicek!";
//         $telegram_url = "https://api.telegram.org/bot7421032219:AAFh_AKAWv8aA6Xyi4e8ZRmDWmBJfqE8UdI/sendMessage?chat_id=1983630958&text=" . urlencode($text);
//         file_get_contents($telegram_url);

if($insert) {
    echo "berhasil insert data ke database";    
}else {
    echo "gagal insert data ke database";
}

// if (isset($_GET['nilai_suhu']) && is_numeric($_GET['nilai_suhu'])) {
//     $nilai_suhu = $_GET['nilai_suhu'];

//     // Gunakan prepared statements untuk menghindari SQL injection
//     $stmt = $konek->prepare("INSERT INTO suhuairs(nilai_suhu) VALUES (?)");
//     $stmt->bind_param("d", $nilai_suhu); // "d" untuk double (angka desimal)

//     if ($stmt->execute()) {
//         $text = "Suhu Mencapai Batas Maksimal yaitu $nilai_suhu. Silahkan dicek!";
//         $url = "https://api.telegram.org/bot7421032219:AAFh_AKAWv8aA6Xyi4e8ZRmDWmBJfqE8UdI/sendMessage?chat_id=1983630958&text=" . urlencode($text);
        
//         $response = file_get_contents($url);
//         if ($response) {
//             echo "Berhasil insert data ke database dan mengirim pesan Telegram.";
//         } else {
//             echo "Berhasil insert data ke database, tetapi gagal mengirim pesan Telegram.";
//         }
//     } else {
//         echo "Gagal insert data ke database: " . $stmt->error;
//     }

//     $stmt->close();
// } else {
//     echo "Nilai suhu tidak valid.";
// }

// Versi 3
// Ambil nilai_suhu dari database
// $query = "SELECT suhu FROM suhu ORDER BY id DESC LIMIT 1";
// $result = mysqli_query($konek, $query);

// if ($result) {
//     $row = mysqli_fetch_assoc($result);
//     if ($row) {
//         $suhu = $row['suhu'];

//         // Kirim notifikasi ke Telegram
//         $text = "Suhu Mencapai Batas Maksimal yaitu " . $suhu . " Silahkan dicek!";
//         $telegram_url = "https://api.telegram.org/bot7421032219:AAFh_AKAWv8aA6Xyi4e8ZRmDWmBJfqE8UdI/sendMessage?chat_id=1983630958&text=" . urlencode($text);
//         file_get_contents($telegram_url);

//         echo "Nilai suhu berhasil diambil dan notifikasi dikirim.";
//     } else {
//         echo "Tidak ada data suhu yang ditemukan di database.";
//     }
// } else {
//     echo "Gagal mengambil data dari database: " . mysqli_error($konek);
// }

// $konek->close();

?>