<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics & Reports</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Statistics & Reports</h2>
        <p>Here, you can view statistics such as:</p>
        <ul>
            <li>Total number of challenges</li>
            <li>Total number of users</li>
            <li>Number of challenges solved by each user</li>
            <!-- Add more statistics as needed -->
        </ul>
        <p>You can also generate reports such as:</p>
        <ul>
            <li>Challenge completion report</li>
            <li>User activity report</li>
            <!-- Add more reports as needed -->
        </ul>
    </div>
</body>
</html>

