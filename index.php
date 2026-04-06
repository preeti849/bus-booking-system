<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yatra.com Clone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 100px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #d32f2f;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        button {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #d32f2f;
            color: white;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #b71c1c;
        }

        .about-link {
            text-align: center;
            margin-top: 20px;
        }

        .about-link a {
            color: #333;
            text-decoration: none;
        }

        .about-link a:hover {
            text-decoration: underline;
        }
    
@media screen and (max-width: 768px) {
    body { padding: 10px; font-size: 16px; }
    table { width: 100%; font-size: 14px; }
    input, select, button { width: 100%; margin-bottom: 10px; }
}
</style>
</head>
<body>

<div class="container">
     <h1>Welcome to Yatra.com</h1>
    <h2>Search for Buses</h2>
    <form action="search.php" method="get">
        <label for="source">Source:</label>
        <input type="text" name="source" id="source" placeholder="Enter Source (e.g. darbhanga)" required>

        <label for="destination">Destination:</label>
        <input type="text" name="destination" id="destination" placeholder="Enter Destination (e.g. muzaffarpur)" required>

        <button type="submit">Search Buses</button>
    </form>

    <div class="about-link">
        <a href="about.php">About Us</a>
    </div>
</div>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>yatra Home</title>
</head>
<body>
    <div style="text-align: right; margin: 20px;">
        <a href="logout.php" style="
            background-color: #cc0000;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        ">🚪 Logout</a>
    </div>
</body>
</html>
</body>
</html>