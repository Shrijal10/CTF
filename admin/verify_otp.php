<?php
include('config/dbcon.php');

if (isset($_POST['otp']) && isset($_POST['email'])) {
    $otp = $_POST['otp'];
    $email = $_POST['email'];

    // Prepare query to check OTP
    $verify_query = "SELECT otp FROM otp_table WHERE email = ? AND otp = ? AND expiry > NOW()";
    $stmt = $con->prepare($verify_query);
    $stmt->bind_param("si", $email, $otp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo 'OTP Verified';
    } else {
        echo 'Invalid OTP';
    }
}
?>
