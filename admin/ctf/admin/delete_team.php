<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

require_once 'admin_db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $teamID = $_GET['id'];
    
    // Implement your logic to delete the user from the database based on team ID
    $stmt = $admin_conn->prepare("DELETE FROM teams WHERE team_id = ?");
    $stmt->bind_param("i", $teamID);

    if ($stmt->execute()) {
        // Redirect back to manage teams page after successful deletion
        header("Location: manage_teams.php");
        exit();
    } else {
        // Handle error, if deletion fails
        echo "Error deleting record: " . $admin_conn->error;
    }
} else {
    // If user ID is not provided, redirect to manage teams page
    header('Location: manage_teams.php');
    exit();
}
?>
