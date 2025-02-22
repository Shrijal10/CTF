<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Directory where images will be saved
$upload_dir = 'uploads/';

// Ensure the uploads directory exists
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if (isset($_FILES['login_image']) && $_FILES['login_image']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['login_image']['tmp_name'];
    $file_name = basename($_FILES['login_image']['name']);
    $file_path = $upload_dir . $file_name;

    if (move_uploaded_file($file_tmp, $file_path)) {
        // Redirect to the page with the new image as a query parameter
        header('Location: your_page.php?img=' . urlencode($file_name));
        exit();
    } else {
        echo "Failed to upload file: " . $_FILES['login_image']['name'];
    }
} else {
    echo "No file uploaded or upload error.";
}
