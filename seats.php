<?php
// seats.php
$conn = mysqli_connect("localhost", "root", "", "yatra");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$bus_id = $_GET['bus_id'];
$seats = [];

// Bus ka fare nikalna
$busQuery = mysqli_query($conn, "SELECT * FROM buses WHERE id = $bus_id");
$busData = mysqli_fetch_assoc($busQuery);
$seat_price = $busData['fare'];

// Seats fetch
$result = mysqli_query($conn, "SELECT * FROM seats WHERE bus_id = $bus_id");
while ($row = mysqli_fetch_assoc($result)) {
    $seats[] = $row;
}

// Book seats → Payment page
if (isset($_POST['book']) && isset($_POST['seats'])) {
    $selected_seats = implode(",", $_POST['seats']);
    $count = count($_POST['seats']);
    $total = $count * $seat_price;

    header("Location: payment.php?bus_id=$bus_id&seats=$selected_seats&total=$total");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }

        h2 {
            color: #cc0000;
        }

        .seat-layout {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .seat-row {
            display: flex;
            gap: 10px;
        }

        label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 50px;
            border: 1px solid #ccc;
            background-color: #fff;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
        }

        input.seat {
            display: none;
        }

        input.seat:checked + span {
            background-color: #28a745;
            color: #fff;
        }

        .booked-seat {
            background-color: #999;
            color: white;
            pointer-events: none;
        }

        .submit-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background: #cc0000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #a80000;
        }

        a {
            text-decoration: none;
            color: #cc0000;
            font-weight: bold;
        }
    
        @media screen and (max-width: 768px) {
            body { padding: 10px; font-size: 16px; }
            .seat-row { gap: 5px; }
            label { width: 45px; height: 40px; font-size: 12px; }
            .submit-btn { width: 100%; }
        }
    </style>
</head>
<body>

<h2>Select Your Seats</h2>
<p><b>Price per seat:</b> ₹<?php echo $seat_price; ?></p>
<a href="index.php">Home</a> | <a href="about.php">About</a><br><br>

<form method="POST">
    <div class="seat-layout">
        <?php
        $rows = ['A', 'B', 'C', 'D'];
        $cols = [1, 2, 3, 4];

        foreach ($rows as $row) {
            echo "<div class='seat-row'>";
            foreach ($cols as $col) {
                $seat_num = $row . $col;
                $is_booked = false;

                foreach ($seats as $s) {
                    if ($s['seat_number'] == $seat_num && $s['is_booked']) {
                        $is_booked = true;
                        break;
                    }
                }

                if ($is_booked) {
                    echo "<div class='booked-seat' style='width:60px;height:50px;text-align:center;border:1px solid #ccc;border-radius:5px;'>$seat_num</div>";
                } else {
                    echo "<label>
                            <input type='checkbox' name='seats[]' value='$seat_num' class='seat'>
                            <span>$seat_num</span>
                          </label>";
                }
            }
            echo "</div>";
        }
        ?>
    </div>
    <input type="submit" name="book" value="Proceed to Payment" class="submit-btn">
</form>
</body>
</html>