<?php 
session_start(); 
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        h1 {
            color: #cc0000;
            margin-bottom: 30px;
        }
        .nav {
            display: flex;
            flex-direction: column;
            gap: 15px;
            max-width: 300px;
            margin: auto;
        }
        .nav a {
            display: block;
            padding: 12px;
            background: #cc0000;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .nav a:hover {
            background: #990000;
        }
        @media (min-width: 600px) {
            .nav {
                flex-direction: row;
                justify-content: center;
            }
            .nav a {
                width: 150px;
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

<h1>Admin Dashboard</h1>

<div class="nav">
    <a href="add_bus.php">➕ Add Bus</a>
    <a href="logout.php">🚪 Logout</a>
</div>

</body>
</html>