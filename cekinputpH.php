<?php

include "koneksi.php";

$sql = mysqli_query($konek, "SELECT * FROM input_data_ph order by id DESC LIMIT 1");
$data = mysqli_fetch_array($sql);
$nilai = $data['pH'];
echo $nilai;

?>