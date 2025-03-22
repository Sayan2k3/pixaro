<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>🔧 Add New Inventory - Keep Your Stock Updated!</title>
    <link rel="stylesheet" href="add.css">
</head>
<body>

    <div class="container">
        <h2>🔧 Add New Inventory - Keep Your Stock Updated!</h2>
        <form method="POST" class="add-form">
            <label>Item Name:</label>
            <input type="text" name="item_name" placeholder="Enter item name" required>

            <label>Category:</label>
            <select name="category_id">
                <option value="1">Cement</option>
                <option value="2">Steel</option>
                <option value="3">Bricks</option>
                <option value="4">Machinery</option>
                <option value="5">Safety Equipment</option>
            </select>

            <label>Quantity:</label>
            <input type="number" name="quantity" placeholder="Enter quantity" required>
            <label>Site:</label>
            <input type="text" name="site placeholder="Enter location" required>
            <label>Status:</label>
            <select name="status">
                <option value="Available">Available</option>
                <option value="In Use">In Use</option>
                <option value="Under Maintenance">Under Maintenance</option>
            </select>

            <button type="submit" class="btn-submit">Add Item</button>
        </form>
    </div>

</body>
</html>
