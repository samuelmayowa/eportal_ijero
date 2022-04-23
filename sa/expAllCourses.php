<?php

// Database Connection
require("../connection.php");
require("../functions.php");
$dpt="";
 //$dpt=$_GET['dpt'];
 $r ="";
// get Courses
if(isset($_SESSION['dpt']) || isset($_SESSION['msg'])){
    $dpt=$_SESSION['dpt'];
    $r = $_SESSION['msg'];
    if($r == 'HOD' || $r == 'LECTURER' || $r == 'DEAN'){
        $query = "SELECT CourseID, CourseCode, CourseTitle, Department, CourseUnits, Category, studentLevel, Faculty FROM Courses WHERE Department ='$dpt'";
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
header('Content-Disposition: attachment; filename=AllCourses.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('CourseID', 'CourseCode', 'CourseTitle', 'Department', 'CourseUnits', 'Category', 'studentLevel', 'Faculty'));

if (count($payments) > 0) {
    foreach ($payments as $row) {
        fputcsv($output, $row);
    }
}

    } 
    
}


if(empty($_SESSION['dpt']) && empty($_SESSION['msg'])){
        $query = "SELECT CourseID, CourseCode, CourseTitle, Department, CourseUnits, Category, studentLevel, Faculty FROM Courses";
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
header('Content-Disposition: attachment; filename=AllCourses.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('CourseID', 'CourseCode', 'CourseTitle', 'Department', 'CourseUnits', 'Category', 'studentLevel', 'Faculty'));

if (count($payments) > 0) {
    foreach ($payments as $row) {
        fputcsv($output, $row);
    }
}

}
?>