<?php

$host ="localhost";
$username = "root";
$password = "";
$database = "phpadminpanel";

$con = mysqli_connect($host, $username, $password, $database);

if (!$con) {
    header("Location: ../errors/db.php");
    exit();
}
// else{
//     echo "database Connected";
// }
?>