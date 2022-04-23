<?php

// Database Connection
require("../connection.php");
require("../functions.php");
$user=$_SESSION['userID'];
//echo "<script> alert('$user'); </script>";
// get Users
$dpt = "";
$dpt = $_SESSION['deptN'];
$query = "SELECT * FROM onlineApplications Where StudentID IN (Select StudentID From Invoices Where  ServiceType='2021/2022 Compulsory Fee' AND InvoiceStatus='Successful')";
if (!$result = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
}
$students = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $students[] = $row;
    }
}
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Compulsory Fees.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('Payment ID', 'Student ID NUMBER', 'Payment Servcie Type', 'Reference Number', 'Order Number', 'Payment Status', 'Date Generated', 'Amount', 'Date Paid'));

if (count($students) > 0) {
    foreach ($students as $row) {
        fputcsv($output, $row);
    }
}
?>