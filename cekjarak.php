<?php

include "koneksi.php";

$sql = mysqli_query($konek, "SELECT * FROM tb_jarak order by id DESC LIMIT 1");
$data = mysqli_fetch_array($sql);
$nilai = $data['jarak'];
echo $nilai;

?>