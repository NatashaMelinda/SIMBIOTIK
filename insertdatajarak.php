<?php

require_once "koneksi.php";

$jarak = $_GET['jarak'];

$insert = mysqli_query($konek, "INSERT INTO tb_jarak(jarak) VALUES 
('$jarak');");

if($insert) {
    echo "berhasil insert data ke database";    
}else {
    echo "gagal insert data ke database";
}
?>