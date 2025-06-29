<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] === 'admin') {
    header("Location: login.php");
    exit();
}

require 'connect.php';
$username = $_SESSION['username'];

$sql = "SELECT username, name, salary, dob, department, ssn, home_folder FROM employees WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$employee = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard</title>
    <style>
        body {
            background-color: #add8e6; /* pastel blue */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #40e0d0; /* aqua */
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            font-size: 18px;
        }
        .logout-button {
            background-color: #ffffff;
            color: #40e0d0;
            padding: 8px 16px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
        .logout-button:hover {
            background-color: #e0f7f7;
        }
        .info-container {
            margin: 40px auto;
            width: 90%;
            max-width: 600px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 16px;
            text-align: left;
        }
        th {
            background-color: #40e0d0;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="navbar">
    <div>Welcome, <?= htmlspecialchars($employee['name']) ?></div>
    <form action="logout.php" method="post" style="margin: 0;">
        <button type="submit" class="logout-button">Logout</button>
    </form>
</div>
<div class="info-container">
    <h2>Your Information</h2>
    <table>
        <tr><th>Username</th><td><?= htmlspecialchars($employee['username']) ?></td></tr>
        <tr><th>Name</th><td><?= htmlspecialchars($employee['name']) ?></td></tr>
        <tr><th>Salary</th><td>$<?= htmlspecialchars($employee['salary']) ?></td></tr>
        <tr><th>Date of Birth</th><td><?= htmlspecialchars($employee['dob']) ?></td></tr>
        <tr><th>Department</th><td><?= htmlspecialchars($employee['department']) ?></td></tr>
        <tr><th>SSN</th><td><?= htmlspecialchars($employee['ssn']) ?></td></tr>
        <tr><th>Home Folder</th><td><?= htmlspecialchars($employee['home_folder']) ?></td></tr> 
    </table>
</div>
</body>
</html>
