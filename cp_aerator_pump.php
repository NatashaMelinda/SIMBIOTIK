<?php
include 'koneksi.php'; // Menyesuaikan dengan file koneksi Anda

// Check if "stat" parameter is set in GET request
if (isset($_GET['stat'])) {
    // Store the value from GET to a local variable "stat"
    $stat = $_GET['stat'];

    // Determine the status_aerator value based on "stat" value
    $status_aerator = ($stat === 'ON') ? 1 : 0;

    // SQL query that sets the status_aerator to 1 or 0
    $query = "UPDATE tb_pompa SET status_aerator = ?";
    $stmt = $konek->prepare($query);
    $stmt->bind_param("i", $status_aerator);

    // Execute the query
    if ($stmt->execute()) {
        // Set a message based on the new status
        $message = ($status_aerator == 1) ? 'Aerator Pump kini menyala' : 'Aerator Pump kini mati';
        echo json_encode(['success' => true, 'message' => $message, 'status_aerator' => $status_aerator]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal mengubah status aerator: ' . $stmt->error]);
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Status tidak ditentukan']);
}

// Close the database connection
$konek->close();

?>
