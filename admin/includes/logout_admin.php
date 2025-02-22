<?php
session_start(); // Start the session

// Destroy all session data
session_unset(); 
session_destroy(); 

// Optionally, clear any session cookies
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]
    );
}

// Send a response to indicate logout was successful
echo "Logout successful";
header("Location: admin_login.php");
exit;
?>