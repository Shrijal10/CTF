<?php
session_start();

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Ensure team_id and member parameters are provided
if (!isset($_GET['team_id']) || !isset($_GET['member'])) {
    header('Location: manage_teams.php');
    exit();
}

$team_id = $_GET['team_id'];
$member = $_GET['member'];

// Establish connection to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch current members of the team
$query_select_members = "SELECT name_of_members FROM teams WHERE team_id = ?";
$stmt_select_members = $conn->prepare($query_select_members);
$stmt_select_members->bind_param("i", $team_id);
$stmt_select_members->execute();
$result_select_members = $stmt_select_members->get_result();

if ($result_select_members->num_rows > 0) {
    $row = $result_select_members->fetch_assoc();
    $current_members = explode(", ", $row['name_of_members']);
} else {
    echo "Team not found.";
    exit();
}

$stmt_select_members->close();

// Remove the member from the array of current members
$new_members = array_diff($current_members, [$member]);

// Update the team with the new members list
$query_update_team = "UPDATE teams SET name_of_members = ? WHERE team_id = ?";
$stmt_update_team = $conn->prepare($query_update_team);
$members_str = implode(", ", $new_members);
$stmt_update_team->bind_param("si", $members_str, $team_id);
try {
    $stmt_update_team->execute();
    echo '<div class="alert alert-success" role="alert">Member deleted successfully!</div>';
} catch (mysqli_sql_exception $e) {
    echo '<div class="alert alert-danger" role="alert">Error: ' . $e->getMessage() . '</div>';
}

$stmt_update_team->close();

// Redirect back to the current page
echo '<script>
        setTimeout(function() {
            history.go(-1);
        }, 500);
      </script>';
$conn->close();
?>