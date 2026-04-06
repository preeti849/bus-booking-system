<?php
session_start();
include 'db.php';
$login_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['name'];
        header("Location: index.php");
        exit();
    } else {
        $login_error = "Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - yatra.com</title>
    <style>
        body {
            background: #f44336;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
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
        .error { color: red; margin-bottom: 10px; }
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
<div class="login-box">
    <h2>Login</h2>
    <?php if ($login_error != '') echo "<div class='error'>$login_error</div>"; ?>
    <form method="post">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</div>
</body>
</html>