<?php
// Mulai session (jika belum dimulai)
session_start();

// Hapus semua variabel sesi
session_unset();

// Hapus session
session_destroy();

// Redirect ke halaman login atau halaman lain yang sesuai
header("location: index.php");
exit();
?>