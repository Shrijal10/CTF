<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

// Process form submission and update user details in the database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    $userID = $_POST['user_id'];
    // Implement your logic to update user details in the database based on user ID
    // Redirect back to view/edit user page after updating
    header("Location: view_user.php?id=$userID");
    exit();
} else {
    // If user ID is not provided, redirect to manage users page
    header('Location: manage_users.php');
    exit();
}
?>
