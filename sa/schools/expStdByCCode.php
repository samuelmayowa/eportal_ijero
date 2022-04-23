<?php

// Database Connection
require("../connection.php");
require("../functions.php");

// get Users
$dpt = "";
$dpt = $_SESSION['deptN'];
$query = "SELECT matricNumber, firstName, middleName, lastName, yearOfEntry, stateOfOrigin, studentLevel, department, faculty, programme,category,studentEmail,stdPhoneNumber,Gender,ContactAddr,City,LGA FROM students Where department ='$dpt'";
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
header('Content-Disposition: attachment; filename=MyStdByDpt.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('matricNumber', 'firstName', 'middleName', 'lastName', 'yearOfEntry', 'stateOfOrigin', 'studentLevel', 'department', 'faculty', 'programme','category','studentEmail','stdPhoneNumber','Gender','ContactAddr','City','LGA'));

if (count($students) > 0) {
    foreach ($students as $row) {
        fputcsv($output, $row);
    }
}
?>