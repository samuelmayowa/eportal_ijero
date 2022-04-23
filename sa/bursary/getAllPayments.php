<?php

// Database Connection
require("../../connection.php");
require("../../functions.php");

// get Users
$query = "SELECT PayID, matricID, PayType,  Amountpayable, AmountPaid, RefNumber, DatePaid, StdLevel, Status, AcademicSession FROM studentPayments";
if (!$result = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
}

$payments = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $payments[] = $row;
    }
}
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=SchoolFeesRecords.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('PayID', 'matricID', 'PayType','Amountpayable', 'AmountPaid', 'RefNumber',  'DatePaid', 'StdLevel', 'Status','AcademicSession' ));

if (count($payments) > 0) {
    foreach ($payments as $row) {
        fputcsv($output, $row);
    }
}
?>