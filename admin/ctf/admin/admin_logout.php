<?php
session_start();

// Unset admin session variables
unset($_SESSION['admin']);

// Redirect to admin login page
header('Location: admin_login.php');
exit();
?>
