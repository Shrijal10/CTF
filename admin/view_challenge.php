<?php
session_start();
include('includes/header.php');
include('includes/sidebar.php');
include('config/dbcon.php');


// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

require_once 'login.php';

$update_success = false;

// Fetch the challenge details
if (isset($_GET['id'])) {
    $challenge_name = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM challenges WHERE challenge_name = ?");
    $stmt->bind_param("s", $challenge_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $challenge = $result->fetch_assoc();
} else {
    header('Location: manage_challenges.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $challenge_id = $_POST['challenge_id'];
    $challenge_name = $_POST['challenge_name'];
    $points = $_POST['points'];
    $flag = $_POST['flag'];
    $solvers = $_POST['solvers'];
    $difficulty = $_POST['difficulty'];
    $description = $_POST['description'];
    $challenge_link = $_POST['link'];
    $challenge_category = $_POST['category'];
    $challenge_author = $_POST['author'];
    $challenge_additional_description = $_POST['additional_description'];
    $original_challenge_name = $_POST['original_challenge_name'];

    $stmt = $conn->prepare("UPDATE challenges SET challenge_id = ?, challenge_name = ?, points = ?, flag = ?, solvers = ?, difficulty = ?, description = ?, category = ?, link = ?, author = ?, additional_description = ? WHERE challenge_name = ?");
    $stmt->bind_param("isisisssssss", $challenge_id, $challenge_name, $points, $flag, $solvers, $difficulty, $description, $challenge_category, $challenge_link, $challenge_author, $challenge_additional_description, $original_challenge_name);

    if ($stmt->execute()) {
        $update_success = true;

        // Fetch the updated challenge details
        $stmt = $conn->prepare("SELECT * FROM challenges WHERE challenge_name = ?");
        $stmt->bind_param("s", $challenge_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $challenge = $result->fetch_assoc();
    } else {
        echo "Error updating challenge: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View/Edit Challenge</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container{
            max-width: 960px;
            padding-left: 150px;
        }
        body {
            background-image: url('data:image/jpeg;base64,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');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-position: center center;
            font-family: Arial, sans-serif;
            background-color: lightblue;
            padding: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">CTF Admin</a>
</nav>
<div class="container">
    <h2>View/Edit Challenge</h2>
    <?php if ($update_success): ?>
        <div class="alert alert-success" role="alert">
            Challenge updated successfully!
        </div>
    <?php endif; ?>
    <form action="view_challenge.php?id=<?php echo htmlspecialchars($challenge['challenge_name']); ?>" method="POST">
        <div class="form-group">
            <label for="challenge_id">Challenge ID:</label>
            <input type="number" class="form-control" id="challenge_id" name="challenge_id" value="<?php echo htmlspecialchars($challenge['challenge_id']); ?>" required>
        </div>
        <div class="form-group">
            <label for="challenge_name">Challenge Name:</label>
            <input type="text" class="form-control" id="challenge_name" name="challenge_name" value="<?php echo htmlspecialchars($challenge['challenge_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="points">Points:</label>
            <input type="number" class="form-control" id="points" name="points" value="<?php echo htmlspecialchars($challenge['points']); ?>" required readonly>
        </div>
        <div class="form-group">
            <label for="flag">Flag:</label>
            <input type="text" class="form-control" id="flag" name="flag" value="<?php echo htmlspecialchars($challenge['flag']); ?>" required>
        </div>
        <div class="form-group">
            <label for="solvers">Solvers:</label>
            <input type="number" class="form-control" id="solvers" name="solvers" value="<?php echo htmlspecialchars($challenge['solvers']); ?>" required>
        </div>
        <div class="form-group">
            <label for="difficulty">Difficulty:</label>
            <select class="form-control" id="difficulty" name="difficulty" required onchange="calculatePoints()">
                <option value="Easy" <?php echo ($challenge['difficulty'] == 'Easy') ? 'selected' : '' ?>>Easy</option>
                <option value="Medium" <?php echo ($challenge['difficulty'] == 'Medium') ? 'selected' : '' ?>>Medium</option>
                <option value="Hard" <?php echo ($challenge['difficulty'] == 'Hard') ? 'selected' : '' ?>>Hard</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Challenge Description:</label>
            <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($challenge['description']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="link">Challenge link:</label>
            <textarea class="form-control" id="link" name="link" required><?php echo htmlspecialchars($challenge['link']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="category">Challenge category:</label>
            <select class="form-control" id="category" name="category" required>
                <option value="web" <?php echo ($challenge['category'] == 'web') ? 'selected' : ''; ?>>Web</option>
                <option value="network" <?php echo ($challenge['category'] == 'network') ? 'selected' : ''; ?>>Network</option>
                <option value="misc" <?php echo ($challenge['category'] == 'misc') ? 'selected' : ''; ?>>Misc</option>
                <option value="reversing" <?php echo ($challenge['category'] == 'reversing') ? 'selected' : ''; ?>>Reversing</option>
                <option value="steg" <?php echo ($challenge['category'] == 'steg') ? 'selected' : ''; ?>>Steganography</option>
                <option value="crypt" <?php echo ($challenge['category'] == 'crypt') ? 'selected' : ''; ?>>Cryptography</option>
                <option value="operating" <?php echo ($challenge['category'] == 'operating') ? 'selected' : ''; ?>>Operating Systems</option>
                <option value="forensics" <?php echo ($challenge['category'] == 'forensics') ? 'selected' : ''; ?>>Forensics</option>
            </select>
        </div>
        <div class="form-group">
            <label for="author">Challenge author:</label>
            <textarea class="form-control" id="author" name="author" required><?php echo htmlspecialchars($challenge['author']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="additional_description">Additional Description:</label>
            <textarea class="form-control" id="additional_description" name="additional_description" required><?php echo htmlspecialchars($challenge['additional_description']); ?></textarea>
        </div>
        <input type="hidden" name="original_challenge_name" value="<?php echo htmlspecialchars($challenge['challenge_name']); ?>">
        <button type="submit" class="btn btn-primary">Update Challenge</button>
    </form>
</div>

<script>
    function calculatePoints() {
        var difficulty = document.getElementById('difficulty').value;
        var pointsField = document.getElementById('points');

        // Calculate points based on difficulty
        if (difficulty === 'Easy') {
            pointsField.value = 100;
        } else if (difficulty === 'Medium') {
            pointsField.value = 150;
        } else if (difficulty === 'Hard') {
            pointsField.value = 200;
        }
    }

    // Calculate points initially on page load
    calculatePoints();
</script>
<!-- Include Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
