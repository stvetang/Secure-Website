?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require 'connect.php';

$sql = "SELECT username, name, salary, dob, department, ssn, home_folder FROM employees";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            background-color: #add8e6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #40e0d0;
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
        .table-container {
            margin: 40px auto;
            width: 90%;
            max-width: 1000px;
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
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #40e0d0;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
<div class="navbar">
    <div>Welcome, Admin</div>
    <form action="logout.php" method="post" style="margin: 0;">
        <button type="submit" class="logout-button">Logout</button>
    </form>
</div>
<div class="table-container">
    <h2>All Employees</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Salary</th>
            <th>Date of Birth</th>
            <th>Department</th>
            <th>SSN</th>
            <th>Home Folder</th>
        </tr>
        <?php
        if ($result->num_rows > 0):
            while($row = $result->fetch_assoc()):
        ?>
            <tr>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td>$<?= htmlspecialchars($row['salary']) ?></td>
                <td><?= htmlspecialchars($row['dob']) ?></td>
                <td><?= htmlspecialchars($row['department']) ?></td>
                <td><?= htmlspecialchars($row['ssn']) ?></td>
                <td><?= htmlspecialchars($row['home_folder']) ?></td>
            </tr>
        <?php
            endwhile;
        else:
            echo "<tr><td colspan='7'>No employees found.</td></tr>";
        endif;
        $conn->close();
        ?>
    </table>
</div>
</body>
</html>
