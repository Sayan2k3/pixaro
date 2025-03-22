<?php
session_start();
if ($_SESSION['role'] !== 'Coordinator') {
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
    <title>Coordinator Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <h2>Coordinator Dashboard</h2>
        <a href="logout.php">Logout</a>
    </div>

    <div class="dashboard-container">
        <h2>View & Edit Inventory</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM inventory";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['item_name']}</td>
                        <td>{$row['quantity']}</td>
                        <td>{$row['status']}</td>
                        <td>
                            <a href='edit.php?id={$row['id']}' class='btn btn-edit'>Edit</a>
                        </td>
                      </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
