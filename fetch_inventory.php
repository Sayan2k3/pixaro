<?php
include 'db.php';

$sql = "SELECT * FROM inventory";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $quantity = $row['quantity'];
    $status = "";

    if ($quantity == 0) {
        $status = "<span class='restocking'>Restocking...</span>";
    } elseif ($quantity < 10) {
        $status = "<span class='too-low'>Too Low</span>";
    } elseif ($quantity >= 10 && $quantity < 30) {
        $status = "<span class='low'>Low</span>";
    } elseif ($quantity >= 31 && $quantity < 60) {
        $status = "<span class='moderate'>Moderate</span>";
    } elseif ($quantity >= 61 && $quantity < 99) {
        $status = "<span class='high'>High</span>";
    } else {
        $status = "<span class='available'>Available</span>";
    }

    echo "<tr>";
    echo "<td>" . $row['item_name'] . "</td>";
    echo "<td>" . $quantity . "</td>";
    echo "<td>" . $row['site'] . "</td>";
    echo "<td id='status-" . $row['id'] . "'>" . $status . "</td>";
    echo "<td>
            <a href='edit.php?id=" . $row['id'] . "' class='btn btn-edit'>Edit</a>
            <a href='delete.php?id=" . $row['id'] . "' class='btn btn-delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
          </td>";
    echo "</tr>";
}

?>

