<?php

// Database Connection
require("../connection.php");
require("../functions.php");
$dpt="";
$dptN ="";
 //$dpt=$_GET['dpt'];
 $r ="";
// get Courses
if(isset($_SESSION['dpt']) || isset($_SESSION['msg'])){
    $dpt=$_SESSION['dpt'];
    $r = $_SESSION['msg'];
    $dptN = $_SESSION['deptN'];
    $facs = $_SESSION['facs'];
    if($r == 'HOD' || $r == 'LECTURER' || $r == 'DEAN'){
        $query = "SELECT matricNumber, CONCAT(firstName , ',  ' , middleName, ',  ', lastName) AS FULLNAME, studentLevel, stdPhoneNumber,Gender  FROM students WHERE Department = '$dptN' OR faculty LIKE '$facs%'";
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
header('Content-Disposition: attachment; filename=MyStudents.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('matricNumber', 'FULLNAME', 'studentLevel', 'stdPhoneNumber','Gender'));

if (count($payments) > 0) {
    foreach ($payments as $row) {
        fputcsv($output, $row);
    }
}

    } 
    
}


if(empty($_SESSION['dpt']) && empty($_SESSION['msg'])){
        $query = "SELECT matricNumber, CONCAT(firstName, ',  ', middleName,',  ',lastName) AS FULLNAME, studentLevel, stdPhoneNumber,Gender  FROM students";
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
header('Content-Disposition: attachment; filename=MyStudents.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('matricNumber', 'FULLNAME', 'studentLevel', 'stdPhoneNumber','Gender'));

if (count($payments) > 0) {
    foreach ($payments as $row) {
        fputcsv($output, $row);
    }
}

}
?>