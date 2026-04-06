<?php
// Payment complete hone ke baad yeh page show hoga
$total = isset($_POST['total']) ? $_POST['total'] : 0;
$method = isset($_POST['method']) ? $_POST['method'] : "Not Selected";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .receipt-box {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: inline-block;
            min-width: 300px;
        }
        h2 {
            color: green;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #cc0000;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background: #a80000;
        }
    </style>
</head>
<body>
    <div class="receipt-box">
        <h2>✅ Payment Successful!</h2>
        <p><b>Amount Paid:</b> ₹<?php echo $total; ?></p>
        <p><b>Payment Method:</b> <?php echo $method; ?></p>
        <p>Thank you for booking with us. Have a safe journey! 🚌</p>
        <a href="index.php" class="btn">Back to Home</a>
    </div>
</body>
</html>