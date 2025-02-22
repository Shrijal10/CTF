<?php
// Start the session
session_start();

// Check if the user is not logged in, redirect them to the login page
if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Assume username is stored in session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-position: center center;
        }
        body:after {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            content: '';
            background: #000;
            opacity: .3;
            z-index: -1;
        }
        .sidenav {
        height: 100%;
        width: 250px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #333; /* Dark gray sidebar background */
        padding-top: 50px;
        }
        .sidenav a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }
        .sidenav a:hover {
            background-color: #575757;
        }
        .dropdown-menu {
            background-color: #111;
            color: white;
        }
        .dropdown-menu a {
            color: white;
        }
        .dropdown-menu a:hover {
            background-color: #575757;
        }
        .container {
            margin-left: 200px;
            padding: 60px;
        }
        .dashboard-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .sidenav a.active {
            background-color: #007bff;
            color: white;
        }
        .card {
            background-color: transparent;
            border: ridge;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff; /* Blue header background */
            color: #fff; /* White header text */
            border-radius: 10px 10px 0 0;
        }
        .card-body {
            background-color: transparent; /* White body background */
        }
    </style>
</head>
<body>
    <div class="sidenav">
        <div class="dropdown">
            <a class="btn btn dropdown-toggle w-100 text-left" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $username; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="admin_logout.php">Logout</a>
            </div>
        </div>
        <a href="admin_dashboard.php" class="active">Admin dashboard</a>
        <a href="manage_challenges.php">Manage Challenges</a>
        <a href="manage_users.php">Manage Users</a>
    </div>
    <div class="container">
        <h2 class="dashboard-title">Welcome to Admin Dashboard</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Manage Challenges
                    </div>
                    <div class="card-body">
                        <p class="card-text">Here you can manage challenges.</p>
                        <a href="manage_challenges.php" class="btn btn-primary">Go to Challenges</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Manage Users
                    </div>
                    <div class="card-body">
                        <p class="card-text">Here you can manage users.</p>
                        <a href="manage_users.php" class="btn btn-primary">Go to Users</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Logout
                    </div>
                    <div class="card-body">
                        <p class="card-text">Click here to logout.</p>
                        <a href="admin_logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Include Bootstrap JS and dependencies -->

<!-- Include Bootstrap JS and dependencies -->
 
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
