<?php

require_once "koneksi.php";

$TDS = $_GET['TDS'];

$insert = mysqli_query($konek, "INSERT INTO input_data_tds(TDS) VALUES ('$TDS');");

if($insert) {
    echo "berhasil insert data ke database";    
}else {
    echo "gagal insert data ke database";
}
?>