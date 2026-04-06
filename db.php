<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "yatra";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("❌ Database Connection Failed: " . $conn->connect_error);
}

// Optional: Set UTF-8 encoding for proper text handling
$conn->set_charset("utf8mb4");
?>