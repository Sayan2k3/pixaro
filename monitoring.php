<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Site Monitoring</title>
    <link rel="stylesheet" href="monitoring.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Store initial values for smooth transition
let temperature = 30.0;
let humidity = 50.0;
let vibration = 2.0;
let aqi = 150.0;

function updateValues() {
    temperature = smoothUpdate(temperature, 15, 45);
    humidity = smoothUpdate(humidity, 20, 90);
    vibration = smoothUpdate(vibration, 0, 5);
    aqi = smoothUpdate(aqi, 50, 300);

    $("#temperature").text(temperature.toFixed(1) + " °C");
    $("#humidity").text(humidity.toFixed(1) + " %");
    $("#vibration").text(vibration.toFixed(1) + " mm/sec");
    $("#aqi").text(Math.round(aqi));
}

function smoothUpdate(currentValue, min, max) {
    let change = [0.1, -0.1, 0.2, -0.2, 0.3, -0.3][Math.floor(Math.random() * 6)];
    let newValue = currentValue + change;
    return Math.max(min, Math.min(newValue, max)); // Keep within bounds
}

setInterval(updateValues, 1000);
    </script>
</head>

<body>

    <div class="navbar">
        <h2>📡 Real-Time Site Monitoring</h2>
        <a href="admin.php" class="btn btn-back">🔙 Back to Dashboard</a>
    </div>

    <div class="monitor-container">
        <div class="sensor-box">
            <h3>🌡️ Temperature</h3>
            <p id="temperature">Loading...</p>
        </div>
        <div class="sensor-box">
            <h3>💧 Humidity</h3>
            <p id="humidity">Loading...</p>
        </div>
        <div class="sensor-box">
            <h3>🔧 Vibration</h3>
            <p id="vibration">Loading...</p>
        </div>
        <div class="sensor-box">
            <h3>🌍 Air Quality Index (AQI)</h3>
            <p id="aqi">Loading...</p>
        </div>
    </div>

</body>
</html>
