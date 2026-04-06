<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "yatra.com");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bus_name = trim($_POST['bus_name']);
    $source = trim($_POST['source']);
    $destination = trim($_POST['destination']);
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];
    $fare = floatval($_POST['fare']);
    $total_seats = intval($_POST['total_seats']);

    if (!empty($bus_name) && !empty($source) && !empty($destination) && $fare > 0 && $total_seats > 0) {
        $sql = "INSERT INTO buses (bus_name, source, destination, departure_time, arrival_time, fare, total_seats)
                VALUES ('$bus_name', '$source', '$destination', '$departure_time', '$arrival_time', $fare, $total_seats)";
        
        if (mysqli_query($conn, $sql)) {
            echo "<p style='color:green; text-align:center;'>✅ Bus added successfully!</p>";
        } else {
            echo "<p style='color:red; text-align:center;'>❌ Error: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p style='color:red; text-align:center;'>⚠️ All fields are required, and fare/total seats must be greater than zero.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Bus - Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 20px;
        }
        form {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0px 0px 10px #ccc;
        }
        h2 {
            text-align: center;
            color: #cc0000;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="time"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 100%;
            background: #cc0000;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 12px;
            font-size: 16px;
            border-radius: 6px;
            transition: background 0.3s ease;
        }
        input[type="submit"]:hover {
            background: #990000;
        }
        /* Mobile Responsive */
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            form {
                padding: 15px;
                width: 100%;
            }
            input[type="text"], input[type="time"], input[type="number"], input[type="submit"] {
                font-size: 14px;
                padding: 8px;
            }
        }
    
@media screen and (max-width: 768px) {
    body { padding: 10px; font-size: 16px; }
    table { width: 100%; font-size: 14px; }
    input, select, button { width: 100%; margin-bottom: 10px; }
}
</style>
</head>
<body>

    <form method="POST">
        <h2>Add New Bus</h2>
        <label>Bus Name</label>
        <input type="text" name="bus_name" required>

        <label>Source</label>
        <input type="text" name="source" required>

        <label>Destination</label>
        <input type="text" name="destination" required>

        <label>Departure Time</label>
        <input type="time" name="departure_time" required>

        <label>Arrival Time</label>
        <input type="time" name="arrival_time" required>

        <label>Fare (₹)</label>
        <input type="number" step="0.01" name="fare" required>

        <label>Total Seats</label>
        <input type="number" name="total_seats" required>

        <input type="submit" value="Add Bus">
    </form>

</body>
</html>