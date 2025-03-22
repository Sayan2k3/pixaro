<?php
// Generate slight fluctuations for realistic sensor readings
$temperature = round(25 + (rand(-2, 2) * 0.2), 1);  // 25°C ± 0.2
$humidity = round(50 + (rand(-2, 2) * 0.5), 1);      // 50% ± 0.5
$vibration = round(5 + (rand(-2, 2) * 0.2), 1);      // 5 units ± 0.2
$aqi = round(100 + (rand(-2, 2) * 0.5), 1);         // 100 AQI ± 0.5

echo "
    <div class='sensor-box temperature'>🌡 <strong>Temperature:</strong> $temperature °C</div>
    <div class='sensor-box humidity'>💧 <strong>Humidity:</strong> $humidity %</div>
    <div class='sensor-box vibration'>⚠ <strong>Vibration Level:</strong> $vibration</div>
    <div class='sensor-box aqi'>🌫 <strong>Air Quality Index:</strong> $aqi</div>
";
?>

