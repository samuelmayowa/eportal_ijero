<?php

 require ('../../connection.php');
if(isset($_POST['ID'])){
$CourseID = $_POST['ID'];

	$query =mysqli_query($con, "Select StaffCode from Staffs WHERE ID =".$CourseID);
	while($row=mysqli_fetch_array($query)){
	$CourseID = $row['StaffCode'];
	//$CourseName =$row['CourseTitles'];
	echo "<option value='". $CourseID. "'> $CourseID </option>";

		}
	}
	
		
	if(isset($_POST['CourseTitleID'])){
$TitleID = $_POST['CourseTitleID'];

	$query =mysqli_query($con, "Select * from CourseUnits WHERE CourseTitleID =".$TitleID);
	while($row=mysqli_fetch_array($query)){
	$CourseTitleID = $row['CourseTitleID'];
	$CourseUnits =$row['CourseUnits'];
	echo "<option value='". $CourseUnits. "'> $CourseUnits </option>";

		}


	}
?>