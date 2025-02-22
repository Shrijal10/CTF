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

        session_unset();
        session_destroy();

        // Redirect to login page
        header('Location: loginh');
        exit;
    } else {
        echo "Error in preparing statement: " . mysqli_error($conn);
    }
} else {
    header('Location: loginh');
}

// Close the connection
mysqli_close($conn);

?>
