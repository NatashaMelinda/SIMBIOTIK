<?php
include("koneksi.php");

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to get the latest set point
function getLatestSetPoint($table, $column) {
    global $konek;
    $sql = "SELECT $column FROM $table ORDER BY created_at DESC LIMIT 1";
    $result = $konek->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row[$column];
    } else {
        return null;
    }
}

$latestSetPh = getLatestSetPoint('input_data_ph', 'pH');
$latestSetTds = getLatestSetPoint('input_data_tds', 'TDS');

$response = array(
    'pH' => $latestSetPh,
    'TDS' => $latestSetTds
);

echo json_encode($response);

$konek->close();
?>