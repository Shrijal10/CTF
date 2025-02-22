<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

require_once 'login.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $original_challenge_name = $_POST['original_challenge_name'];
    $challenge_name = $_POST['challenge_name'];
    $flag = $_POST['flag'];
    $challenge_solvers = $_POST['solvers'];
    $challenge_difficulty = $_POST['difficulty'];
    $challenge_description = $_POST['challenge_description'];
    $challenge_points = $_POST['challenge_points'];
    $challenge_category = $_POST['category'];
    $challenge_link =$_POST['link'];
    $challenge_author=$_POST['author'];
    $challenge_additional_description=$_POST['additional_description'];

    $stmt = $conn->prepare("UPDATE challenges SET challenge_name = ?, flag = ?, solvers = ?, difficulty = ?, description = ?, points = ?,category=?,link=?,author=?,additional_description=? WHERE challenge_name = ?");

    $stmt->bind_param("ssis", $challenge_name, $challenge_description, $challenge_points, $original_challenge_name);
    if ($stmt->execute()) {
        header('Location: manage_challenges.php');
        exit();
    } else {
        echo "Error updating challenge: " . $stmt->error;
    }
}
?>
