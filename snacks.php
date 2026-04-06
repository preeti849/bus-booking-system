<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "yatra");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $snack = $_POST['snack'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $name = $_POST['name'];
    $seat = $_POST['seat'];

    $discount_percent = 5; // FIXED DISCOUNT
    $total_price = $price * $quantity;
    $discount_amount = ($total_price * $discount_percent) / 100;
    $final_price = $total_price - $discount_amount;

    $sql = "INSERT INTO snacks_orders (snack, price, quantity, discount_percent, name, seat, total_price) 
            VALUES ('$snack', '$price', '$quantity', '$discount_percent', '$name', '$seat', '$final_price')";

    if ($conn->query($sql) === TRUE) {
        header("Location: receipt.php?name=" . urlencode($name) . "&seat=" . urlencode($seat) . "&snack=" . urlencode($snack) . "&price=$price&quantity=$quantity&discount=$discount_percent&total=$final_price");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Snacks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f8f9fa; }
        header { background-color: red; color: white; padding: 15px; text-align: center; font-size: 22px; font-weight: bold; }
        form {
            background: white; padding: 20px; border-radius: 10px; 
            max-width: 400px; margin: 20px auto; box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input, select, button {
            width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #ccc; border-radius: 5px;
        }
        button, .about-btn, .home-btn {
            background-color: #218838; color: white; border: none;
            padding: 10px; border-radius: 8px; text-decoration: none; font-weight: bold;
            display: inline-block; text-align: center;
        }
        button:hover, .about-btn:hover, .home-btn:hover { background-color: #28a745; }
        #totalPrice { font-weight: bold; color: green; margin-top: 5px; }
        @media (max-width: 480px) {
            form { margin: 10px; padding: 15px; }
            header { font-size: 18px; }
        }
    
@media screen and (max-width: 768px) {
    body { padding: 10px; font-size: 16px; }
    table { width: 100%; font-size: 14px; }
    input, select, button { width: 100%; margin-bottom: 10px; }
}
</style>
    <script>
        function setPrice() {
            var snackPrices = {
                "Sandwich": 30,
                "Kurkure": 20,
                "Cold Drink": 40,
                "Pizza": 80,
                "Biscuit": 10,
                "Lays": 25
            };
            var selectedSnack = document.getElementById("snack").value;
            document.getElementById("price").value = snackPrices[selectedSnack] || "";
            calculateTotal();
        }

        function calculateTotal() {
            var price = parseFloat(document.getElementById("price").value) || 0;
            var quantity = parseInt(document.getElementById("quantity").value) || 0;
            var discount = 5; // FIXED DISCOUNT
            var total = price * quantity;
            total -= (total * discount) / 100;
            document.getElementById("totalPrice").innerText = "Total Price (5% OFF): ₹" + total;
        }
    </script>
</head>
<body>
<header>🍔 yatra.com Snacks Order</header>
<form method="POST">
    <label>Choose Snack:</label>
    <select name="snack" id="snack" onchange="setPrice()" required>
        <option value="">Select your snack 🍫🥤🧋</option>
        <option value="Sandwich">Sandwich - ₹30</option>
        <option value="Kurkure">Kurkure - ₹20</option>
        <option value="Cold Drink">Cold Drink - ₹40</option>
        <option value="Pizza">Pizza - ₹80</option>
        <option value="Biscuit">Biscuit - ₹10</option>
        <option value="Lays">Lays - ₹25</option>
    </select>

    <label>Price (₹):</label>
    <input type="number" name="price" id="price" readonly required>

    <label>Quantity:</label>
    <input type="number" name="quantity" id="quantity" min="1" required oninput="calculateTotal()">

    <label>Your Name:</label>
    <input type="text" name="name" required>

    <label>Seat Number:</label>
    <input type="text" name="seat" required>

    <p id="totalPrice">Total Price (5% OFF): ₹0</p>

    <button type="submit">📦 Order</button>
    <a href="about.php" class="about-btn">📄 About</a>
    <a href="index.php" class="home-btn">🏠 Home</a>
</form>
</body>
</html>