<?php
include 'koneksi.php'; // Menyesuaikan dengan file koneksi Anda

// Check if "stat" parameter is set in GET request
if (isset($_GET['stat'])) {
    // Store the value from GET to a local variable "stat"
    $stat = $_GET['stat'];

    // Determine the status_pompa value based on "stat" value
    $status_pompa = ($stat === 'ON') ? 1 : 0;

    // SQL query that sets the status_pompa to 1 or 0
    $query = "UPDATE tb_pompa SET status_pompa = ?";
    $stmt = $konek->prepare($query);
    $stmt->bind_param("i", $status_pompa);

    // Execute the query
    if ($stmt->execute()) {
        // Set a message based on the new status
        $message = ($status_pompa == 1) ? 'Pompa kini menyala' : 'Pompa kini mati';
        echo json_encode(['success' => true, 'message' => $message, 'status_pompa' => $status_pompa]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal mengubah status pompa: ' . $stmt->error]);
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Status tidak ditentukan']);
}

// Close the database connection
$konek->close();

?>
