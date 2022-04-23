<?php
   require ('../../functions.php');
//  require ('../connection.php');
 $amtDue =$_SESSION['totalDue'];
 $amtDue = $_SESSION['amtD'];
 $lev =$_SESSION['stdLevel'];
 $citizen = $_SESSION['citizen'];
if(isset($_POST['PayType'])){
$payID = $_POST['PayType'];

	$query =mysqli_query($con, "Select * from paymentCategories WHERE  Level LIKE '$lev%' AND Citizenship ='$citizen' AND payCategories ='$payID'");
	while($row=mysqli_fetch_array($query)){
	$payID = $row['PayID'];
	$amt =$row['Amount'];
	echo "<option value='". $amtDue. "'> $amtDue </option>";
	/*if($amtDue==0){
	    $amt=0;
	} else{
	$amt=abs($amt-$amtDue);
	echo "<option value='". $amt. "'> $amt </option>";
	}*/

		}


	}
	
	
	
?>