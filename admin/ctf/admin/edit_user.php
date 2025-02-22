<?php
// Start the session
session_start();

// Check if the user is not logged in, redirect them to the login page
if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin_login.php');
    exit();
}


// Fetch user details based on user ID (passed in URL)
$userID = $_GET['id']; // Example of getting user ID from URL parameter
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

// Fetch user details based on user ID
$stmt = $conn->prepare("SELECT Talakunchi_id, team_name, password FROM login WHERE team_name = ?");
$stmt->bind_param("s", $userID);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body{
        background-image: url('data:image/jpeg;base64,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');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-position: center center;
        }
        .form {
            background-color: white;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <form method="POST">
            <div class="form-group">
                <label for="talakunchi_id">Talakunchi_id:</label>
                <input type="number" class="form-control" id="talakunchi_id" name="talakunchi_id" value="<?php echo $userData['Talakunchi_id']; ?>" required>
            </div>

            <div class="form-group">
                <label for="team_name">Team_name:</label>
                <input type="text" class="form-control" id="team_name" name="team_name" value="<?php echo $userData['team_name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" class="form-control" id="password" name="password" value="<?php echo $userData['password']; ?>" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update User</button>
            </div>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['talakunchi_id'], $_POST['team_name'], $_POST['password'])) {
                $talakunchi_id = $_POST['talakunchi_id'];
                $team_name = $_POST['team_name'];
                $password = $_POST['password'];
            
                // Attempt to update the database
                try {
                    $stmt = $conn->prepare("UPDATE login SET Talakunchi_id = ?, team_name = ?, password = ? WHERE team_name = ?");
                    if (!$stmt) {
                        throw new Exception("Error preparing statement: " . $conn->error);
                    }
                    
                    $stmt->bind_param("isss", $talakunchi_id, $team_name, $password, $userID);
                    if (!$stmt->execute()) {
                        throw new Exception("Error executing statement: " . $stmt->error);
                    }
            
                    echo '<div class="alert alert-success" role="alert">User updated successfully!</div>';
                } catch (Exception $e) {
                    // Display error message
                    echo '<div class="alert alert-danger" role="alert">An error occurred: ' . $e->getMessage() . '</div>';
                }
            }            
            ?>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

