<?php
$name = $_POST['name'] ?? '';
$seat = $_POST['seat'] ?? '';
$snack = $_POST['snack'] ?? '';
$total = $_POST['total'] ?? '';
$method = $_POST['method'] ?? 'Not Selected';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; background: #eafaf1; }
        .box {
            max-width: 450px; margin: 30px auto; padding: 20px;
            background: white; border-radius: 10px; text-align: center;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        h2 { color: green; }
        .details { text-align: left; margin-top: 15px; }
        .btn {
            display: inline-block; background: red; color: white;
            padding: 10px 20px; border-radius: 8px; text-decoration: none;
            margin-top: 15px;
        }
        .btn:hover { background: darkred; }
    </style>
</head>
<body>
    <div class="box">
        <h2>✅ Payment Successful</h2>
        <p>Thank you for your order!</p>
        <div class="details">
            <p><b>Name:</b> <?= htmlspecialchars($name) ?></p>
            <p><b>Seat:</b> <?= htmlspecialchars($seat) ?></p>
            <p><b>Snack:</b> <?= htmlspecialchars($snack) ?></p>
            <p><b>Total Paid:</b> ₹<?= htmlspecialchars($total) ?></p>
            <p><b>Payment Method:</b> <?= htmlspecialchars($method) ?></p>
        </div>
        <a href="index.php" class="btn">🏠 Go Home</a>
    </div>
</body>
</html>