<?php

include "koneksi.php";

$sql = mysqli_query($konek, "SELECT * FROM input_data_tds order by id DESC LIMIT 1");
$data = mysqli_fetch_array($sql);
$nilai = $data['TDS'];
echo $nilai;

?>