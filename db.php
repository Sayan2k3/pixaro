<?php
$host = "localhost";
$username = "root"; // Change if using a different user
$password = "";
$database = "construction_mgmt";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
