<?php
   require ('../functions.php');
 require ('../connection.php');
 $amtDue = $_SESSION['totalDue'];
 $amtDue = $_SESSION['amtD'];
 $lev =$_SESSION['stdLevel'];
 $citizen = $_SESSION['citizen'];
if(isset($_POST['payID'])){
    $pay_type = $_POST['PayType'];
    $matric_no = $_POST['MatricNumber'];
    $payID = $_POST['payID'];
    
    //get students data 
    $student_data =mysqli_query($con, "Select * from students WHERE  matricNumber ='$matric_no'");
	while($rows = mysqli_fetch_array($student_data)){
	    $citizen = $rows['Citizenship'];
	    $level = $rows['studentLevel'];
	    $department_id = $rows['department_id'];
	}
	if($level == 'Prospective'){
        $level = 100;
    }else{
        $level = $level;
    }
	//get previous paid amounts
	$seletFromID = 2;
	$amount = 0;
	$academic_session = apiCredential($seletFromID, 'session_value');
	$amount_paid_so_far =mysqli_query($con, "Select * from studentPayments WHERE  StdLevel ='$level' AND Status = 'Successful' AND AcademicSession = '$academic_session' AND matricID ='$matric_no'");
	while($row_amount=mysqli_fetch_array($amount_paid_so_far)){
	    $amount = $row_amount['AmountPaid'] + $amount;
	}
    //get amount to be paid
	$query =mysqli_query($con, "Select * from paymentCategories WHERE  AcademicSession = '$academic_session' AND Citizenship ='$citizen' AND payCategories ='$payID' AND department_id = '$department_id'");
	while($row=mysqli_fetch_array($query)){
    	$payID = $row['PayID'];
    	$amt =$row['Amount'];
    	$percent = $row['PayPercentages'];
	}
	if($amount > 0){
	    $final_full_amt = $amt - $amount;
    	//$first_installment = $percent *  $final_full_amt;
    	//$second_installment = $final_full_amt - $first_installment;
    	
    	if($pay_type == 'Fully Paid'){
	        echo $final_full_amt;
    	}elseif($pay_type == 'First Installment'){
    	    echo $final_full_amt;
    	}elseif($pay_type == 'Second Installment'){
    	    echo $final_full_amt;
    	}elseif($pay_type == 'select Pay Mode'){
    	    echo 'Select Payment Mode';
    	}
	}else{
	    $final_full_amt = $amt;
    	$first_installment = $percent *  $final_full_amt;
    	$second_installment = $final_full_amt - $first_installment;
    	
    	if($pay_type == 'Fully Paid'){
	        echo $final_full_amt;
    	}elseif($pay_type == 'First Installment'){
    	    echo $first_installment;
    	}elseif($pay_type == 'Second Installment'){
    	    echo $second_installment;
    	}elseif($pay_type == 'select Pay Mode'){
    	    echo 'Select Payment Mode';
    	}
	}
	
	
	
	
	

	
	


	}
	
?>