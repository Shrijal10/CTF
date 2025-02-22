<?php
// Start the session
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

// Pagination logic
require_once 'login.php';
$challengesPerPage = 10; // Number of challenges per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $challengesPerPage;

// Get total number of challenges
$totalChallengesQuery = $conn->query("SELECT COUNT(*) as total FROM challenges");
$totalChallengesRow = $totalChallengesQuery->fetch_assoc();
$totalChallenges = $totalChallengesRow['total'];
$totalPages = ceil($totalChallenges / $challengesPerPage);

// Fetch challenges for the current page
$stmt = $conn->prepare("SELECT challenge_name FROM challenges LIMIT ? OFFSET ?");
$stmt->bind_param('ii', $challengesPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Challenges</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #dfd8d8;
    }

    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #fff; /* White background */
        border: none;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease; 
    }

    .list-group-item:hover {
        background-color: #f8f8f8; 
        transform: translateY(-3px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); 
        color: #007bff; 
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

    .container {
        margin-left: 250px;
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
        background-color: #ffffff; /* White body background */
    }

    .sidenav a.active {
        background-color: #007bff; /* Blue background for active link */
        color: #fff; /* White text color for active link */
    }

    .main {
        margin-left: 250px;
        padding: 0px 10px;
    }

    .mt-4 {
        margin-top: 1.5rem !important;
    }
    .ml{
        margin-left: 59rem;
        margin-bottom: 10px;
    }
</style>
</head>
<body>


    <div class="main">
        <h2 class="text-center mt-4">Manage Challenges</h2>
        <div class="ml">
            <a href="add_challenge.php" class="btn btn-primary">Add Challenge</a>
        </div>
        <!-- List of existing challenges -->
        <!-- Each challenge should have options to view/edit or delete -->
        <ul class="list-group">
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo $row['challenge_name']; ?>
                <div>
                    <a href="view_challenge.php?id=<?php echo $row['challenge_name']; ?>" class="btn btn-sm btn-info mr-2">View/Edit</a>
                    <a href="delete_challenge.php?id=<?php echo $row['challenge_name']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this challenge?');">Delete</a>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
