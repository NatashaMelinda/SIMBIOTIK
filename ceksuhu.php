<?php
include "koneksi.php";

$sql = mysqli_query($konek, "SELECT * FROM tb_suhu ORDER BY id DESC LIMIT 1");
$data = mysqli_fetch_array($sql);
$nilai = $data['suhu'];
echo $nilai;
?>