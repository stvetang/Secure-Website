<?php
$servername = "localhost";
$username = "seed";      // not 'root'
$password = "dees";      // SEED Labs password
$dbname = "employee_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
