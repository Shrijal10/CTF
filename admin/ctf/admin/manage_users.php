<?php
// Start the session
session_start();

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin_login.php');
    exit();
}
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';

// Pagination logic
require_once 'login.php';
$usersPerPage = 10; // Number of users per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $usersPerPage;

// Get total number of users
$totalUsersQuery = $conn->query("SELECT COUNT(*) as total FROM login");
$totalUsersRow = $totalUsersQuery->fetch_assoc();
$totalUsers = $totalUsersRow['total'];
$totalPages = ceil($totalUsers / $usersPerPage);

// Fetch users for the current page
$stmt = $conn->prepare("SELECT team_name FROM login LIMIT ? OFFSET ?");
$stmt->bind_param('ii', $usersPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
    body {
        background-color: #dfd8d8;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-position: center center;
    }

    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #fff;
        border: none;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease; /* Smooth transition for hover effect */
    }

    .list-group-item:hover {
        background-color: #d6d6d6; /* Light gray background on hover */
        transform: translateY(-3px); /* Move the element slightly upwards */
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); /* Add a subtle shadow */
         color: #007bff;
    }

    .list-group-item:hover:after {
        background-color: #007bff; /* Outstanding hover effect color */
    }

    .list-group-item:last-child {
        margin-bottom: 10px;
    }

    .sidenav {
        height: 100%;
        width: 250px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #333; /* Dark gray sidebar background */
        padding-top: 60px;
    }

    .sidenav a {
        padding: 15px 15px;
        text-decoration: none;
        font-size: 18px;
        color: white;
        display: block;
    }

    .sidenav a:hover {
        background-color: #007bff; /* Blue background on hover */
        color: #fff; /* White text color on hover */
    }

    .dropdown-menu {
        background-color: #333;
        color: #fff;
        min-width: 0%;
    }

    .dropdown-menu a {
        color: white;
    }

    .dropdown-menu a:hover {
        background-color: #007bff;
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

    .card {
        background-color: #ffffff;
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

    .sidenav a.active {
        background-color: #007bff;
        color: #fff;
    }

    .main {
        margin-left: 250px;
        padding: 60px 10px;
    }

    .mt-4 {
        margin-top: 1.5rem !important;
    }

    .ml{
        margin-left: 58rem;
        margin-bottom: 10px;
    }
    
</style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">CTF Admin</a>
    <div class="dropdown ml-auto mr-0">
        <a class="nav-link dropdown-toggle" href="#" role="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i> <?php echo $username; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="admin_logout.php">Logout</a>
        </div>
    </div>
</nav>
    <div class="sidenav">
        <!-- <a href="admin_dashboard.php"><i class="fas fa-home mr-2"></i> Admin dashboard</a> -->
        <a href="manage_challenges.php"><i class="fas fa-dumbbell mr-2"></i> Manage Challenges</a>
        <a href="manage_users.php" class="active"><i class="fas fa-user-friends mr-2"></i> Manage Users</a>
        <a href="manage_teams.php"><i class="fas fa-users mr-2"></i>Manage Teams</a>
    </div>

    <div class="container">
        <h2 class="text-center mt-4">Manage Users</h2>
        <div class="ml">
            <a href="add_user.php" class="btn btn-primary">Add User</a>
        </div>
        <!-- List of existing users -->
        <ul class="list-group">
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo $row['team_name']; ?>  
                <div>
                    <a href="view_user.php?id=<?php echo $row['team_name']; ?>" class="btn btn-sm btn-info mr-2">View/Edit</a> 
                    <a href="delete_user.php?id=<?php echo $row['team_name']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </div>
            </li>
        <?php
        }
        ?>
        </ul>
        <!-- Pagination controls -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end mt-4">
                <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <?php if ($page < $totalPages): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <!-- Bootstrap JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
