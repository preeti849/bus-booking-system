<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "bus_booking");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if (isset($_POST['save_discount'])) {
    $discount = (int)$_POST['discount'];
    $conn->query("UPDATE discounts SET discount_percent = $discount WHERE id = 1");
    echo "<script>alert('Discount updated successfully!');</script>";
}

$result = $conn->query("SELECT discount_percent FROM discounts WHERE id = 1");
$row = $result->fetch_assoc();
$current_discount = $row['discount_percent'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Discount</title>
    <style>
        body { font-family: Arial; background: #f8f9fa; }
        form { background: white; padding: 20px; max-width: 300px; margin: 50px auto; border-radius: 10px; }
        input, button { width: 100%; padding: 10px; margin: 10px 0; }
        button { background: #cc0000; color: white; border: none; cursor: pointer; }
        button:hover { background: #a00000; }
    
@media screen and (max-width: 768px) {
    body { padding: 10px; font-size: 16px; }
    table { width: 100%; font-size: 14px; }
    input, select, button { width: 100%; margin-bottom: 10px; }
}
</style>
</head>
<body>
    <h2 style="text-align:center;">🎁 Set Discount</h2>
    <form method="POST">
        <label>Discount Percentage (%)</label>
        <input type="number" name="discount" value="<?php echo $current_discount; ?>" min="0" max="100" required>
        <button type="submit" name="save_discount">Save</button>
    </form>
</body>
</html>