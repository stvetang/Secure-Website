<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include("connect.php");
$result = mysqli_query($conn, "SELECT * FROM employees");

echo "<h2>Admin Dashboard</h2>";
echo "<table border='1'>
<tr><th>Name</th><th>Salary</th><th>DOB</th><th>Department</th><th>SSN</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
    <td>{$row['name']}</td>
    <td>{$row['salary']}</td>
    <td>{$row['dob']}</td>
    <td>{$row['department']}</td>
    <td>{$row['ssn']}</td>
    </tr>";
}
echo "</table>";
?>
