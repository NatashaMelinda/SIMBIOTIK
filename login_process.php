<!-- login_process.php -->
<?php
session_start();

// Include your database connection file
require_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $username = $konek->real_escape_string($_POST['username']);
    $password = $konek->real_escape_string($_POST['password']);

    // Query to check if user exists with given credentials
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $konek->query($sql);

    if ($result->num_rows == 1) {
        // User found, set session variables
        $_SESSION['login_user'] = $username;

        // Redirect to dashboard or any other authenticated page
        header("location: dashboard.php");
        exit();
    } else {
        $error = "Username or Password is incorrect";
    }
}

$konek->close();
?>