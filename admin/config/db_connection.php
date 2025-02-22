<?php
$host = 'localhost'; // Example: 'localhost'
$dbname = 'ctf'; // Example: 'my_database'
$username = 'root'; // Example: 'root'
$password = ''; // Example: 'password'

// Create connection
$con = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
