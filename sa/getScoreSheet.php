<?php

// Database Connection
require("../connection.php");
require("../functions.php");

// get Users
$query = "SELECT * FROM ScoresSheetTemp";
if (!$result = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
}

$ScoreSheet = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ScoreSheet[] = $row;
    }
}
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=ScoreSheet.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('ID', 'MatricNO', 'FullName','DeptCode','CourseCode','CourseUnits', 'CA1', 'CA2', 'CA3', 'ExamScore', 'CumTotalScore','Grade','Remark','Level','Semester','AcademicSession','SubmittedBy','DateSubmitted', 'Status','Visibility'));

if (count($ScoreSheet) > 0) {
    foreach ($ScoreSheet as $row) {
        fputcsv($output, $row);
    }
}
?>