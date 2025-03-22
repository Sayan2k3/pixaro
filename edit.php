<?php
session_start();
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'Admin' && $_SESSION['role'] !== 'Coordinator')) {
    header("Location: index.php");
    exit();
}
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM inventory WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];

    $sql = "UPDATE inventory SET item_name='$item_name', quantity='$quantity', status='$status' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>🛠 Edit Inventory - Update Your Stock!</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>

    <div class="container">
        <h2>🛠 Edit Inventory - Update Your Stock!</h2>
        <form method="POST" class="edit-form">
            <label>Item Name:</label>
            <input type="text" name="item_name" value="<?= $row['item_name'] ?>" required>

            <label>Quantity:</label>
            <input type="number" name="quantity" value="<?= $row['quantity'] ?>" required>

            <label>Status:</label>
            <select name="status">
                <option value="Available" <?= $row['status'] == 'Available' ? 'selected' : '' ?>>Available</option>
                <option value="In Use" <?= $row['status'] == 'In Use' ? 'selected' : '' ?>>In Use</option>
                <option value="Under Maintenance" <?= $row['status'] == 'Under Maintenance' ? 'selected' : '' ?>>Under Maintenance</option>
            </select>

            <button type="submit" class="btn-submit">Update Item</button>
        </form>
    </div>

</body>
</html>
