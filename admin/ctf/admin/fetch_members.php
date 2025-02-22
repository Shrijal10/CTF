<?php
// Connect to database (adjust credentials as per your setup)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abc";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch members based on search term
$searchTerm = $_POST['searchTerm']; // Assuming it's a POST request

$sql = "SELECT team_name FROM admin.login WHERE team_name LIKE '%$searchTerm%'";
$result = $conn->query($sql);

$members = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $members[] = $row;
    }
}

$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($members);
?>
