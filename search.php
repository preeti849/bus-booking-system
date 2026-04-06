<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "yatra");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form values
$source = $_GET['source'];
$destination = $_GET['destination'];

// Query to fetch buses
$sql = "SELECT * FROM buses WHERE source='$source' AND destination='$destination'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f7f7f7;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0px 0px 10px #ccc;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #cc0000;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: #cc0000;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        h2 {
            color: #cc0000;
        }
        .nav {
            margin-bottom: 20px;
        }
        .nav a {
            margin-right: 20px;
        }
    
@media screen and (max-width: 768px) {
    body { padding: 10px; font-size: 16px; }
    table { width: 100%; font-size: 14px; }
    input, select, button { width: 100%; margin-bottom: 10px; }
}
</style>
</head>
<body>

<h2>Available Buses</h2>

<div class="nav">
    <a href="index.php">Home</a> |
    <a href="about.php">About</a>
</div>

<?php
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>
            <th>Bus Name</th>
            <th>From</th>
            <th>To</th>
            <th>Departure - Arrival</th>
            <th>Fare</th>
            <th>Action</th>
          </tr>";

    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["bus_name"] . "</td>";
        echo "<td>" . $row["source"] . "</td>";
        echo "<td>" . $row["destination"] . "</td>";
        echo "<td>" . $row["departure_time"] . " - " . $row["arrival_time"] . "</td>";
        echo "<td>₹" . $row["fare"] . "</td>";
        echo "<td><a href='seats.php?bus_id=" . $row["id"] . "'>Book Seats</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No buses found for your selected route.</p>";
}

mysqli_close($conn);
?>

</body>
</html>