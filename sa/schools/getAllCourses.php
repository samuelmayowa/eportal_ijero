<?php

// Database Connection
require("../connection.php");
require("../functions.php");
$dpt="";

 $dpt=$_GET['dpt'];
// get Courses
if(isset($_GET['dpt']) && isset($_GET['msg'])){
    $dpt=$_GET['dpt'];
    $r = $_GET['msg'];
    if($r == 'IT_SUPPORT'){
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

    } else{
        
        $query = "SELECT CourseID, CourseCode, CourseTitle, Department, CourseUnits, Category, studentLevel, Faculty count(CourseCode) Total_Courses FROM Courses WHERE Department ='HIM'";
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
fputcsv($output, array('CourseID', 'CourseCode', 'CourseTitle', 'Department', 'CourseUnits', 'Category', 'studentLevel', 'Faculty', 'TotalCourses'));

if (count($payments) > 0) {
    foreach ($payments as $row) {
        fputcsv($output, $row);
    }
}
    }
    
}

?>