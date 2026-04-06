<?php
session_start();
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $u = trim($_POST['username']);
    $p = trim($_POST['password']);

    // Prepared statement for security
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $u, $p);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows) {
        $_SESSION['admin'] = $u;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "❌ Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 350px;
        }
        h2 {
            text-align: center;
            color: #cc0000;
        }
        input {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }
        button {
            width: 100%;
            background: #cc0000;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            margin-top: 15px;
            cursor: pointer;
        }
        button:hover {
            background: #990000;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        /* Mobile responsive */
        @media (max-width: 500px) {
            .login-box {
                padding: 15px;
            }
            input, button {
                font-size: 14px;
                padding: 10px;
            }
        }
    
@media screen and (max-width: 768px) {
    body { padding: 10px; font-size: 16px; }
    table { width: 100%; font-size: 14px; }
    input, select, button { width: 100%; margin-bottom: 10px; }
}
</style>
</head>
<body>

<div class="login-box">
    <h2>Admin Login</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
        <input name="username" placeholder="Username" required>
        <input name="password" type="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>