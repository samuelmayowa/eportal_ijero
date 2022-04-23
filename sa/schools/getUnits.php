<?php

 require ('../connection.php');
if(isset($_POST['CourseID'])){
$CourseID = $_POST['CourseID'];

	$query =mysqli_query($con, "Select * from CourseTitles WHERE CourseID =".$CourseID);
	while($row=mysqli_fetch_array($query)){
	$CourseID = $row['CourseID'];
	$CourseName =$row['CourseTitles'];
	echo "<option value='". $CourseName. "'> $CourseName </option>";

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