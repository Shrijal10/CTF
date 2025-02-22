<?php
session_start();
include('config/dbcon.php');

if(isset($_POST['delete_btn'])) {
  $user_id = $_POST['delete_user_id'];
  
  // Validate user ID (basic validation for demonstration)
  if(!empty($user_id) && is_numeric($user_id)) {
    // Prepare delete query
    $query = "DELETE FROM users WHERE id='$user_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run) {
      $_SESSION['status'] = "User deleted successfully!";
    } else {
      $_SESSION['status'] = "Failed to delete user.";
    }
  } else {
    $_SESSION['status'] = "Invalid user ID.";
  }

  // Redirect back to the dashboard
  header('Location: registered.php');
  exit();
}
?>
