<?php
$name = $_GET['name'] ?? '';
$seat = $_GET['seat'] ?? '';
$snack = $_GET['snack'] ?? '';
$price = $_GET['price'] ?? '';
$quantity = $_GET['quantity'] ?? '';
$discount = $_GET['discount'] ?? '';
$total = $_GET['total'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; margin: 0; padding: 0; }
        .receipt {
            background: white; max-width: 420px; margin: 20px auto;
            padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            background: red; color: white; padding: 10px; border-radius: 8px; text-align: center;
        }
        table { width: 100%; margin-top: 15px; }
        td { padding: 5px; }
        .total { font-weight: bold; color: green; font-size: 18px; }
        .btn {
            display: block; background: #218838; color: white;
            padding: 10px; text-align: center; margin: 10px 0;
            border-radius: 8px; text-decoration: none;
        }
        .btn:hover { background: #28a745; }
        .print-btn {
            background: #007bff;
        }
        .print-btn:hover {
            background: #0056b3;
        }
        .payment-box {
            margin-top: 20px; padding: 15px; border: 1px solid #ccc; border-radius: 8px;
            background: #f1f1f1;
        }
        .pay-btn {
            background: red; color: white; padding: 10px 20px; border: none;
            border-radius: 5px; cursor: pointer; font-size: 16px;
        }
        .pay-btn:hover { background: darkred; }
        @media (max-width: 480px) {
            .receipt { margin: 10px; padding: 15px; }
            h2 { font-size: 20px; }
        }
    </style>
    <script>
        function printReceipt() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="receipt">
        <h2>🧾 Order Receipt</h2>
        <p><b>Name:</b> <?= htmlspecialchars($name) ?></p>
        <p><b>Seat:</b> <?= htmlspecialchars($seat) ?></p>
        <table>
            <tr><td>Snack:</td><td><?= htmlspecialchars($snack) ?></td></tr>
            <tr><td>Price:</td><td>₹<?= htmlspecialchars($price) ?></td></tr>
            <tr><td>Quantity:</td><td><?= htmlspecialchars($quantity) ?></td></tr>
            <tr><td>Discount:</td><td><?= htmlspecialchars($discount) ?>%</td></tr>
            <tr class="total"><td>Total:</td><td>₹<?= htmlspecialchars($total) ?></td></tr>
        </table>

        <!-- Payment Options -->
        <div class="payment-box">
            <h3>💳 Choose Payment Method</h3>
            <form action="paymentsuccess.php" method="POST">
                <input type="hidden" name="name" value="<?= $name ?>">
                <input type="hidden" name="seat" value="<?= $seat ?>">
                <input type="hidden" name="snack" value="<?= $snack ?>">
                <input type="hidden" name="total" value="<?= $total ?>">

                <label><input type="radio" name="method" value="UPI / Phone Number" required> 📱 UPI / Mobile</label><br>
                <label><input type="radio" name="method" value="Card Payment"> 💳 Debit/Credit Card</label><br>
                <label><input type="radio" name="method" value="Net Banking"> 🌐 Net Banking</label><br>
                <label><input type="radio" name="method" value="Cash on Delivery"> 💵 Cash on Delivery</label><br><br>

                <button type="submit" class="pay-btn">Proceed to Pay</button>
            </form>
        </div>

        <a href="snacks.php" class="btn">🛒 Order Again</a>
        <a href="index.php" class="btn">🏠 Home</a>
        <button class="btn print-btn" onclick="printReceipt()">🖨 Print Receipt</button>
    </div>
</body>
</html>