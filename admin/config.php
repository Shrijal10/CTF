<?php
// config.php
$imageUrl = 'default.jpg'; // Default image URL

// Check if a custom URL is set in the session
if (isset($_SESSION['image_url'])) {
    $imageUrl = $_SESSION['image_url'];
}
?>
