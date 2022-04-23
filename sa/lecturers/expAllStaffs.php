<?php

// Database Connection
require("../../connection.php");
require("../../functions.php");

// get Users
$query = "SELECT StaffCode,Title,FirstName, Surname,DeptID,PhoneNumber,Designation,Job_Role,DateReg  FROM Staffs";
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
header('Content-Disposition: attachment; filename=AllStaffs.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('StaffCode','Title','FirstName', 'Surname', 'DeptID', 'PhoneNumber', 'Designation', 'Job_Role', 'DateReg'));

if (count($payments) > 0) {
    foreach ($payments as $row) {
        fputcsv($output, $row);
    }
}
?>