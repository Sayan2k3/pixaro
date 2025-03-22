<?php
include 'db.php';

$response = [];

$sql = "SELECT * FROM inventory";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $quantity = $row['quantity'];

    // Reduce quantity by 1 every 3 seconds
    if ($quantity > 0) {
        $new_quantity = $quantity - 1;
    } else {
        // Restock to 100 when quantity reaches 0
        $new_quantity = 100;
    }

    // Update inventory in database
    $update_sql = "UPDATE inventory SET quantity = $new_quantity WHERE id = $id";
    $conn->query($update_sql);

    // Prepare response data
    $response[] = [
        'id' => $id,
        'quantity' => $new_quantity
    ];
}

$conn->close();

// Return JSON response
echo json_encode($response);
?>

