<?php
session_start();
include('config/dbcon.php');

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

    // Insert into database
    $query = "INSERT INTO users (name, phone, email, password) VALUES ('$name', '$phone', '$email', '$password')";
    mysqli_query($con, $query) or die(mysqli_error($con));
  }

  // Set session message
  $_SESSION['status'] = "Users added from Excel successfully!";
  header('Location: registered.php');
  exit();
}
?>
