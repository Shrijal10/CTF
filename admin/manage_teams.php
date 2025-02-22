<?php
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin_login.php');
    exit();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';

// Database connection
require_once 'admin_db.php'; // Connection to the admin database

$usersPerPage = 10; // Number of teams per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $usersPerPage;

// Get total number of teams from admin database
$totalTeamsQuery = $admin_conn->query("SELECT COUNT(*) as total FROM teams");
$totalTeamsRow = $totalTeamsQuery->fetch_assoc();
$totalTeams = $totalTeamsRow['total'];
$totalPages = ceil($totalTeams / $usersPerPage);

// Fetch teams for the current page from admin database
$stmt = $admin_conn->prepare("SELECT team_id, team_name, no_of_members, name_of_members FROM teams LIMIT ? OFFSET ?");
$stmt->bind_param('ii', $usersPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Teams</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #dfd8d8;
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
            transition: all 0.3s ease;
        }
        .list-group-item:hover {
            background-color: #d6d6d6;
            transform: translateY(-3px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }
        .sidenav {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #333;
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
            background-color: #007bff;
            color: #fff;
        }
        .container {
            margin-left: 230px;
            padding: 60px;
            padding-top: 0px;
        }
        .ml {
            margin-left: 58rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">CTF Admin</a>
    <div class="dropdown ml-auto">
        <a class="nav-link dropdown-toggle" href="#" role="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i> <?php echo $username; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="admin_logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="sidenav">
    <a href="manage_challenges.php"><i class="fas fa-dumbbell mr-2"></i> Manage Challenges</a>
    <a href="manage_users.php"><i class="fas fa-user-friends mr-2"></i> Manage Users</a>
    <a href="manage_teams.php" class="active"><i class="fas fa-users mr-2"></i> Manage Teams</a>
</div>

<div class="container">
    <h2 class="text-center mt-4">Manage Teams</h2>
    <div class="ml">
        <a href="add_teams.php" class="btn btn-primary">Add Teams</a>
    </div>
    <!-- List of existing teams -->
    <ul class="list-group">
        <?php while ($row = $result->fetch_assoc()): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>Team Name:</strong> <?php echo htmlspecialchars($row['team_name']); ?><br>
                    <strong>Members Number:</strong> <?php echo htmlspecialchars($row['no_of_members']); ?><br>
                    <strong>Members:</strong> <?php echo htmlspecialchars($row['name_of_members']); ?>
                </div>
                <div>
                    <a href="edit_teams.php?team_id=<?php echo htmlspecialchars($row['team_id']); ?>" class="btn btn-sm btn-info mr-2">View/Edit</a>
                    <a href="delete_team.php?id=<?php echo htmlspecialchars($row['team_id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this team?');">Delete</a>
                </div>
            </li>
        <?php endwhile; ?>
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS and other scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
