<?php
$servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "abc";
        
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
        
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

// Process deletion of user from the database
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $userID = $_GET['id'];
    // Implement your logic to delete user from the database based on talakunchi_id
    $stmt = $conn->prepare("DELETE FROM login WHERE team_name = ?");
    $stmt->bind_param("s", $userID);
    $stmt->execute();

    // Redirect back to manage users page after deletion
    header("Location: manage_users.php");
    exit();
} else {
    // If user ID is not provided, redirect to manage users page
    header('Location: manage_users.php');
    exit();
}
?>
