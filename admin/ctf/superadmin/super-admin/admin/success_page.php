<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin_login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Successful</title>
</head>
<body>
    <h1>Images Uploaded Successfully!</h1>
    <a href="add_images.php">Upload More Images</a>
</body>
</html>
