<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abc";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message variable
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $existingPassword = $_POST["existingPassword"];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];

    if ($newPassword !== $confirmPassword) {
        $message = "Password and confirm password do not match";
    } else {
        // Check if the TK-ID and existing password match in the database
        $sql = "SELECT * FROM login WHERE Talakunchi_id = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            $message = "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        } else {
            $stmt->bind_param("ss", $username, $existingPassword);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($stmt->errno) {
                $message = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            } else {
                if ($result->num_rows == 0) {
                    $message = "Invalid TK-ID or password";
                } else {
                    // Check if the new password is the same as the existing password
                    if ($existingPassword === $newPassword) {
                        $message = "New password cannot be the same as the existing password";
                    } else {
                        // Update the password in the database (store in plain text)
                        $updateSql = "UPDATE login SET password = ? WHERE Talakunchi_id = ?";
                        $updateStmt = $conn->prepare($updateSql);

                        if (!$updateStmt) {
                            $message = "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                        } else {
                            $updateStmt->bind_param("ss", $newPassword, $username);
                            if ($updateStmt->execute()) {
                                $message = "Password updated successfully";
                                header('Location: quests.php');
                                exit(); // Ensure script stops after redirection
                            } else {
                                $message = "Execute failed: (" . $updateStmt->errno . ") " . $updateStmt->error;
                            }
                            $updateStmt->close();
                        }
                    }
                }
            }
            $stmt->close();
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap4-neon-glow.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel='stylesheet' href='//cdn.jsdelivr.net/font-hack/2.020/css/hack.min.css'>
    <link rel="stylesheet" href="css/main.css">
    
    <style>
        body {
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            background-image: url('../uploads/password-bg.jpg');
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 400px;
            padding: 20px;
            color: white;
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.8);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            background-color: #28293e;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            color: white;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            opacity: 0.8;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Create New Password</h3>
        <?php if (!empty($message)) { echo "<div class='alert alert-danger'>" . $message . "</div>"; } ?>
        <form method="post">
            <div class="form-group">
                <label for="username">TK-ID:</label>
                <input type="text" id="username" name="username" placeholder="TK-ID" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="existingPassword">Password:</label>
                <input type="password" id="existingPassword" name="existingPassword" placeholder="Password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="newPassword">New Password:</label>
                <input type="password" id="newPassword" name="newPassword" placeholder="New Password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Set New Password</button>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery (optional, for certain Bootstrap features) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
