<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "bus_booking");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$result = $conn->query("SELECT discount_percent FROM discounts WHERE id = 1");
$row = $result->fetch_assoc();
$discount_percent = $row['discount_percent'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $snack = $_POST['snack'];
    $quantity = $_POST['quantity'];
    $name = $_POST['name'];
    $seat = $_POST['seat'];
    $total_price = $_POST['total_price'];

    $sql = "INSERT INTO snacks_orders (snack, quantity, name, seat, total_price) 
            VALUES ('$snack', '$quantity', '$name', '$seat', '$total_price')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Snack ordered successfully!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Snacks</title>
    <style>
        body { font-family: Arial; background: #f8f9fa; }
        nav { background: #cc0000; padding: 10px; text-align: center; }
        nav a { color: white; text-decoration: none; margin: 0 15px; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        form { background: white; padding: 20px; border-radius: 10px; max-width: 400px; margin: 20px auto; }
        input, select { width: 100%; padding: 10px; margin: 10px 0; }
        button { background: #218838; color: white; border: none; padding: 10px; cursor: pointer; }
        button:hover { background: #28a745; }
        @media (max-width: 600px) {
            nav a { display: block; margin: 8px 0; }
            form { width: 90%; }
        }
    
@media screen and (max-width: 768px) {
    body { padding: 10px; font-size: 16px; }
    table { width: 100%; font-size: 14px; }
    input, select, button { width: 100%; margin-bottom: 10px; }
}
</style>
</head>
<body>

<nav>
    <a href="index.php">🏠 Home</a>
    <a href="about.php">📄 About Us</a>
    <a href="discount.php">🎁 Discount</a>
    <a href="logout.php">🚪 Logout</a>
</nav>

<h2 style="text-align:center;">🍴 Order Snacks (<?php echo $discount_percent; ?>% Off)</h2>
<form method="POST">
    <label>Choose Snack:</label>
    <select name="snack" id="snack" required onchange="calculateTotal()">
        <option value="">Select snacks</option>
        <option value="Sandwich" data-price="50">Sandwich - ₹50</option>
        <option value="Chips" data-price="20">Chips - ₹20</option>
        <option value="Cold Drink" data-price="30">Cold Drink - ₹30</option>
        <option value="Tea/Coffee" data-price="15">Tea/Coffee - ₹15</option>
    </select>

    <label>Quantity:</label>
    <input type="number" name="quantity" id="quantity" min="1" value="1" required oninput="calculateTotal()">

    <label>Total Price (₹):</label>
    <input type="text" name="total_price" id="total_price" readonly>

    <label>Your Name:</label>
    <input type="text" name="name" required>

    <label>Seat Number:</label>
    <input type="text" name="seat" required>

    <button type="submit">📦 Order</button>
</form>

<script>
let discountPercent = <?php echo $discount_percent; ?>;
function calculateTotal() {
    let snackSelect = document.getElementById("snack");
    let quantity = parseInt(document.getElementById("quantity").value);
    let price = parseInt(snackSelect.options[snackSelect.selectedIndex]?.getAttribute("data-price") || 0);
    
    if (price && quantity) {
        let total = price * quantity;
        let discount = (total * discountPercent) / 100;
        document.getElementById("total_price").value = total - discount;
    } else {
        document.getElementById("total_price").value = "";
    }
}
</script>

</body>