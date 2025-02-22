<?php
session_start();
include('config/dbcon.php'); // Assuming this file sets up a database connection

// Define upload directory
$upload_dir = 'uploads/';

// Create upload directory if it doesn't exist
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Helper function to handle file uploads
function handle_file_upload($file_input_name, $upload_dir) {
    if (isset($_FILES[$file_input_name]) && $_FILES[$file_input_name]['error'] === UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES[$file_input_name]['tmp_name'];
        $file_name = basename($_FILES[$file_input_name]['name']);
        $file_size = $_FILES[$file_input_name]['size'];
        $file_type = $_FILES[$file_input_name]['type'];
        $file_error = $_FILES[$file_input_name]['error'];

        // Check for errors
        if ($file_error !== UPLOAD_ERR_OK) {
            return ['success' => false, 'message' => 'Error uploading file.'];
        }

        // Validate file size (max 5MB)
        if ($file_size > 5 * 1024 * 1024) {
            return ['success' => false, 'message' => 'File size exceeds limit.'];
        }

        // Validate file type (allow only images)
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/x-icon', 'image/vnd.microsoft.icon'];
        if (!in_array($file_type, $allowed_types)) {
            return ['success' => false, 'message' => 'Invalid file type.'];
        }

        // Allow user to enter file name
        $file_name_input = $_POST['file_name'] ?? null;
        if (!$file_name_input) {
            return ['success' => false, 'message' => 'Please enter a file name.'];
        }

        // Validate file name
        $file_name = basename($file_name_input);
        if ($file_name === '') {
            return ['success' => false, 'message' => 'Invalid file name.'];
        }

        // Use entered file name
        $target_file = $upload_dir . $file_name;
        // Move file to target directory
        if (move_uploaded_file($file_tmp_name, $target_file)) {
            return ['success' => true, 'file_path' => $target_file];
        } else {
            return ['success' => false, 'message' => 'Error moving file.'];
        }
    }
    return ['success' => false, 'message' => 'No file uploaded.'];
}

// Handle file uploads
$login_image_result = handle_file_upload('login_image', $upload_dir);
$logo_image = isset($_POST['logo']) ? $_POST['logo'] : '';
$create_password_image = isset($_POST['create_password_image']) ? $_POST['create_password_image'] : '';
$profile_tab_image = isset($_POST['profile_tab_image']) ? $_POST['profile_tab_image'] : '';
$instructions_about_scorecard_image = isset($_POST['instructions_about_scorecard_image']) ? $_POST['instructions_about_scorecard_image'] : '';
$index_image = isset($_POST['index_image']) ? $_POST['index_image'] : '';

// Handle other file inputs
// Repeat for other file inputs if needed

// Example of saving results or handling form submission
if ($login_image_result['success']) {
    echo '<script>alert("Login Image uploaded successfully."); window.location.href="add_images.php";</script>';
} else {
    echo '<script>alert("Login Image upload failed: ' . htmlspecialchars($login_image_result['message']) . '"); window.location.href="add_images.php";</script>';
}

// You can save the URLs or paths to a database or handle them as needed
// Example database save (pseudo code)
// $sql = "INSERT INTO images (login_image, logo, create_password_image, profile_tab_image, instructions_about_scorecard_image, index_image)
//         VALUES (?, ?, ?, ?, ?, ?)";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param('ssssss', $login_image_result['file_path'], $logo_image, $create_password_image, $profile_tab_image, $instructions_about_scorecard_image, $index_image);
// $stmt->execute();
// $stmt->close();

?>
