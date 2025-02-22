<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

$admin_conn = new mysqli($servername, $username, $password, $dbname);

if ($admin_conn->connect_error) {
    die("Connection failed: " . $admin_conn->connect_error);
}
?>
