<?php
session_start();
if ($_SESSION['role'] !== 'Employee') {
    header("Location: index.php");
    exit();
}
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <h2>Employee Dashboard</h2>
        <a href="logout.php">Logout</a>
    </div>

    <div class="dashboard-container">
        <h2>View Inventory</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Site Name</th>
                <th>Status</th>
            </tr>
            <?php
            $sql = "SELECT * FROM inventory";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['item_name']}</td>
                        <td>{$row['quantity']}</td>
                        <td>{$row['site_name']}</td>
                        <td>{$row['status']}</td>
                      </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
