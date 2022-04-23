<?php
// Generate pdf.php
// connect to the db
require('../connection.php');
require_once('../functions.php');

if(empty($_GET['payID'])){
    header('location:dashboard.php?msg=Your Have Not Generated Payment Invoice. Contact The Bursary Department');
}else{
        $refNum ="";
        $stdCod= $_SESSION['userID'];
         $std=$_SESSION['matric_no'];
         $refNum =$_GET['payID'];
  
    // make a query
$sql ="SELECT RefNumber, matricID, AmountPaid, PayType from studentPayments  WHERE RefNumber  ='$refNum'";
$records = mysqli_query($con,$sql);
while ($row=mysqli_fetch_array($records)){
$ref_Num = $row['RefNumber'];
$matric_no = $row['matricID'];
$paying_for = $row['PayType'];
$amountpaid = $row['AmountPaid'];
}

$query="Select DatePaid From studentPayments WHERE RefNumber  ='$refNum'";
$rs=mysqli_query($con,$query);
$query1="SELECT firstName, middleName, lastName, stateOfOrigin, department, Citizenship FROM students WHERE matricNumber='$matric_no'";
$query1 = mysqli_query($con, $query1);
while ($schl = mysqli_fetch_array($query1)){
    $department = $schl['department'];
    $email = $schl['studentEmail'];
}

require ("library/fpdf.php");






    $pdf = new FPDF('p','mm','A3');
    
    $pdf->AddPage();
    
    $pdf->AliasNbPages();
    
    // Insert a logo in the top-left corner at 300 dpi
     $imgName = getpassport($con,$matric_no);
    // Insert a logo in the top-left corner at 300 dpi
    $pdf->Image('passports/logo-banner.png',80,10,-200);
    
    $pdf->Ln(30);
    $pdf->SetFont('Arial','B',20);
    
    //$pdf->SetTitle('The College Of Health Science And Tech', 'utf8(true)');
    $pdf->cell(400,1,' ',1,1,"C");
        
        $pdf->Ln(10);
        
        $pdf->SetFont('Arial','B',16);
    
    //$pdf->SetTitle('The College Of Health Science And Tech', 'utf8(true)');
        $pdf->Text(90,55,'2020/2021 Student Payment Receipt');
        $pdf->Ln(10);
        $pdf->cell(400,1,' ',1,1,"C");
       // $pdf -> Line(80, 80, 30, 50);
        $pdf->Ln(15);
       
    
        $pdf->SetFont('Arial','B',22);
    
    // Get Bio Data
     $pdf->Write(26,'Student Payment Details: ');
     $pdf->Image($imgName,200,80,30,0,'','https://eportal.escohsti-edu.ng/');
     
     
      $pdf->Ln(20);
     $pdf->SetFont('Arial','B',16);
     $pdf->Write(26,'Matric Number: '.$stdCod);
     $pdf->Ln(10);
     $pdf->Write(26,'Student FullName(First Name First) : '.$_SESSION['fname'] . ' '. $_SESSION['midName']. '  ' . $_SESSION['lname']);
     $pdf->Ln(10);
    if(!empty($email)){
         $pdf->Write(26,'Student Email: '. $email);
     }else{
         $pdf->Write(26,'Student Email: Email not updated yet, please update your profile');
     }

     $pdf->Ln(20);
    $pdf->SetFont('Arial','B',16);
    
    
    $pdf->cell(40,10,"ReceiptNumber", 1, 0,'C');
    
    $pdf->cell(40,10,"MatricNumber", 1, 0,'C');
    
    $pdf->cell(50,10,"Paid For", 1, 0,'C');
    
    $pdf->cell(80,10,"CourseName", 1, 0,'C');
    
    
    $pdf->cell(40,10,"AmountPaid", 1, 1,'C');
    
    $pdf->SetFont('Arial','B',12);

    $pdf->cell(40,10, $ref_Num, 1,0,'C');
    $pdf->cell(40,10, $matric_no, 1,0,'C');
    $pdf->cell(50, 10, $paying_for, 1,0, 'C');
    $pdf->cell(80,10, $department, 1,0,'C');
    $pdf->cell(40,10, $amountpaid, 1,1,'C');

    while($dtp = mysqli_fetch_array($rs)){
        $Dtp=$dtp['DatePaid'];
    }
    $pdf->Write(26,'Date Paid: '.$Dtp);
    
    $pdf->Ln(30);
    $pdf->SetFont('Arial','B',12);
    
    $pdf->Text(30,200,"HOD's Sign:");
    $pdf->cell(100,1,' ',1,1,"C");
    $pdf->Ln(30);
    $pdf->Text(30,230,"Student's Sign:");
    $pdf->cell(100,1,' ',1,1,"C");



    $pdf->Ln(80);
        $pdf->cell(350,1,' ',1,1,"C");
    $pdf->Ln(10);
    $pdf->SetFont('Arial','',10);
    $pdf->Write(16,'Contact Us Mail Admin Tech Support: admin@escohsti-edu.ng');
    $pdf->Ln(10);
    $pdf->Write(16,'For Tech Support Contact Us: +(234) 08068430751');
    $pdf->Ln(10);
    //$pdf->SetTitle('The College Of Health Science And Tech', 'utf8(tru)');
    $pdf->Write(12, "Date Printed ". date('y-m-d'));
    $pdf->Ln(10);
    $pdf->SetFont('Arial','',8);
    $pdf->Write(12,'Copyright © 2021 | Powered by Ekiti State College of Health Sciences and Technology | ICT Unit');
    
    $pdf->Ln(10);
    $pdf->Write(10,'Generated From The Eportal:https://eportal.escohsti-edu.ng/ ');
    $pdf->output();
    
    
    } 
?>