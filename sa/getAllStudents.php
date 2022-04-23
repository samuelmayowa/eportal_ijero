<?php

// Database Connection
require("../connection.php");
require("../functions.php");

// get Users
$dpt = "";
$dpt = $_SESSION['deptN'];
$query = "SELECT * FROM students Where department ='$dpt'";
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
header('Content-Disposition: attachment; filename=Users.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('ID', 'matricNumber', 'firstName', 'middleName', 'lastName', 'yearOfEntry', 'stateOfOrigin', 'studentLevel', 'department', 'faculty', 'programme','category','passKey','studentEmail','stdPhoneNumber','Gender','ContactAddr','City','LGA','KinName','KinPhoneNumber','LastUpdated','StdPassport'));

if (count($students) > 0) {
    foreach ($students as $row) {
        fputcsv($output, $row);
    }
}
?>