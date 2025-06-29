<?php
session_start();
include 'connect.php'; // DB connection is in connect.php

// Get submitted data
$username = $_POST['username'];
$password = sha1($_POST['password']);  

// Prepare and execute query
$sql = "SELECT * FROM employees WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

// Check login result
if ($result->num_rows == 1) {
    $_SESSION['username'] = $username;

    // Checks login type to redirect to correct dashboard
    $row = $result->fetch_assoc();
    if ($row['username'] == 'admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: employee_dashboard.php");
    }
    exit();
} else {
    echo "Incorrect username or password.";
}
?>
