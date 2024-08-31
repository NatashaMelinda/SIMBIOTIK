<?php
include 'koneksi.php';    

if (isset($_GET['tds'])) {
    $tds = $_GET['tds'];

    $sql = "INSERT INTO tb_set_tds (set_tds) VALUES ('$tds')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "No TDS setpoint received";
}

$conn->close();
?>