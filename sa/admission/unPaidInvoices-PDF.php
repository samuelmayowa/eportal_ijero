<?php
// Generate pdf.php
// connect to the db
include_once('../../functions.php');
require_once('../../connection.php');

$stdID="";
$user = $_SESSION['userID'];
//echo "<script> alert('$user'); </script>";
if(empty($_SESSION['userID'])){
    header('location:dashboard.php?msg=Your Have Not Generated Payment Invoice. Contact The Bursary Department');
}else{
    $refNum ="";
        $stdCod= $_SESSION['userID'];
      // === Get All Unpaid  Invoices =====
      $query="Select * From Invoices where InvoiceStatus ='Payment Reference generated'";
          $rs=mysqli_query($con,$query);
        $inv=mysqli_fetch_assoc($rs);
        $stdID = $inv['StudentID'];
        
    // make a query to get all Applicants with Unpaid Invoice ID
$sql ="SELECT * from userAccounts WHERE ID IN (
                                            Select StudentID From Invoices 
                                            Where InvoiceStatus <> 'Successful'
                                            ) ORDER BY ID";
$records = mysqli_query($con,$sql);
//$appl=mysqli_fetch_assoc($records);
/*$sql ="SELECT * from userAccounts  WHERE ID IN (
                                            Select StudentID From Invoices 
                                            Where InvoiceStatus <> 'Successful'
                                            )";
*/

require ("library/fpdf.php");






$pdf = new FPDF('p','mm','A3');

$pdf->AddPage();

$pdf->AliasNbPages();

// Insert a logo in the top-left corner at 300 dpi
    //$imgName = getImage($con,$std);
// Insert a logo in the top-left corner at 300 dpi
$pdf->Image('passports/logo-banner.png',80,10,-200);

$pdf->Ln(30);
$pdf->SetFont('Arial','B',20);

//$pdf->SetTitle('The College Of Health Science And Tech', 'utf8(true)');
$pdf->cell(350,1,' ',1,1,"C");
    
    $pdf->Ln(10);
    
    $pdf->SetFont('Arial','B',16);

//$pdf->SetTitle('The College Of Health Science And Tech', 'utf8(true)');
    $pdf->Text(90,55,'2020/2021 APPLICATION REPORT');
    $pdf->Ln(10);
    $pdf->cell(350,1,' ',1,1,"C");
   // $pdf -> Line(80, 80, 30, 50);
    $pdf->Ln(5);
   

    $pdf->SetFont('Arial','B',22);
    
    // Get Bio Data
     $pdf->Write(26,'UNPAID APPLICATION INVOICE REPORT: ');
     //$pdf->Image($imgName,200,80,30,0,'','https://eportal.escohsti-edu.ng/');
     
     
     /* $pdf->Ln(20);
     $pdf->SetFont('Arial','B',16);
     $pdf->Write(26,'Matric Number: '.$stdCod);
     $pdf->Ln(10);
     $pdf->Write(26,'Student FullName(First Name First) : '.$_SESSION['fname'] . ' '. $_SESSION['midName']. '  ' . $_SESSION['lname']);
     $pdf->Ln(10);
    $pdf->Write(26,'Student Email: '.$std);
*/
     $pdf->Ln(20);
$pdf->SetFont('Arial','B',16);


$pdf->cell(10,10,"ID", 1, 0,'C');

$pdf->cell(85,10,"FULL NAME", 1, 0,'C');

$pdf->cell(80,10,"Email", 1, 0,'C');

$pdf->cell(50,10,"Phone Number", 1, 1,'C');


/*$pdf->cell(40,10,"AmountPaid", 1, 1,'C');*/

$pdf->SetFont('Arial','B',12);

while ($row=mysqli_fetch_array($records)){

	$pdf->cell(10,10, $row['ID'], 1,0,'C');
    $pdf->cell(85,10, $row['FirstName'].'  ' .$row['MidName'].'  '.$row['LastName'], 1,0,'C');
    $pdf->cell(80, 10, $row['Email'], 1,0, 'C');
    $pdf->cell(50,10, $row['PhoneNumber'], 1,1,'C');
   /* $pdf->cell(40,10, $row['AmountPaid'], 1,1,'C');*/
   
}

/*while($dtp = mysqli_fetch_array($rs)){
    $Dtp=$dtp['RefNum'];
}*/
// $pdf->Write(26,'Date Paid: '.$Dtp);


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
$pdf->Write(10,'Generated From The Eportal:https://eportal.escohsti-edu.ng/');
$pdf->output();


} 
?>