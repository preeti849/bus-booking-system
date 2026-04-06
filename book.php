<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bus_id = intval($_POST['bus_id']);
    $passenger_name = trim($_POST['passenger_name']);
    $seats = $_POST['seats'] ?? [];

    // Validation
    if (empty($passenger_name) || empty($seats)) {
        echo "<div class='error'>⚠️ Please enter passenger name and select at least one seat.</div>";
        exit;
    }

    // Insert bookings securely
    $stmt = $conn->prepare("INSERT INTO bookings (bus_id, seat_number, passenger_name) VALUES (?, ?, ?)");
    foreach ($seats as $seat) {
        $seat = htmlspecialchars($seat); // Prevent XSS
        $stmt->bind_param("iss", $bus_id, $seat, $passenger_name);
        $stmt->execute();
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mobile Responsive -->
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: #f8f8f8;
            padding: 20px;
        }
        .confirmation-box {
            background: white;
            max-width: 500px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.2);
        }
        h2 {
            color: #28a745;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            background: #cc0000;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
        .btn:hover {
            background: #a30000;
        }
        .error {
            background: #ffe0e0;
            color: #cc0000;
            padding: 10px;
            border-radius: 6px;
            max-width: 400px;
            margin: auto;
            margin-top: 20px;
        }
    
@media screen and (max-width: 768px) {
    body { padding: 10px; font-size: 16px; }
    table { width: 100%; font-size: 14px; }
    input, select, button { width: 100%; margin-bottom: 10px; }
}
</style>
</head>
<body>

<div class="confirmation-box">
    <h2>✅ Booking Confirmed!</h2>
    <p><strong>Passenger:</strong> <?php echo htmlspecialchars($passenger_name); ?></p>
    <p><strong>Seats Booked:</strong> <?php echo implode(", ", array_map('htmlspecialchars', $seats)); ?></p>
    <a href="index.php" class="btn">Book Another</a>
</div>

</body>
</html>