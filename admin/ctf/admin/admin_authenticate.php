<?php
session_start();
// Check if username and password are correct (you should replace this with your authentication logic)
$username = $_POST['username'];
$password = $_POST['password'];

// Example authentication (replace with your actual authentication logic)
if ($username === 'admin' && $password === 'admin@123') {
    // Authentication successful
    $_SESSION['admin'] = true;
    header('Location: admin_dashboard.php');
    exit();
} else {
    // Authentication failed
    echo "Invalid username or password.";
}
?>