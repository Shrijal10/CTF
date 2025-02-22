<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpadminpanel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


include('config/dbcon.php');
include('vendor/phpmailer/phpmailer/src/Exception.php');
include('vendor/phpmailer/phpmailer/src/PHPMailer.php');
include('vendor/phpmailer/phpmailer/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if form is submitted
if(isset($_POST['uploadExcel'])) {
  $file = $_FILES['excelFile']['tmp_name'];

  // Include PhpSpreadsheet autoload file
  $autoloadPath = __DIR__ . '/vendor/autoload.php';
  if (!file_exists($autoloadPath)) {
    die('Autoload file not found. Please run `composer install`.');
  }
  require_once $autoloadPath;

  // Load Excel file
  try {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
  } catch (Exception $e) {
    die('Error loading file: ' . $e->getMessage());
  }

  // Get worksheet
  $sheet = $spreadsheet->getActiveSheet();

  // Iterate through rows
  foreach ($sheet->getRowIterator() as $row) {
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);

    // Assuming first row is header, adjust indexes accordingly
    $name = $cellIterator->current()->getValue();
    $cellIterator->next();
    $phone = $cellIterator->current()->getValue();
    $cellIterator->next();
    $email = $cellIterator->current()->getValue();
    $cellIterator->next();
    $password = $cellIterator->current()->getValue();
    $cellIterator->next();
    $email_sent = $cellIterator->current()->getValue();

    // Insert into database
    $query = "INSERT INTO users (name, phone, email, password, email_sent) VALUES ('$name', '$phone', '$email', '$password', '$email_sent')";
    $result = mysqli_query($conn, $query);

    // Check if email was sent successfully
    if (!$result) {
      die('Error inserting data: ' . mysqli_error($conn));
    }
    // Send email if email_sent is 0
    if ($email_sent == 0) {

      $mail = new PHPMailer(true);
      try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bhaveshchoudhari1211@gmail.com';
        $mail->Password = 'ijndwshekarhdirq';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('bhaveshchoudhari1211@gmail.com', 'Your Name');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Invitation to Attend the Capture The Flag (CTF) Event from Talakunchi on August 24th';
            $mail->Body = '
            <html>
            <head>
                <meta charset="utf-8">
                <title>Invitation Attend the Capture The Flag (CTF) Event from Talakunchi on August 24th</title>
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
                    <h1>Invitation to Attend the Capture The Flag (CTF) Event from Talakunchi on August 24th</h1>
                    <p>Dear ' . htmlspecialchars($name) . ',</p>
                    <p>Thank you for registering with us.</p>
                    <p>We are excited to invite you to our upcoming Capture The Flag (CTF) event, which will be held on August 24th in Talakunchi.</p>
                    <p>This event promises to be an engaging and challenging experience for all participants.</p>
                    <ul>
                        <li><strong>Event:</strong> Capture The Flag (CTF)</li>
                        <li><strong>Date:</strong> August 24, 2024</li>
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
                            <td>August 24, 2024</td>
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

We are excited to invite you to our upcoming Capture The Flag (CTF) event, which will be held on August 24th in Talakunchi. This event promises to be an engaging and challenging experience for all participants.';

        $mail->send();

        // Update email_sent to 1 in the database
        $updateQuery = "UPDATE users SET email_sent = 1 WHERE email = '$email'";
        mysqli_query($con, $updateQuery) or die(mysqli_error($con));
      } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: ', $mail->ErrorInfo;
      }
    }
  }

  // Set session message
  $_SESSION['status'] = "Users added from Excel successfully!";
  header('Location: registered.php');
  exit();
}
?>

