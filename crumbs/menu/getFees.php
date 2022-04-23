<?php

 require ('../connection.php');
if(isset($_POST['PayType'])){
$payID = $_POST['PayType'];

	$query =mysqli_query($con, "Select * from paymentCategories WHERE payCategories ='$payID'");
	while($row=mysqli_fetch_array($query)){
	$payID = $row['PayID'];
	$amt =$row['Amount'];
	echo "<option value='". $amt. "'> $amt </option>";

		}


	}
	
	
	
?>