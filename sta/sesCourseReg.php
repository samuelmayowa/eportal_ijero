<?php
include_once('../functions.php');
require_once('../connection.php');

$sql = "SELECT CourseCode, CourseName, CourseUnits, DateRegistered , AcademicSession
FROM studentCourseReg WHERE AcademicSession = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($cid, $cname, $cu, $dat, $sess);
$stmt->fetch();
$stmt->close();

echo "<table>";
echo "<tr>"."<th>CourseCode</th>"."<th>CourseName</th>". "<th>CourseUnits</th>". "<th>DateRegistered </th>". "<th>AcademicSession</th>";
 echo "</tr>";
 echo "<tr>"
. "<td>" . $cid . "</td>".

"<td>" . $cname . "</td>".

"<td>" . $cu . "</td>".

"<td>" . $dat . "</td>".

"<td>" . $sess . "</td>"
. "</tr>";
echo "</table>";
?>