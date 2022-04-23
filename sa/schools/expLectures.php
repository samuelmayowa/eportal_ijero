<?php

// Database Connection
require("../connection.php");
require("../functions.php");

// get Users
$query = "SELECT * FROM Lectures";
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
header('Content-Disposition: attachment; filename=lectures.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('ID', 'StaffCode', 'FullName', 'PhoneNumber', 'DeptCode', 'CourseCodes', 'CourseTitles', 'CourseUnits', 'AcademicSession', 'Semester', 'Level','StaffID','DateAssigned'));

if (count($students) > 0) {
    foreach ($students as $row) {
        fputcsv($output, $row);
    }
}
?>