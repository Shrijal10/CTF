<?php
// Start the session
session_start();
include('includes/header.php');

include('includes/sidebar.php');
include('config/dbcon.php');

// Check if the user is not logged in, redirect them to the login page
if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin_login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Challenge</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-position: center center;
            font-family: Arial, sans-serif;
            background-color: lightblue;
            padding: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .form-group label {
            color: #555;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .success-message {
            color: green;
            margin-top: 10px;
            text-align: center;
        }

        .error-message {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Add New Challenge</h2>
            <!-- Form to add new Challenge -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <?php if (!empty($error_message)): ?>
                    <p class="error-message"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="challenge_id">Challenge ID:</label>
                    <input type="number" class="form-control" id="challenge_id" name="challenge_id" required>
                </div>
                <div class="form-group">
                    <label for="challenge_name">Title:</label>
                    <input type="text" class="form-control" id="challenge_name" name="challenge_name" required>
                </div>
                <div class="form-group">
                    <label for="points">Points:</label>
                    <input type="number" class="form-control" id="points" name="points" required readonly>
                </div>
                <div class="form-group">
                    <label for="flag">Flag:</label>
                    <input type="text" class="form-control" id="flag" name="flag" required>
                </div>
                <div class="form-group">
                    <label for="difficulty">Difficulty:</label>
                    <select class="form-control" id="difficulty" name="difficulty" onchange="calculatePoints()" required>
                        <option value="Easy">Easy</option>
                        <option value="Medium">Medium</option>
                        <option value="Hard">Hard</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="web">Web</option>
                        <option value="misc">Misc</option>
                        <option value="network">Network</option>
                        <option value="reversing">Reversing</option>
                        <option value="operating">Operating</option>
                        <option value="crypt">Cryptography</option>
                        <option value="steg">Steganography</option>
                        <option value="forensics">Forensics</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="link">Link:</label>
                    <input type="text" class="form-control" id="link" name="link" required>
                </div>
                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>
                <div class="form-group">
                    <label for="additional_description">Additional Description:</label>
                    <input type="text" class="form-control" id="additional_description" name="additional_description">
                </div>
                <div class="form-group d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Add Challenge</button>
                </div>
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Database connection parameters
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
            
                // Prepare and bind SQL statement
                $stmt = $conn->prepare("INSERT INTO challenges (challenge_id, challenge_name, points, flag, difficulty, description, category, link, author, additional_description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ississssss", $challenge_id, $challenge_name, $points, $flag, $difficulty, $description, $category, $link, $author, $additional_description);
            
                // Set parameters from POST data
                $challenge_id = $_POST['challenge_id'];
                $challenge_name = $_POST['challenge_name'];
                $points = $_POST['points'];
                $flag = $_POST['flag'];
                $difficulty = $_POST['difficulty'];
                $description = $_POST['description'];
                $category = $_POST['category'];
                $link = $_POST['link'];
                $author = $_POST['author'];
                $additional_description = $_POST['additional_description'];
            
                // Execute the prepared statement
                if ($stmt->execute()) {
                    echo "<p class='success-message'>Challenge added successfully!</p>";
                } else {
                    $error_message = $stmt->error;
                    if (strpos($error_message, 'Duplicate entry') !== false) {
                        echo "<p class='error-message'>Error: Duplicate entry. Challenge with the same ID already exists.</p>";
                    } else {
                        echo "<p class='error-message'>Error adding challenge: " . $error_message . "</p>";
                    }
                }
            
                // Close statement and connection
                $stmt->close();
                $conn->close();
            }
            ?>   
        </div>
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

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
