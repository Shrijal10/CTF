<?php
error_reporting(0);
// Database connection parameters
$servername = "localhost";
$username ="root";
$password = "";
$dbname = "abc";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn) {
    //echo "Connected successfully";
    } else {
        echo "Connection failed ".mysqli_connect_error();
    }
?>
