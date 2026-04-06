<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - yatra.com Clone</title>
    <link rel="stylesheet" href="style_info.css">
</head>
<body>

<div style="text-align: right; margin: 10px;">
  <a href="logout.php" class="btn">🚪 Logout</a>
</div>

<h2>About yatra.com Clone</h2>
<div class="info-box">
    <p>This is a mini project created by <strong>Preeti</strong>.  
       You can search for buses, choose seats, and book tickets online easily.</p>
</div>

<div class="info-box">
    <h3>📞 Emergency Contact</h3>
    <p><strong>Helpline Number:</strong> <a href="tel:+919876543210">+91 98765 43210</a></p>
    <p><strong>Email Us:</strong> <a href="mailto:support@yatra.comclone.com">support@yatra.comclone.com</a></p>
</div>

<div style="text-align:center;">
    <a href="snacks.php" class="btn">🍿 Order Snacks</a>
    <a href="index.php" class="btn">🏠 Home</a>
</div>

</body>
</html>