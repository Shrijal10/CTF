<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

session_start();
include('config/dbcon.php');

if (isset($_POST['addUser'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Insert user into the database
    $user_query = "INSERT INTO `users`(`name`, `phone`, `email`) VALUES (?, ?, ?)";
    $stmt = $con->prepare($user_query);
    $stmt->bind_param("sss", $name, $phone, $email);

    if ($stmt->execute()) {
        $_SESSION['status'] = "User Added Successfully";

        // Send email to the newly added user
        try {
            $mail = new PHPMailer(true);

            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'bhaveshchoudhari1211@gmail.com';                     //SMTP username
            $mail->Password   = 'ijndwshekarhdirq';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to

            //Recipients
            $mail->setFrom('bhaveshchoudhari1211@gmail.com', 'Your Name');
            $mail->addAddress($email, $name);     // Add the newly registered user

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Invitation to Attend the Capture The Flag (CTF) Event from Talakunchi on November 24th';
            $mail->Body = '
            <html>
            <head>
                <meta charset="utf-8">
                <title>Invitation Attend the Capture The Flag (CTF) Event from Talakunchi on November 24th</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f5f5f5;
                        color: #333;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                        background-color: #fff;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                    }
                    h1 {
                        color: #333;
                    }
                    p {
                        line-height: 1.5;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h1>Invitation to Attend the Capture The Flag (CTF) Event from Talakunchi on November 24th</h1>
                    <p>Dear ' . htmlspecialchars($name) . ',</p>
                    <p>Thank you for registering with us.</p>
                    <p>We are excited to invite you to our upcoming Capture The Flag (CTF) event, which will be held on November 24th in Talakunchi.</p>
                    <p>This event promises to be an engaging and challenging experience for all participants.</p>
                    <ul>
                        <li><strong>Event:</strong> Capture The Flag (CTF)</li>
                        <li><strong>Date:</strong> November 24, 2024</li>
                        <li><strong>Location:</strong> Talakunchi</li>
                        <li><strong>Time:</strong> 9:00 AM to 5:00 PM</li>
                    </ul>
                    <ul>
                        <li><strong>What to Expect:</strong>
                            <ul>
                                <li>A series of security challenges and puzzles</li>
                                <li>Networking opportunities with fellow enthusiasts and professionals</li>
                                <li>Prizes for top performers</li>
                            </ul>
                        </li>
                        <li><strong>RSVP:</strong> Please confirm your attendance by [RSVP Deadline] so we can make the necessary arrangements.</li>
                    </ul>
                    <table>
                        <tr>
                            <td><strong>Event:</strong></td>
                            <td>Capture The Flag (CTF)</td>
                        </tr>
                        <tr>
                            <td><strong>Date:</strong></td>
                            <td>November 24, 2024</td>
                        </tr>
                        <tr>
                            <td><strong>Location:</strong></td>
                            <td>Talakunchi</td>
                        </tr>
                        <tr>
                            <td><strong>Time:</strong></td>
                            <td>9:00 AM to 5:00 PM</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td><strong>What to Expect:</strong></td>
                            <td>A series of security challenges and puzzles<br>Networking opportunities with fellow enthusiasts and professionals<br>Prizes for top performers</td>
                        </tr>
                        <tr>
                            <td><strong>RSVP:</strong></td>
                            <td>Please confirm your attendance by [RSVP Deadline] so we can make the necessary arrangements.</td>
                        </tr>
                    </table>
                    <p>We look forward to your participation and hope you will enjoy the challenges and opportunities this event offers.</p>
                    <p>If you have any questions or need further information, feel free to reach out to us at [Your Contact Information].</p>
                    <p>Best regards,</p>
                </div>
            </body>
            </html>';
            $mail->AltBody = 'I hope this message finds you well.

We are excited to invite you to our upcoming Capture The Flag (CTF) event, which will be held on November 24th in Talakunchi. This event promises to be an engaging and challenging experience for all participants.';

            $mail->send();

            // Update email_sent status in the database
            $update_query = "UPDATE users SET email_sent = 1 WHERE email = ?";
            $stmt = $con->prepare($update_query);
            $stmt->bind_param("s", $email);
            $stmt->execute();

        } catch (Exception $e) {
            $_SESSION['status'] = "User Added, but Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        header('Location: registered.php');
        exit();
    } else {
        $_SESSION['status'] = "User Not Added: " . $stmt->error;
        header('Location: registered.php');
        exit();
    }
}

if (isset($_POST['updateUser'])) {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "UPDATE `users` SET `name` = ?, `phone` = ?, `email` = ?, `password` = ? WHERE `users`.`id` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssssi", $name, $phone, $email, $password, $user_id);

    if ($stmt->execute()) {
        $_SESSION['status'] = "User Updated Successfully";
        header('Location: registered.php');
    } else {
        $_SESSION['status'] = "User Updating Failed: " . $stmt->error;
        header('Location: registered.php');
    }
}

if (isset($_POST['DeleteUserbtn'])) {
    $user_id = $_POST['delete_id'];

    $query = "DELETE FROM users WHERE `users`.`id` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $_SESSION['status'] = "User Deleted Successfully";
        header('Location: registered.php');
    } else {
        $_SESSION['status'] = "User Deleting Failed: " . $stmt->error;
        header('Location: registered.php');
    }
}

// Send email to all users
if (isset($_POST['sendToAllUsers'])) {
    try {
        $mail = new PHPMailer(true);

        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'bhaveshchoudhari1211@gmail.com';                     //SMTP username
        $mail->Password   = 'ijndwshekarhdirq';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to

        //Recipients
        $mail->setFrom('bhaveshchoudhari1211@gmail.com', 'Your Name');

        // Fetch all user emails
        $result = $con->query("SELECT email, name FROM users WHERE email_sent = 0");

        while ($row = $result->fetch_assoc()) {
            $mail->addAddress($row['email'], $row['name']);     // Add each user

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Welcome to CTF!';
            $mail->Body    = 'Dear ' . htmlspecialchars($row['name']) . ',<br><br>Thank you for being a part of our community.<br><br>Best regards,<br>Your Team';
            $mail->AltBody = 'Dear ' . htmlspecialchars($row['name']) . ', Thank you for being a part of our community. Best regards, Your Team';

            // Send email
            $mail->send();

            // Update email_sent status in the database
            $update_query = "UPDATE users SET email_sent = 1 WHERE email = ?";
            $stmt = $con->prepare($update_query);
            $stmt->bind_param("s", $row['email']);
            $stmt->execute();

            // Clear recipient for next loop iteration
            $mail->clearAddresses();
        }

        $_SESSION['status'] = "Emails sent to all users successfully";
    } catch (Exception $e) {
        $_SESSION['status'] = "Emails could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    header('Location: registered.php');
    exit();
}

session_start();
include('config/dbcon.php');

if(isset($_POST['addUser']))
{   
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user_query = "INSERT INTO `users`(`name`, `phone`, `email`, `password`) VALUES ('$name', '$phone', '$email', '$password')";
    $user_query_run = mysqli_query($con, $user_query);

    if($user_query_run)
    {
        $_SESSION['status'] = "User Added Successfully";
        header('Location: registered.php');
    }
    else
    {
        $_SESSION['status'] = "User Not Added";
        header('Location: registered.php');
    }
}

if(isset($_POST['updateUser']))
{   
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "UPDATE `users` SET `name` = '$name', `phone` = '$phone', `email` = '$email', `password` = '$password' WHERE `users`.`id` = $user_id";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "User Updated Successfully";
        header('Location: registered.php');
    }
    else
    {
        $_SESSION['status'] = "User Updating Failed";
        header('Location: registered.php');
    }
}

if(isset($_POST['DeleteUserbtn']))
{
    $user_id = $_POST['delete_id'];

    $query = "DELETE FROM users WHERE `users`.`id` = $user_id ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "User Deleted Successfully";
        header('Location: registered.php');
    }
    else
    {
        $_SESSION['status'] = "User Deleting Failed";
        header('Location: registered.php');
    }
}

else
{
    header('Location: registered.php');
    exit();
}
?>
