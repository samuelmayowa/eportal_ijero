<?php
// Generate pdf.php
// connect to the db

require('../connection.php');
require_once('../functions.php');
confirmLogin();
if(isset($_GET['std'])){
    $std = base64_decode($_GET['std']);
   $stdCod= $_SESSION['userID'];
   if(empty($stdCod)){
       $stdCod =$_SESSION['MatricNo'];
       
   }
   // Get All Student DEtails
   
    $query = mysqli_query($con, "Select * From students Where matricNumber ='$stdCod'");
      $result = mysqli_fetch_assoc($query);
             $st = $result['stateOfOrigin'];
             $citizen = $result['Citizenship'];
             $stdLevel = $result ['studentLevel'];
             $mastric = $result ['matricNumber'];
             $dptid= $result ['department_id'];
             $fname=$resultl['firstName'];
             $midName= $result['middleName'];
             $lname = $result ['lastName'];
             $dept = $result ['department'];
             $sess = $result ['AcademicSession'];
             $email= $result['studentEmail'];
             $phn= $result['stdPhoneNumber'];
//echo "<script>alert('$stdCod')</script>";
// make a query
$sql ="SELECT  CourseCode,CourseName,Department,RegisteredAs,CourseUnits, AcademicSession from studentCourseReg  WHERE studentEmail='$std'";
$records = mysqli_query($con,$sql);
$query="Select Sum(CourseUnits) AS TotalUnits From studentCourseReg where studentEmail ='$std'";
$rs=mysqli_query($con,$query);

//echo getCourses($ccon, $std);


require ("library/fpdf.php");


class PDF extends FPDF
{
// Page header
function Header()
{
 $this->Image('passports/logo-banner.png',0,0);
  
}
// Page footer
function Footer()
{
 $this->SetY(-20);
 $this->Image('imageslogo-banner.png');
}

}







$pdf = new FPDF('p','mm','A3');

$pdf->AddPage();

$pdf->AliasNbPages();

$imgName = getImage($con,$std);
// Insert a logo in the top-left corner at 300 dpi
$pdf->Image('passports/logo-banner.png',80,10,-200);

$pdf->Ln(30);
$pdf->SetFont('Arial','B',20);

//$pdf->SetTitle('The College Of Health Science And Tech', 'utf8(true)');
$pdf->cell(400,1,' ',1,1,"C");
    
    $pdf->Ln(10);
    
    $pdf->SetFont('Arial','B',16);

//$pdf->SetTitle('The College Of Health Science And Tech', 'utf8(true)');
    $pdf->Text(90,55,'2020/2021 Student Course Form');
    $pdf->Ln(10);
    $pdf->cell(400,1,' ',1,1,"C");
   // $pdf -> Line(80, 80, 30, 50);
    $pdf->Ln(15);
   // start water mark
   
$pdf->SetFont('Arial','',12);
/*$txt="FPDF is a PHP class which allows to generate PDF files with pure PHP, that is to say ".
    "without using the PDFlib library. F from FPDF stands for Free: you may use it for any ".
    "kind of usage and modify it to suit your needs.\n\n";
for($i=0;$i<25;$i++) 
    $pdf->MultiCell(0,5,$txt,0,'J');*/
    
    
    // end water mark
    
    $pdf->SetFont('Arial','B',22);
    
    // Get Bio Data
     $pdf->Write(26,'Student Bio Data: ');
     $pdf->Image($imgName,200,80,30,0,'','https://eportal.escohsti-edu.ng/');
     $pdf->Ln(10);
     $pdf->SetFont('Arial','B',16);
     $pdf->Write(26,'Matric Number: '.$stdCod);
     $pdf->Ln(10);
     $pdf->Write(26,'Department: '.$dept);
     $pdf->Ln(10);
     $pdf->Write(26,'Student Level: '.$stdLevel); 
     $pdf->Ln(10);
    $pdf->Write(26,'Student Phone Number: '.$phn);  
    $pdf->Ln(10);
      $pdf->Write(26,'Full Name: '.$fname. ' '.$midName. '  '. $lname);
      $pdf->Ln(10);
   /*$pdf->cell(50, 10, "FullName: ", 1,0, "C");
    $pdf->cell(60, 10, $_SESSION['fname'], 1,0, "C");
     $pdf->cell(60, 10, $_SESSION['midName'], 1,0, "C");
     $pdf->cell(60, 10, $_SESSION['lname'], 1,1, "C");*/

$pdf->Write(26,'Student Email: '.$std);

 $pdf->Ln(20);
$pdf->SetFont('Arial','B',14);


$pdf->cell(50,10,"AcademicSession", 1, 0,'C');

$pdf->cell(40,10,"CourseCodes", 1, 0,'C');

$pdf->cell(120,10,"CourseTitles", 1, 0,'C');

$pdf->cell(30,10,"CoursUnits", 1, 0,'C');

//$pdf->cell(40,10,"Department", 1, 0,'C');

$pdf->cell(40,10,"RegisteredAs", 1, 1,'C');

//$pdf->cell(40,10,"Semester", 1, 1,'C');

$pdf->SetFont('Arial','B',12);

//$pdf->table(100, 100, getCourses($ccon, $std), 1,1,C);
while ($row=mysqli_fetch_array($records)){
    $pdf->cell(50,10, $row['AcademicSession'], 1,0,'C');
	$pdf->cell(40,10, $row['CourseCode'], 1,0,'C');
    $pdf->cell(120,10, $row['CourseName'], 1,0,'C');
    $pdf->cell(30,10, $row['CourseUnits'], 1,0,'C');
    //$pdf->cell(40,10, $row['Department'], 1,0,'C');
  $pdf->cell(40,10, $row['RegisteredAs'], 1,1,'C'); 
}
        $pdf->Ln(10);
    $totUnits = mysqli_fetch_array($rs);
    $totUnits =$totUnits['TotalUnits'];
    $pdf->Write(26,'Total Units Offered for This Semester : '.$totUnits);
    $pdf->Ln(5);
    $pdf->SetFont('Arial','B',12);

   /*//$pdf->Text(30,0,"HOD's Sign:");
    //$pdf->SetLeftMargin(45);
    $pdf->Write(50,'HODs Sign', 1);
     //$pdf->SetLeftMargin(45);
    $pdf->cell(80,1,' ',1,0,"C"); $pdf->SetLeftMargin(20); $pdf->cell(80,1,' ',1,1,"C");
    $pdf->Ln(30);
    // $pdf->SetLeftMargin(45);
    $pdf->Write(20,'Student Sign',0);*/
    $pdf->Text(30,330,"HOD's Sign:");
    /*$pdf->cell(100,1,' ',1,1,"C");*/
    $pdf->Ln(5);
    $pdf->Text(30,317,"Student's Sign:");
    /*$pdf->cell(100,1,' ',1,1,"C");*/

/*$pdf->Text(30,300,"HOD's Sign:");
    $pdf->cell(100,1,' ',1,1,"C");
    $pdf->Ln(30);
    $pdf->Text(30,250,"Student's Sign:");
    $pdf->cell(100,1,' ',1,1,"C");
*/
$pdf->Ln(30);
    //$pdf->cell(350,1,' ',1,1,"C");
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
$pdf->Write(12,'Copyright © 2021 | Powered by Ekiti State College of Health Sciences and Technology | ICT Unit ');

$pdf->Ln(10);
$pdf->Write(10,'Generated From The Eportal:https://eportal.escohsti-edu.ng/ ');
$pdf->output();


} 
?>