<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - yatra.com</title>
  <style>
    body {
        background: #f44336;
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .box {
        background: white;
        padding: 40px;
        border-radius: 10px;
        width: 320px;
        box-shadow: 0 0 15px rgba(0,0,0,0.3);
        text-align: center;
    }
    h2 { color: #cc0000; margin-bottom: 20px; }
    input {
        width: 100%;
        padding: 12px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    button {
        width: 100%;
        padding: 12px;
        background: #cc0000;
        color: white;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
    }
    button:hover { background: #a30000; }
    a { color: #cc0000; text-decoration: none; }
    a:hover { text-decoration: underline; }
  
@media screen and (max-width: 768px) {
    body { padding: 10px; font-size: 16px; }
    table { width: 100%; font-size: 14px; }
    input, select, button { width: 100%; margin-bottom: 10px; }
}
</style>
</head>
<body>
<div class="box">
  <h2>Register</h2>
  <form method="post">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email Address" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="register">Signup</button>
  </form>
  <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>

<?php
if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already registered!');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $pass);
        if ($stmt->execute()) {
            echo "<script>alert('Registered Successfully'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Error: Could not register.');</script>";
        }
    }
}
?>