<?php
session_start();
include 'db.php';

if ($_SESSION['role'] !== 'Admin') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        var autoUpdate = true;
        var showRecommendations = true;

        function loadInventory() {
            if (autoUpdate) {
                $.ajax({
                    url: "fetch_inventory.php",
                    type: "GET",
                    success: function(data) {
                        $("#inventoryTable").html(data);
                    }
                });
            }
        }

        function updateStock() {
            if (autoUpdate) {
                $.ajax({
                    url: "auto_update.php",
                    type: "GET"
                });
            }
        }

        function generateRecommendation() {
            if (showRecommendations) {
                var recommendations = [
                    "🔧 Add stock in Site A",
                    "📉 Remove stock from Site C",
                    "⚠️ Site B is running low!",
                    "🚀 Optimize storage for Site A",
                    "🛠️ Equipment check required at Site B",
                    "📦 Move excess inventory to Site B",
                    "⚡ Emergency stock refill needed at Site C!"
                ];
                var randomMessage = recommendations[Math.floor(Math.random() * recommendations.length)];
                $("#recommendationBar").text(randomMessage);
            }
        }

        $(document).ready(function() {
            loadInventory();
            setInterval(loadInventory, 3000);
            setInterval(updateStock, 3000);
            setInterval(generateRecommendation, 3000);

            $("#stopButton").click(function() {
                autoUpdate = !autoUpdate;
                showRecommendations = !showRecommendations;
                $(this).text(autoUpdate ? "🛑 Stop Live Updates" : "▶ Resume Live Updates");
            });
        });
    </script>
</head>

<body>

    <div class="navbar">
        <h2>Dashboard</h2>
        <div class="nav-links">
            <a href="add.php" class="btn btn-add">➕ Add Item</a>
            <a href="monitoring.php" class="btn btn-monitoring">📡 <span class="monitoring-text">Real-Time Site Monitoring</span></a>
            <a href="visualization.php" class="btn btn-visualization">📊 Real-Time Visualization</a>
            <a href="logout.php" class="btn btn-logout">🚪 Logout</a>
        </div>
    </div>

    <div class="container">
        <h2>📊 Live Inventory Status</h2>
        <button id="stopButton" class="btn btn-stop">🛑 Stop Live Updates</button>

        <table class="table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Site</th> <!-- New column for site -->
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="inventoryTable">
                <!-- Data will be loaded dynamically -->
            </tbody>
        </table>

        <div class="recommendation-box">
            <h3>📢 Recommendations:</h3>
            <p id="recommendationBar">🔍 Loading suggestions...</p>
        </div>
    </div>

</body>
</html>
