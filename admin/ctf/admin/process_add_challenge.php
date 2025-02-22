<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

// Process form submission and add the new challenge to the database
// Implement your logic to insert challenge details into the database here

// After adding challenge, redirect to manage challenges page
header('Location: manage_challenges.php');
exit();
?>
