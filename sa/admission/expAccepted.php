<?php

// Database Connection
require("../../connection.php");
require("../../functions.php");

// get Users
$dpt = "";
$regnum ="";
$query=mysqli_query($con,"Select RegNumber From applicationResults");
if(!$query){
    $err=mysqli_error($con);
    echo "<script> alert('Error in Transactions: $err');</script>";
} else{
    while($rs=mysqli_fetch_array($query)){
        $regnum=$rs['StudentID'];
    }

$query = "SELECT RegNumber, FirstName, MiddleName, Surname, PhoneNO, Email, Schools, Departments, AmountPaid, RefNum,StOrigin,LGA, Address,Gender,Username FROM onlineApplications Where Acceptance=1";
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
header('Content-Disposition: attachment; filename=AcceptedAdm.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('RegNumber', 'FirstName', 'MiddleName', 'Surname', 'PhoneNO', 'Email', 'Schools', 'Departments', 'AmountPaid', 'RefNum','StOrigin','LGA',' Address','Gender','Username'));

if (count($students) > 0) {
    foreach ($students as $row) {
        fputcsv($output, $row);
    }
}
}

?>