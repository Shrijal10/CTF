<?php

session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abc";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    echo "Connection failed " . mysqli_connect_error();
    exit;
}

// Check if the user is logged in
if (isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

    // Prepare the query
    $sql = "UPDATE `login` SET `session_token` = NULL WHERE `team_name` = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "s", $user);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Close the statement
        mysqli_stmt_close($stmt);

        // Unset user session variables
        unset($_SESSION['user_name']);

        // Destroy the session if no admin session is active
        if (!isset($_SESSION['admin'])) {
            session_destroy();
        }

        // Redirect to login page
        header('Location: loginh.php');
        exit();
    } else {
        echo "Error in preparing statement: " . mysqli_error($conn);
    }
} else {
    header('Location: loginh.php');
}

// Close the connection
mysqli_close($conn);
?>
