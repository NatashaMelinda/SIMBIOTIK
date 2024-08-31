<?php

require_once "koneksi.php";

$pH = $_GET['pH'];

$insert = mysqli_query($konek, "INSERT INTO input_data_ph(pH) VALUES ('$pH');");

if($insert) {
    echo "berhasil insert data ke database";    
}else {
    echo "gagal insert data ke database";
}
?>