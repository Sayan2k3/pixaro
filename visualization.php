<?php
session_start();
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
    <title>📊 Real-Time Inventory Analytics</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f5f7fa;
            text-align: center;
        }

        .navbar {
            background: #35495e;
            padding: 15px;
            color: white;
            text-align: left;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .back-btn {
            background: #f39c12;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        .dashboard-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 20px;
        }

        .chart-container {
            width: 45%;
            background: white;
            padding: 15px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .insights-container {
            width: 90%;
            background: #ffefc3;
            padding: 15px;
            margin: 20px auto;
            border-radius: 10px;
            font-size: 18px;
            color: #663399;
            font-weight: bold;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>📊 Real-Time Inventory Analytics</h2>
        <a href="admin.php" class="back-btn">⬅ Back to Dashboard</a>
    </div>

    <div class="insights-container">
        <h3>💡 Optimization Insights</h3>
        <p id="insightMessage">Analyzing inventory and environmental conditions...</p>
    </div>

    <div class="dashboard-container">
        <div class="chart-container">
            <canvas id="tempHumidityChart"></canvas>
        </div>

        <div class="chart-container">
            <canvas id="energyChart"></canvas>
        </div>

        <div class="chart-container">
            <canvas id="stockLevelChart"></canvas>
        </div>
    </div>

    <script>
        let tempHumidityChart, energyChart, stockLevelChart;

        let temperatureData = [28, 28.5, 28.2, 28.8, 29, 29.2, 28.9, 28.5];
        let humidityData = [55, 54, 56, 57, 55, 54, 55.5, 56];
        let energyUsageData = [200, 205, 210, 215, 220, 218, 222, 225];

        let stockLevels = {
            "Cement": 100,
            "Steel Rods": 100,
            "Bricks": 100,
            "Concrete Mixers": 100,
            "Safety Helmets": 100
        };

        function getSmoothedValue(current, min, max, step = 0.5) {
            let change = (Math.random() > 0.5 ? step : -step);
            let newValue = current + change;
            return Math.max(min, Math.min(newValue, max));
        }

        function updateCharts() {
            let newTemperature = getSmoothedValue(temperatureData[temperatureData.length - 1], 25, 35, 0.3);
            let newHumidity = getSmoothedValue(humidityData[humidityData.length - 1], 40, 75, 0.5);
            let newEnergyUsage = getSmoothedValue(energyUsageData[energyUsageData.length - 1], 150, 300, 5);

            temperatureData.push(newTemperature);
            humidityData.push(newHumidity);
            energyUsageData.push(newEnergyUsage);

            if (temperatureData.length > 10) temperatureData.shift();
            if (humidityData.length > 10) humidityData.shift();
            if (energyUsageData.length > 10) energyUsageData.shift();

            // Decrease stock levels over time (randomized)
            for (let item in stockLevels) {
                stockLevels[item] = Math.max(50, stockLevels[item] - Math.floor(Math.random() * 3));
            }

            tempHumidityChart.data.labels = Array(temperatureData.length).fill('');
            tempHumidityChart.data.datasets[0].data = temperatureData;
            tempHumidityChart.data.datasets[1].data = humidityData;
            tempHumidityChart.update();

            energyChart.data.labels = Array(energyUsageData.length).fill('');
            energyChart.data.datasets[0].data = energyUsageData;
            energyChart.update();

            stockLevelChart.data.labels = Object.keys(stockLevels);
            stockLevelChart.data.datasets[0].data = Object.values(stockLevels);
            stockLevelChart.update();

            $("#insightMessage").text(
                newTemperature > 30 ? "🔥 Temperature is high! Optimize cooling." :
                newHumidity > 70 ? "💧 High humidity detected! Use dehumidifiers." :
                newEnergyUsage > 250 ? "⚡ High energy usage! Optimize power consumption." :
                Math.min(...Object.values(stockLevels)) < 60 ? "📉 Some stocks are low! Consider restocking." :
                "✅ System is running optimally!"
            );
        }

        $(document).ready(function () {
            let ctx1 = document.getElementById("tempHumidityChart").getContext("2d");
            tempHumidityChart = new Chart(ctx1, {
                type: "line",
                data: {
                    labels: Array(temperatureData.length).fill(''),
                    datasets: [
                        { label: "Temperature (°C)", data: temperatureData, borderColor: "red", fill: false },
                        { label: "Humidity (%)", data: humidityData, borderColor: "blue", fill: false }
                    ]
                },
                options: { responsive: true }
            });

            let ctx2 = document.getElementById("energyChart").getContext("2d");
            energyChart = new Chart(ctx2, {
                type: "line",
                data: {
                    labels: Array(energyUsageData.length).fill(''),
                    datasets: [
                        { label: "Energy Usage (kWh)", data: energyUsageData, borderColor: "purple", fill: false }
                    ]
                },
                options: { responsive: true }
            });

            let ctx3 = document.getElementById("stockLevelChart").getContext("2d");
            stockLevelChart = new Chart(ctx3, {
                type: "bar",
                data: {
                    labels: Object.keys(stockLevels),
                    datasets: [
                        { label: "Stock Levels", data: Object.values(stockLevels), backgroundColor: "green" }
                    ]
                },
                options: { responsive: true }
            });

            setInterval(updateCharts, 3000);
        });
    </script>

</body>
</html>
