<?php
require 'vendor/autoload.php'; // Make sure to include the autoload file for PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment as AlignmentStyle;

include('config/dbcon.php'); // Include your database connection

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set the title
$sheet->setTitle('Registered Users');

// Set header row
$sheet->setCellValue('A1', 'Id');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Phone Number');
$sheet->setCellValue('D1', 'Email');

// Fetch data from database
$query = "SELECT * FROM users";
$query_run = mysqli_query($con, $query);

if(mysqli_num_rows($query_run) > 0) {
    $rowIndex = 2; // Start from row 2
    while($row = mysqli_fetch_assoc($query_run)) {
        $sheet->setCellValue('A' . $rowIndex, $row['id']);
        $sheet->setCellValue('B' . $rowIndex, $row['name']);
        $sheet->setCellValue('C' . $rowIndex, $row['phone']);
        $sheet->setCellValue('D' . $rowIndex, $row['email']);
        $rowIndex++;
    }
}

// Apply styling (optional)
$headerStyle = [
    'font' => ['bold' => true],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'color' => ['rgb' => 'FFFF00']
    ],
    'alignment' => [
        'horizontal' => AlignmentStyle::HORIZONTAL_CENTER
    ]
];

$sheet->getStyle('A1:D1')->applyFromArray($headerStyle);
$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);

// Write the file
$writer = new Xlsx($spreadsheet);

// Set headers and output file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="registered_users.xlsx"');
header('Cache-Control: max-age=0');

// Save and output the file
$writer->save('php://output');
exit;
?>
