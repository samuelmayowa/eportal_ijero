<?php
require('connection.php');
session_start();
$resp="";
$courseCode="";
$totalRev ="";
$admin='Admin@ijero2021';
$admin=base64_encode($admin);
$matric ="";
 $scores="";
 $total="";
 $id="";
 $std="";
 $scpin="";
 $nw="";
 $tot=$toti=$tots=$tacpt='';
 

 // get All Student Data
 
 function getStdDatat($user){
     $query=mysqli_query($con,"SELECT * FROM students  Where matricNumber='$user'");
    $getStdData = mysqli_fetch_assoc($query);
      return $getStdData;
}
 // ============ Get Total Acceptance Fees Paid===============
 
 function fetchAccpt(){
     $con=mysqli_connect("localhost", "escohsti_portalAdmin","IT;manager","escohsti_studentPortal");
    //$query=mysqli_query($con,"SELECT sum(Amount)TOTAL FROM Invoices  Where  ServiceType='2021/2022 Acceptance Fee' and InvoiceStatus='Successful'");
    $query=mysqli_query($con,"SELECT count(ID)*25000 AS TOTAL FROM onlineApplications  Where  Acceptance=1");
    while($fetchAcpt = mysqli_fetch_assoc($query)){
        $tot=$fetchAcpt['TOTAL'];
    }
    
return $tot;
}

function countAccpt(){
    $con=mysqli_connect("localhost", "escohsti_portalAdmin","IT;manager","escohsti_studentPortal");
    $query=mysqli_query($con,"SELECT Count(*)TOTAL FROM Invoices  Where  ServiceType='2021/2022 Acceptance Fee' and InvoiceStatus='Successful'");
    while($fetchComp = mysqli_fetch_assoc($query)){
        $tacpt=$fetchComp['TOTAL'];
    }
    
return $tacpt;
}

// ================= get SUm Compulsory Fees ===============

    function getCompFees(){
    $con=mysqli_connect("localhost", "escohsti_portalAdmin","IT;manager","escohsti_studentPortal");
    $query=mysqli_query($con,"SELECT sum(Amount)TOTAL FROM Invoices  Where  ServiceType='2021/2022 Compulsory Fee' and InvoiceStatus='Successful'");
    while($fetchComp = mysqli_fetch_assoc($query)){
        $toti=$fetchComp['TOTAL'];
    }
    
return $toti;
}
 function sumComp(){
    $con=mysqli_connect("localhost", "escohsti_portalAdmin","IT;manager","escohsti_studentPortal");
    $query=mysqli_query($con,"SELECT Count(*)TOTAL FROM Invoices  Where  ServiceType='2021/2022 Compulsory Fee' and InvoiceStatus='Successful'");
    while($fetchComp = mysqli_fetch_assoc($query)){
        $tots=$fetchComp['TOTAL'];
    }
    
return $tots;
}

 //==== Get News Notification =====================
 function getNws($con){
    
    $query=mysqli_query($con,"SELECT * FROM portalNews Where  forWhom='Admission' AND active =1 order by publishedDate, ID DESC");
    while($fetchnws = mysqli_fetch_assoc($query)){
  $nw.= $fetchnws ['newsTitle'] . "<br /> " .
         $fetchnws['newsBody'] .  "<br />" .
         "<code>". $fetchnws ['publishedDate'] . "</code><br />".
         "Publish By: <code>". $fetchnws ['staffCode'] . "</code><br /><hr />";
}
return $nw;
}
//==== Get admission data =====================
 function getadmission($con, $regH, $regV, $tblName){
    
    $query=mysqli_query($con,"SELECT * FROM $tblName Where  $regH='$regV'");
    while($fetch_getadmission = mysqli_fetch_assoc($query)){
      $data = $fetch_getadmission ['Course'] ;
    }
    return $data;
}

function updateadmission($con, $regH, $regV, $coH, $coV, $tblName){
    $update = "UPDATE `$tblName` SET `$coH` = '$coV' WHERE `$regH` = '$regV'";
    $query=mysqli_query($con, $update);
    if(!$query){
        return mysqli_error($con);
    }elseif($query){
        $msg = "Data Updated Sucessfully";
    }
    return $msg;
}
  // ============ Fetch All SCRTACH PIN for Printing=============
 function fetchpin() {
      $con=mysqli_connect("localhost", "escohsti_portalAdmin","IT;manager","escohsti_studentPortal");
      $data=mysqli_query($con, "Select * From scratchCards WHERE userId IS NULL AND id >541 ORDER BY date ASC LIMIT 500");
        while($scratch = mysqli_fetch_array($data)){
            $scpin.='<div class="col-xl-4 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                <a class="small text-white stretched-link center" style="padding:2px; padding-left:20px;">CHST-IJERO 2021/2022 Scratch Card.</a>
                                    <div style="padding: 0.5rem !important;" class="card-body"><p style="margin-bottom: 0.5rem !important; font-size: 12px;">SCRATCH PIN: '.$scratch['pinHash'].'</p><p style="margin-bottom: 0.5rem !important; font-size: 12px;">SERIAL NO: '. $scratch['serialNo'].'</p></div>
                                    
                                    <div style="padding: 0.5rem !important;"class="card-footer d-flex align-items-center justify-content-between">
                                         <a style="margin-bottom: 0.5rem !important; font-size: 12px;" class="small text-white stretched-link">Used '. $scratch['pinCounts'] .'/ 3 times.</a>
                                          <a style="margin-bottom: 0.5rem !important; font-size: 12px;"class="small text-white stretched-link">'. $scratch['date'] .'</a>
                                          <a style="margin-bottom: 0.5rem !important; font-size: 12px;"class="small text-white stretched-link">'. $scratch['id'] .'</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>';
    }
   return $scpin;
  }
  // ============ Fetch All Courses Assigned to a lecturer=============
  
  function getLectures($con,$facID){
    $stds="";
     $query = "SELECT * FROM Lectures WHERE  FacID='$facID' OR  StaffCode='$facID'  ORDER BY CourseCodes";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $id = $stdList['ID'];
             $stds.=  "<tr>
         <td>" . $stdList ['CourseCodes'] . "</td>" .
         "<td>" . $stdList ['CourseTitles'] . "</td>" .
         "<td>" . $stdList ['CourseUnits'] . "</td>" .
          "<td>" . $stdList ['AcademicSession'] . "</td>" .
          "<td>" ."<a href='assignCourses.php?cc=$id' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure? Unassigning  this Course Is not Reversible')\">UnAssign</a></td>".
         "</tr>";
    }
    return $stds;
}
 //==== Get Staff Profiles ==========
 
  function getStaffProfile($id) {
      $con=mysqli_connect("localhost", "escohsti_portalAdmin","IT;manager","escohsti_studentPortal");
      $data=mysqli_query($con, "Select * From Staffs WHERE StaffCode='$id' or ID='$id'");
       $fetchdata = mysqli_fetch_assoc($data);
   return $fetchdata;
  }
  
  // =========== Get Staff ID =======
  function getStaffId($id) {
      $con=mysqli_connect("localhost", "escohsti_portalAdmin","IT;manager","escohsti_studentPortal");
      $data=mysqli_query($con, "Select ID From Staffs WHERE StaffCode='$id'");
       $fetchdata = mysqli_fetch_assoc($data);
   return $fetchdata;
  }
  
 //==== Save School Invoice Geretated ==========
 
  function saveInvoice($level, $stdID,$amount,$type,$orderID,$rrr,$status,$con) {
      $data=mysqli_query($con, "INSERT INTO studentPayments(matricID,AmountPaid,StdLevel, PayType, orderId,RefNumber,Status,studentPhno, studentEmail) 
                                VALUES('$stdID', '$amount','$level','$type','$orderID','$rrr','$status','$phone', '$email')");
  }
 //get api data
 function apiCredential($id, $key){
     $con=mysqli_connect("localhost", "escohsti_portalAdmin","IT;manager","escohsti_studentPortal");
    $data = mysqli_query($con,"SELECT * from ApiCredentials where ID ='$id'");
    $fetchdata = mysqli_fetch_assoc($data);
   return $fetchdata[$key];
}

//get service id
function ServiceTypeID($ser_id, $key){
     $con=mysqli_connect("localhost", "escohsti_portalAdmin","IT;manager","escohsti_studentPortal");
    $data = mysqli_query($con,"SELECT * from ServiceTypeIDs where ID ='$ser_id'");
    $fetchdata = mysqli_fetch_assoc($data);
   return $fetchdata[$key];
}

//get Faculty id of Staff
function getFid($dptid){
     $con=mysqli_connect("localhost", "escohsti_portalAdmin","IT;manager","escohsti_studentPortal");
    $data = mysqli_query($con,"SELECT * from Departments where FacID ='$dptid'");
    $fetchdata = mysqli_fetch_assoc($data);
   return $fetchdata;
}
function getfeesWithType($level, $stdID,$status_p,$type,$con){
    
}

function getusefeesdata($stdLevel, $MatricNo, $fees){
    
}

// get  with type
function getPayment_categories($citizenship,$level,$payCategory,$con){
    
    $query=mysqli_query($con,"SELECT * FROM paymentCategories WHERE Citizenship ='$citizenship' AND Level = '$level' AND payCategories = '$payCategory'");
    $fetchdata = mysqli_fetch_assoc($query);
   return $fetchdata;
}

// get  with type
function check_rrrExist($rrr,$matric_num,$con){
    
    $query=mysqli_query($con,"SELECT * FROM studentPayments WHERE RefNumber ='$rrr' AND matricID = '$matric_num'");
    $fetchdata = mysqli_fetch_assoc($query);
   return $fetchdata;
}

function checkother_rrrExist($rrr,$matric_no,$con){
    $query=mysqli_query($con,"SELECT * FROM studentPayments WHERE RefNumber ='$rrr' AND matricID != '$matric_num'");
    $fetchdata = mysqli_fetch_assoc($query);
    return $fetchdata;
}

// Save Generated Invoice
function saveRRRData($matric_no,$pay_type,$amount,$refNNum,$orderID,$fixed_amount,$date,$status,$level,$session,$con){
    
    $query=mysqli_query($con,"INSERT INTO studentPayments (matricID,PayType,AmountPaid,RefNumber,orderId,Amountpayable,DatePaid,Status,StdLevel,AcademicSession) VALUES('$matric_no','$pay_type','$amount','$refNNum','$orderID','$fixed_amount','$date','$status','$level','$session')");
    if(!$query){
        return mysqli_error($con);
    }else{
        $msg="Invoice Created Successfully";
    
    }
    return $msg;
}


 // get  with type
function getinvoiceWithType($stdID,$status,$type,$con){
    
    $query=mysqli_query($con,"SELECT * FROM Invoices WHERE StudentID ='$stdID' AND InvoiceStatus = '$status' AND ServiceType = '$type'");
    $fetchdata = mysqli_fetch_assoc($query);
   return $fetchdata;
}

// Get Applicant UserAccount Details
function getuserdata($user_id,$con){
    
   $query = mysqli_query($con, "SELECT * FROM userAccounts Where ID ='$user_id'");
    $fetchuserdata = mysqli_fetch_assoc($query);
   return $fetchuserdata;
}

$usid="";
$id="";
 //Get Id of Applicants To Edit
 function getApplicants_Id($co,$refNum){
	$query =mysqli_query($con, "SELECT ID From onlineApplications Where RefNum ='$refNum'");
	while($usid=mysqli_fetch_array($query)){
	    $id=$usid['ID'];
	}
	return $id;
 }
	  //Get All Applicants Details
 function getApplicantDetails($con, $id){
	$query =mysqli_query($con, "SELECT * From OnlineApplications Where ID ='$id'");
	if(!$query){
	$msg = "Unable To Perform your Transaction".mysqli_error($con);
	}else{
	  $appl=mysqli_fetch_assoc($query);
	      
	  }
	  return $appl;
 }
	      
 //==========Comfirm screenResults Before Adm. ======
 function confirmResultsUploaded($con,$std){
    if($query = mysqli_query($con, "Select  * From applicationgResults Where Reg='$std' ")){
        
}
return $query;
}
 //===== Get All Income ======
 function getTotalRev($con){
    if($query = mysqli_query($con, "Select sum(AmountPaid) Total From studentPayments Where PayType='School Fees' AND Status ='Successful'")){
        while ($result = mysqli_fetch_array($query)){
            $total = $result['Total'];
            //$_SESSION['amtPayable'] = $amtPayable;
        }
}
return $total;
}

//===== Total Form Revenue ======
function getTotalFormRev($con){
    if($query = mysqli_query($con, "Select sum(Amount) Total From Invoices Where InvoiceStatus='Successful' AND ServiceType='2020/2021 Application Form'")){
        while ($result = mysqli_fetch_array($query)){
            $total = $result['Total'];
            //$_SESSION['amtPayable'] = $amtPayable;
        }
}
return $total;
}

//===== Get total Applications Received  ========

 function getTotalAppl($con){
    if($query = mysqli_query($con, "Select count(RefNum) Total From onlineApplications")){
        while ($result = mysqli_fetch_array($query)){
            $total = $result['Total'];
            //$_SESSION['amtPayable'] = $amtPayable;
        }
}
return $total;
}


// ==== Get All Generated Invoices Total=============
function getAllApplInvoices($con){
    if($query = mysqli_query($con, "Select count(RefNum) Total From Invoices")){
        while ($result = mysqli_fetch_array($query)){
            $total = $result['Total'];
          
        }
}
return $total;
}

//Get Total Unpaid Invoices 
function getUnpaid($con){
    if($query = mysqli_query($con, "Select count(RefNum) Total From Invoices Where InvoiceStatus='Payment Reference generated'")){
        while ($result = mysqli_fetch_array($query)){
            $total = $result['Total'];
            //$_SESSION['amtPayable'] = $amtPayable;
        }
}
return $total;
}

//get Uncompleted Applications

function getUncompleted($con){
    if($query = mysqli_query($con, "Select count(RefNum) Total From onlineApplications Where Status<3")){
        while ($result = mysqli_fetch_array($query)){
            $total = $result['Total'];
            //$_SESSION['amtPayable'] = $amtPayable;
        }
}
return $total;
}


//get Uncompleted Applications

function getCompleted($con){
    if($query = mysqli_query($con, "Select count(RefNum) Total From onlineApplications Where Status =3")){
        while ($result = mysqli_fetch_array($query)){
            $total = $result['Total'];
            //$_SESSION['amtPayable'] = $amtPayable;
        }
}
return $total;
}

// ======== Approve Results ================

function approveResults($con){
   
     $query = "SELECT ID, MatricNO, FullName, DeptCode, Count(CourseCode) AS TotalStd, CourseCode, CA1, CA2, CA3, ExamScore, CumTotalScore,Remark, SubmittedBy,Status, Visibility FROM ScoreSheet GROUP BY CourseCode ORDER BY DateSubmitted";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $id = $stdList['ID'];
            $msg=$_GET['msg'];
            $cCode =$stdList['CourseCode'];
             $scores.= "<td>" .$stdList ['CourseCode'] . "</td>" .
             "<td>" . $stdList ['CA1'] . "</td>" .
             "<td>" . $stdList ['CA2'] . "</td>" .
             "<td>" . $stdList ['CA3'] . "</td>" .
              "<td>" . $stdList ['ExamScore'] . "</td>" .
                "<td>" . $stdList ['TotalStd'] . "</td>" .
              "<td>" . $stdList ['SubmittedBy'] . "</td>" .
              "<td>" . $stdList ['Status'] . "</td>" .
              /*"<td>" . $stdList ['Visibility'] . "</td>" .*/
              "<td>" ."<a href='viewResults.php?cc=$id && c=$cCode && msg=$msg' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure You want to Approve this Score')\">Approve</a>
                        <a href='viewResults.php?disap=$id && dsap=$cCode && msg=$msg' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure You want to Disapprove the score')\">DisApprove</a>
              </td>".
             "</tr>";
    }
    return $scores;
}

 //================View STD Results ==================
function viewScores($con){
   
     $query = "SELECT ID, MatricNO, FullName, DeptCode, Count(CourseCode) AS TotalStd, CourseCode, CA1, CA2, CA3, ExamScore, CumTotalScore,Remark, SubmittedBy,Status, Visibility FROM ScoreSheet GROUP BY CourseCode ORDER BY CourseCode";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $id = $stdList['ID'];
            $msg=$_GET['msg'];
            $cCode =$stdList['CourseCode'];
             $scores.=  /*"<tr><td>" .$stdList ['MatricNO'] . "</td>" .*/
             /*"<td>" .$stdList ['FullName'] . "</td>" .*/
             /*"<td>" .$stdList ['DeptCode'] . "</td>" .*/
             "<td>" .$stdList ['CourseCode'] . "</td>" .
             "<td>" . $stdList ['CA1'] . "</td>" .
             "<td>" . $stdList ['CA2'] . "</td>" .
             "<td>" . $stdList ['CA3'] . "</td>" .
              "<td>" . $stdList ['ExamScore'] . "</td>" .
              /*"<td>" . $stdList ['CumTotalScore'] . "</td>" .*/
              /*"<td>" . $stdList ['Remark'] . "</td>" .*/
               "<td>" . $stdList ['TotalStd'] . "</td>" .
              "<td>" . $stdList ['SubmittedBy'] . "</td>" .
              "<td>" . $stdList ['Status'] . "</td>" .
              /*"<td>" . $stdList ['Visibility'] . "</td>" .*/
              "<td>" ."<a href='approveResults.php?cc=$id && viw=$cCode && msg=$msg' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure You want to make this Score Visible?')\">Viewable</a>
                        <a href='approveResults.php?disap=$id && nViu=$cCode && msg=$msg' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure Restrict The View?')\">NotViewable</a>
              </td>".
             "</tr>";
    }
    return $scores;
}
//================Get STD Results ==================
function getStdScores($con,$std){
   
     $query = "SELECT CourseCode, CA1, CA2, CA3, ExamScore, CumTotalScore FROM ScoreSheet  Where  	MatricNO  ='$std' ORDER BY CourseCode";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            //$id = $stdList['ID'];
             $scores.=  "<tr><td>" .$stdList ['CourseCode'] . "</td>" .
         "<td>" . $stdList ['CA1'] . "</td>" .
         "<td>" . $stdList ['CA2'] . "</td>" .
         "<td>" . $stdList ['CA3'] . "</td>" .
          "<td>" . $stdList ['ExamScore'] . "</td>" .
          "<td>" . $stdList ['CumTotalScore'] . "</td>" .
         "</tr>";
    }
    return $scores;
}
// =========== Sum All Scores for CumTotalScores =================
function sumScores($con){
     $query =mysqli_query($con, "SELECT MatricNO  FROM ScoreSheet");
     while($results=mysqli_fetch_array($query)){
         $matric = $results['MatricNO'];
     }
     
     $query = "SELECT CA1,CA2,CA3,ExamScore  FROM ScoreSheet WHere MatricNO IN('$matric')";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($results=mysqli_query($query)){
            $ca1=$results['CA1'];
            $ca2=$results['CA2'];
            $ca3=$results['CA3'];
            $ExamScore=$results['ExamScore'];
            $totalScore=($ca1+$ca2+$c3+$ExamScore);
        }
        return $totalScore;
}

// Confirm User =========

function confirmSuper($jbt){
     //&& $jbt != 'PROVOST'
    if($jbt != "IT_SUPPORT" && $jbt != "PORTAL_ADM"){
       header('location:logout.php?msg=You Do Not Have View  Access to This page.');
   } 
}

function confirmHOD($jbt){
    if($jbt != "HOD" && $jbt !="PORTAL_ADM" && $jbt != "IT_SUPPORT" && $jbt != "DEAN"){
       header('location:index.php?msg=You Do Not Have View  Access to This page.');
   } 
}
function confirmLecturer($jbt){
    if($jbt != "HOD" && $jbt !="PORTAL_ADM" && $jbt != "IT_SUPPORT" && $jbt != "LECTURER"){
       header('location:index.php?msg=You Do Not Have View  Access to This page.');
   } 
}

function confirmBUR($jbt){
    if($jbt != "BURSAR" ){
       header('location:index.php?msg=You Do Not Have View  Access to This page.');
   } 
}
//===== Get A Specific Fee ===========

function getFees($con,$id){
    $stds="";
     $query = "SELECT * FROM paymentCategories Where ID='$id' ORDER BY Level";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
       /* while($stdList = mysqli_fetch_array($query)){
            $id = $stdList['ID'];
             $stds.=  "<tr><td>" .$stdList ['payCategories'] . "</td>" .
        "<td>" . $stdList['Amount']. "</td>".
        "<td>".  $stdList['Citizenship'] . "</td>" .
         "<td>" . $stdList ['Semester'] . "</td>" .
         "<td>" . $stdList ['AcademicSession'] . "</td>" .
         "<td>" . $stdList ['Level'] . "</td>" .
          "<td>" . $stdList ['ProgType'] . "</td>" .
          "<td>" ."<a href='updateFees.php?cc=$id' class='btn btn-primary btn-block'>Edit</a></td>".
         "</tr>";
         
    }*/
    return $query;
}
//=============Get All Fees ===============
function getAllFees($con){
    $stds="";
     $query = "SELECT * FROM paymentCategories ORDER BY Level";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $id = $stdList['ID'];
             $stds.=  "<tr><td>" .$stdList ['payCategories'] . "</td>" .
        "<td>" . $stdList['Amount']. "</td>".
        "<td>".  $stdList['Citizenship'] . "</td>" .
         "<td>" . $stdList ['Semester'] . "</td>" .
         "<td>" . $stdList ['AcademicSession'] . "</td>" .
         "<td>" . $stdList ['Level'] . "</td>" .
          "<td>" . $stdList ['ProgType'] . "</td>" .
          "<td>" ."<a href='updateFees.php?cc=$id' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure you want to Edit This Payments')\">Edit</a></td>".
         "</tr>";
         
    }
    return $stds;
}


//===== Get Amount Payable ==============

function getAmtPayable($con,$stdLevel){
    if($query = mysqli_query($con, "Select Amount From paymentCategories Where Citizenship ='$citizen'")){
        while ($result = mysqli_fetch_array($query)){
            $amtPayable = $result['Amount'];
            $_SESSION['amtPayable'] = $amtPayable;
        }
}
return $amtpayable;
}


//===== ENd =================

// =========== Get Total amtPaid================

function getTotalAmt($con,$userID){
    if($query = mysqli_query($con, "Select sum(AmountPaid) Total From studentPayments Where matricID ='$userID'")){
        while ($result = mysqli_fetch_array($query)){
            $total = $result['Total'];
            //$_SESSION['amtPayable'] = $amtPayable;
        }
}
return $total;
}
function getamtpaid($con,$id){
    if($query = mysqli_query($con, "Select sum(AmountPaid) Total From studentPayments Where ID ='$id'")){
        while ($result = mysqli_fetch_array($query)){
            $total = $result['Total'];
            //$_SESSION['amtPayable'] = $amtPayable;
        }
}
return $total;
}

//========== COnfirm User Login Credentials===

function confirmFirstLogin($con, $username, $password){
    $query =mysqli_query($con, "SELECT ID, matricNumber, passKey From students Where matricNumber ='$username' AND passKey ='$password'");
    
	    return $query;

}
// === Get STudent State =====

function getStates($con,$st){
if($query = mysqli_query($con, "Select state_id, name From states Where name LIKE'%$st%'")){
        while ($result = mysqli_fetch_array($query)){
            $stOr = $result['name'];
            $id = $result['state_id'];
        }

}
return $id;
}


// === Get Staff State =====

function getSts($con){
if($query = mysqli_query($con, "Select state_id, name From states")){
        while ($result = mysqli_fetch_array($query)){
            $stOr = $result['name'];
            $id = $result['state_id'];
        }
         $s .= "<option value='$stOr'>$stOr</option>";
}
return $st;
}


//============Get STd state Local Govt===============
$stdLocals ="";
function getStateLocals($con,$stID){
if($query = mysqli_query($con, "Select local_id, local_name From states Where state_id=$id")){
        while ($result = mysqli_fetch_array($query)){
            $stLocal = $result['local_name'];
            $Lid = $result['local_id'];
            $stdLocals .= "<option value='$stLocal'>$stLocal</option>";
        }
        
}
return $stdLocals;
}

function getCode($con,$courseCode){
    $courseID=$courseCode;
    $cCode =mysqli_query($con,"SELECT CourseCode From CourseCodes Where Id =".$courseID);
    if(!$cCode){
        return mysqli_error($con);
    }else{
        while($CourseCode=mysqli_fetch_array($cCode)){
            $courseCode=$CourseCode['CourseCode'];
        }
    }
    return $courseCode;
}

// ================ Get All Lectures Details ======================
function getAllLectures($con,$facID){
    $stds="";
     $query = "SELECT * FROM Lectures WHERE FacID='$facID' OR StaffCode='$facID' ORDER BY StaffID";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $id = $stdList['ID'];
             $stds.=  "<tr><td>" .$stdList ['StaffCode'] . "</td>" .
        "<td>" . $stdList['FullName']. "</td>". "<td>".  $stdList['PhoneNumber'] . "</td>" .
         "<td>" . $stdList ['CourseCodes'] . "</td>" .
         "<td>" . $stdList ['CourseTitles'] . "</td>" .
         "<td>" . $stdList ['CourseUnits'] . "</td>" .
          "<td>" . $stdList ['AcademicSession'] . "</td>" .
          "<td>" ."<a href='assignCourses.php?cc=$id' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure? Unassigning  this Course Is not Reversible')\">UnAssign</a></td>".
         "</tr>";
    }
    return $stds;
}


function getPayId($con,$userID){
   
    $userId=$userID;
$pay=mysqli_query($con,"Select RefNumber From studentPayments Where matricID ='$userId'");
while($payCode=mysqli_fetch_array($pay)){
    $payID =$payCode ['RefNumber'];
}


return $payID;
}

function paidamount($con,$userId,$level){
    $amount = 0;
    $pay=mysqli_query($con,"Select AmountPaid From studentPayments Where matricID ='$userId' AND StdLevel = '$level'");
    while($payCode=mysqli_fetch_array($pay)){
        $amount = $payCode ['AmountPaid'] + $amount;
    }
    
    
    return $amount;
}

function fixedpayment($con,$citizen,$level){
   
$pay=mysqli_query($con,"Select Amount, PayPercentages From paymentCategories Where Citizenship ='$citizen' AND Level = '$level'");



return $pay;
}


function mysql_escape_mimic($inp) {
    if(is_array($inp))
        return array_map(__METHOD__, $inp);

    if(!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
    }

    return $inp;
} 

function mysql_fix_string($string){
    if(get_magic_quotes_gpc())
        $string = stripslashes($string);
        return mysql_real_escape_string($string);
}

function mysql_entities_fix_string(){
    return htmlentities(mysql_fix_string($string));
}

function sanitizeString($string){
    $string = stripslashes($string);
    $string = htmlentities($string);
    $string = strip_tags($string);
    return $string;
}
function sanitizeMySQL($string){
    $string = mysql_real_escape($string);
    $string = sanitizeString($string);
    $string=mysql_entities_fix_string($string);
    return $string;
}

function confirmLogin (){
    if(!$_SESSION['userID']){
   return header('location:https://eportal.escohsti-edu.ng/staffArea/logout.php?msg=You Must LogIn First');
}
}

function confirmAdmLogin (){
    if(!$_SESSION['userID']){
   return header('location:https://eportal.escohsti-edu.ng/staffArea/logout.php?msg=You Must LogIn First');
}
}

function confirmPswd() {
    if(isset($_SESSION['pid'])){
    $pwd='password1';
    if($pwd == $_SESSION['pid']){
       return header('location:password.php');
       
    }
}
}

function getCourseCode($con){                                    $schlID ='';
                                                            $query = "SELECT CourseCode, CourseTitle FROM Courses";
                                                            $query = mysqli_query($con, $query);
                                                            if($query){ return mysqli_error($con);
                                                            } else{
                                                            while ($schl = mysqli_fetch_array($query,$con)){
                                                                $schlID = $schl ['CourseCode'];
                                                               $schools = $schl ['CourseTitle'];
                                                               return $schools .= "<option value='$schools'>$schlID ". '  '. "($schools)</option>";
                                                               } 
                                                            }
                                                           
}

function getStd($fileName){
    if(isset($fileName)){
     require_once("../connection.php");
    include("SimpleXLSX.php");
        if($con){
        //echo "Hi You Are Connected";
        $std=SimpleXLSX::parse($_FILES['std']['tmp_name']);
        echo "<pre>"; 
        //print_r($std->rows(1));
        print_r($std->dimension(2));
        print_r($std -> sheetNames());
        for($sheet=0; $sheet < sizeof($std->sheetNames()); $sheet++){
            $rowcol =$std->dimension($sheet);
        $i=0;
        if($rowcol[0]!=1 && $rowcol[1]!=1){
        foreach ($std->rows($sheet) as $key => $row){
           // print_r($row);
            $q="";
            foreach ($row as $key => $cell){
               // echo $cell; echo "<br>";
                if($i==0){
                    $q.=$cell." Varchar(50),";
                    
                } else {
                    $q.="'".$cell ."',";
                    
                }
            }
            if($i==0){
            $query = "CREATE Table ". $std->sheetName($sheet)."(".rtrim($q,",").");"; 
            }else {
            $query = "INSERT INTO " .$std->sheetName($sheet)." Values (".rtrim($q,",").");";
            }
            echo $query; 
            if(mysqli_query($con,$query)){
                echo "imported";
            }
            echo "<br>";
            echo "<br />";
             $i++;
        }
        
    }
}
}
}
}
        
function getCourses($con,$stdM,$sess){
   $stdEmai ="";
   $stdCourses ="";
                                                 $matr =$_SESSION['userID'];
                                                 $stdEmai = $_SESSION['stdEmail'];
                                                 if(!empty($stdEmai)){
                                                 //mysql_real_escape_string($con,$matr);
                                                 /*mysql_escape_mimic($matricID);
                                                 mysql_fix_string($matricID);
                                                 mysql_entities_fix_string();
                                                 sanitizeMySQL($matricID);*/
       $query = "SELECT MatricNumber,CourseUnits,CourseCode,CourseName,Semester,RegisteredAs, Department FROM studentCourseReg WHERE studentEmail ='$stdM' AND   AcademicSession ='$sess' ORDER BY CourseUnits";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $stdCourses .= "<tr><td>" .$stdList ['MatricNumber'] . "</td>" .
        "<td>" . $stdList['CourseCode'] . "</td>". "<td>".  $stdList['CourseName'] . "</td>" .
         "<td>" . $stdList ['Department'] . "</td>" .
         "<td>" . $stdList ['CourseUnits'] . "</td>" .
         "<td>" . $stdList ['Semester'] . "</td>" .
          "<td>" . $stdList ['RegisteredAs'] . "</td>". "</tr>";
    } }  
    
    return $stdCourses;
}

function getImage($con,$std){
    $stdmail = $std;
    $stdImg =mysqli_query($con,"Select StdPassport,matricNumber,firstName From students Where studentEmail ='$stdmail'");
    while ($stdImg =mysqli_fetch_array($stdImg)){
    $stdimg = $stdImg ['StdPassport'];
    }
    return $stdimg;
}
function getpassport($con,$stdMatric){
    $stdImg =mysqli_query($con,"Select StdPassport,matricNumber,firstName From students Where matricNumber ='$stdMatric'");
    while ($stdImg =mysqli_fetch_array($stdImg)){
    $stdimg = $stdImg ['StdPassport'];
    }
    return $stdimg;
}

function getAllStd($con){
    $stds="";
     $query = "SELECT ID, matricNumber,firstName,middleName,lastName,stdPhoneNumber ,department, Gender,studentLevel  FROM students  ORDER BY matricNumber";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $id= $stdList ['ID'];
            $msg=$_GET['msg'];
            $userC = $stdList ['matricNumber'];
            $stds.=  "<tr><td>" .$stdList ['matricNumber'] . "</td>" .
        "<td>" . $stdList['firstName'] .  ' '. $stdList['middleName'] .'  ' . $stdList['lastName'] ."</td>". 
        "<td>".  $stdList['stdPhoneNumber'] . "</td>" .
         "<td>" . $stdList ['department'] . "</td>" .
         "<td>" . $stdList ['Gender'] . "</td>" .
         "<td>" . $stdList ['studentLevel'] . "</td>" .
         "<td>" ."<a href='removeDuplicates.php?id=$id && msg=$msg && user=$userC' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure? Deleting this Courses Is not Reversible')\">Remove Duplicates</a></td>".
         "</tr>";
    }
    return $stds;
}

function getAllStds($con){
    $stds="";
    $std="";
    if(isset($_GET['adm'])) {
        $user=$_GET['adm'];
        //$query = "SELECT ID, matricNumber,firstName,middleName,lastName,stdPhoneNumber ,department, Gender,studentLevel  FROM students  ORDER BY matricNumber";
         // $dpt = $_SESSION['dpt'];
$query = "SELECT RegNumber, FirstName, MiddleName, Surname, PhoneNO, Email, Schools, Departments,StOrigin,LGA, Address,Gender,RefNum FROM onlineApplications Where AdmStatus=1";
if (!$stdLists = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
}  
 while($stdList = mysqli_fetch_array($stdLists)){
            $id= $stdList ['ID'];
            $msg=$_GET['msg'];
            $userC = $stdList ['RegNumber'];
            $std.=  "<tr><td>" .$stdList ['RegNumber'] . "</td>" .
        "<td>" . $stdList['FirstName'] .  ' '. $stdList['MiddleName'] .'  ' . $stdList['Surname'] ."</td>". 
        "<td>".  $stdList['PhoneNO'] . "</td>" .
         "<td>" . $stdList ['Departments'] . "</td>" .
         "<td>" . $stdList ['Gender'] . "</td>" .
         "<td>" . $stdList ['RefNum'] . "</td>" .
         //"<td>" ."<a href='removeDuplicates.php?id=$id && msg=$msg && user=$userC' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure? Deleting this Courses Is not Reversible')\">Remove Duplicates</a></td>".
         "</tr>";
    }
    return $std;
    } 
    
    //allapplications List 
    if(isset($_GET['allAdm'])) {
        $user=$_GET['allAdm'];
        //$query = "SELECT ID, matricNumber,firstName,middleName,lastName,stdPhoneNumber ,department, Gender,studentLevel  FROM students  ORDER BY matricNumber";
         // $dpt = $_SESSION['dpt'];
$query = "SELECT RegNumber, FirstName, MiddleName, Surname, PhoneNO, Email, Schools, Departments,StOrigin,LGA, Address,Gender,RefNum FROM onlineApplications Where Status=3";
if (!$stdLists = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
}  
 while($stdList = mysqli_fetch_array($stdLists)){
            $id= $stdList ['ID'];
            $msg=$_GET['msg'];
            $userC = $stdList ['RegNumber'];
            $std.=  "<tr><td>" .$stdList ['RegNumber'] . "</td>" .
        "<td>" . $stdList['FirstName'] .  ' '. $stdList['MiddleName'] .'  ' . $stdList['Surname'] ."</td>". 
        "<td>".  $stdList['PhoneNO'] . "</td>" .
         "<td>" . $stdList ['Departments'] . "</td>" .
         "<td>" . $stdList ['Gender'] . "</td>" .
         "<td>" . $stdList ['RefNum'] . "</td>" .
         //"<td>" ."<a href='removeDuplicates.php?id=$id && msg=$msg && user=$userC' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure? Deleting this Courses Is not Reversible')\">Remove Duplicates</a></td>".
         "</tr>";
    }
    return $std;
    } 
    //}
    if(isset($_GET['std'])) {
        $user=$_GET['std'];
        $query = "SELECT ID, matricNumber,firstName,middleName,lastName,stdPhoneNumber ,department, Gender,studentLevel  FROM students  ORDER BY matricNumber";
   // }
     //$query = "SELECT ID, matricNumber,firstName,middleName,lastName,stdPhoneNumber ,department, Gender,studentLevel  FROM students  ORDER BY matricNumber";
    // $query = "SELECT RegNumber, FirstName, MiddleName, Surname, PhoneNO, Email, Schools, Departments,StOrigin,LGA, Address,Gender,RefNum FROM onlineApplications Where AdmStatus=1";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $id= $stdList ['ID'];
            $msg=$_GET['msg'];
            $userC = $stdList ['matricNumber'];
            $stds.=  "<tr><td>" .$stdList ['matricNumber'] . "</td>" .
        "<td>" . $stdList['firstName'] .  ' '. $stdList['middleName'] .'  ' . $stdList['lastName'] ."</td>". 
        "<td>".  $stdList['stdPhoneNumber'] . "</td>" .
         "<td>" . $stdList ['department'] . "</td>" .
         "<td>" . $stdList ['Gender'] . "</td>" .
         "<td>" . $stdList ['studentLevel'] . "</td>" .
         //"<td>" ."<a href='removeDuplicates.php?id=$id && msg=$msg && user=$userC' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure? Deleting this Courses Is not Reversible')\">Remove Duplicates</a></td>".
         "</tr>";
    }
    return $stds;
}
}

$userC="";
// ==========  Get All Student For A Courses =============
function getStdByCourses($con,$dptN){
    $std="";
    $msg="";
     $query = "SELECT ID, MatricNumber,CourseCode ,CourseName, 	CourseUnits, RegisteredAs, StdLevel, count(MatricNumber) TOTAL  FROM studentCourseReg Where Department ='$dptN'  GROUP BY CourseCode ORDER BY MatricNumber";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $id= $stdList ['ID'];
            $msg=$_GET['msg'];
            $userC = $stdList ['MatricNumber'];
            $std.=  "<tr><td>" .$stdList ['MatricNumber'] . "</td>" .
        "<td>" . $stdList['CourseCode'] ."</td>". "<td>".  $stdList['CourseName'] . "</td>" .
         "<td>" . $stdList ['CourseUnits'] . "</td>" .
         "<td>" . $stdList ['RegisteredAs'] . "</td>" .
         "<td>" . $stdList ['StdLevel'] . "</td>" .
          "<td>" . $stdList ['TOTAL'] . "</td>" .
           "<td>" ."<a href='courseDetails.php?cc=$id && msg=$msg && user=$userC' class='btn btn-primary btn-block'>Details</a></td>".
         "</tr>";
    }
    return $std;
}
$admi="";
function confirmUserAdm($con, $userID){
    $adminUser =$userID;
     $userAdm = mysqli_query($con,"Select userName UserAdmins WHERE userName ='$adminUser'");
     
         while ($adm =mysqli_fetch_array($userAdm)){
             $admi = $adm['userName'];
        
     }
     return $admi;
}

//
function getAllpayments($con){
    $stds="";
     $query = "SELECT *  FROM studentPayments ORDER BY DatePaid";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $stds.="<tr><td><a href='getAllPayments.php?pId='".$stdList['PayID'].">" .$stdList ['matricID'] . "</a></td>" .
        "<td>" . $stdList['PayType'] ."</td>" ."<td>" . $stdList['AmountPaid'] ."</td>". "<td>".  $stdList['RefNumber'] . "</td>" .
         "<td>" . $stdList ['DatePaid'] . "</td>" ."</tr></a>";
    }
    return $stds;
}

function getAllCourses($con,$deptName,$dptID){
   $stdEmai ="";
   $stdCourses ="";
   
       $query = "SELECT CourseID,CourseCode,count(CourseCode) AS TOTAL_COURSES,CourseTitle, CourseUnits,Department,Faculty FROM Courses WHERE Department ='$dptID'  GROUP BY Faculty ORDER BY CourseUnits";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $stdCourses .= "<tr><td>" .$stdList ['CourseID'] . "</td>" .
        "<td>" . $stdList['CourseCode'] . "</td>".
        "<td>".  $stdList['CourseTitle'] . "</td>" .
         "<td>" . $stdList ['CourseUnits'] . "</td>" .
         "<td>" . $stdList ['Department'] . "</td>" .
         "<td>" . $stdList ['Faculty'] . "</td>" .
         "<td>" . $stdList ['TOTAL_COURSES'] . "</td>" .
        "</tr>";
    }   
    
    return $stdCourses;
}

function adminGetAllCourses($con){
   $stdEmai ="";
   $stdCourses ="";
   
       $query = "SELECT CourseID,CourseCode,count(CourseCode) AS TOTAL_COURSES,CourseTitle, CourseUnits,Department,Faculty FROM Courses   GROUP BY Faculty ORDER BY CourseUnits";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $stdCourses .= "<tr><td>" .$stdList ['CourseID'] . "</td>" .
        "<td>" . $stdList['CourseCode'] . "</td>".
        "<td>".  $stdList['CourseTitle'] . "</td>" .
         "<td>" . $stdList ['CourseUnits'] . "</td>" .
         "<td>" . $stdList ['Department'] . "</td>" .
         "<td>" . $stdList ['Faculty'] . "</td>" .
         "<td>" . $stdList ['TOTAL_COURSES'] . "</td>" .
        "</tr>";
    }   
    
    return $stdCourses;
}

// ===========================
$cCode="";
function getcourses1($con){
   $stdEmai ="";
   $stdCourses ="";
   
       $query = "SELECT CourseID,CourseCode,CourseTitle, CourseUnits,Department,Faculty FROM Courses   ORDER BY CourseUnits";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $id= $stdList ['CourseID'];
            $msg=$_GET['msg'];
            $cCode=$stdList['CourseCode'];
            $stdCourses .= "<tr><td>" .$stdList ['CourseID'] . "</td>" .
        "<td>" . $stdList['CourseCode'] . "</td>".
        "<td>".  $stdList['CourseTitle'] . "</td>" .
         "<td>" . $stdList ['CourseUnits'] . "</td>" .
         "<td>" . $stdList ['Department'] . "</td>" .
         "<td>" . $stdList ['Faculty'] . "</td>" .
          "<td>" ."<a href='editCourse.php?cc=$id && msg=$msg' class='btn btn-primary btn-block'>Edit</a>
                    <a href='editCourse.php?id=$id && msg=$msg && cCode=$cCode' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure? Deleting this Courses Is not Reversible')\">Delete</a>
          </td>".
        "</tr>";
    }   
    
    return $stdCourses;
}

$dpt="";
//=========== All Apllications ===============
function getAllAppls($con){
   $stdEmai ="";
   $stdCourses ="";
   
       $query = "SELECT ID, RegNumber, CONCAT(FirstName,' , ',  MiddleName,'  ',  Surname) AS FULLNAME,PhoneNO, Departments, RefNum, count(RefNum) AS Total , StOrigin  FROM onlineApplications Group By Departments  ORDER BY ID";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $id= $stdList ['ID'];
            $msg=$_GET['msg'];
            $dpt=$stdList ['Departments'];
            $stdCourses .= //"<tr><td>" .$stdList ['RegNumber'] . "</td>" .
       // "<td>" . $stdList['FULLNAME'] . "</td>".
       // "<td>".  $stdList['PhoneNO'] . "</td>" .
         "<td>" . $stdList ['Departments'] . "</td>" .
        // "<td>" . $stdList ['RefNum'] . "</td>" .
         //"<td>" . $stdList ['StOrigin'] . "</td>" .
         "<td>" . $stdList ['Total'] . "</td>" .
          "<td>" ."<a href='stdDetails.php?cc=$id && msg=$msg && dpt=$dpt' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure?')\">Show  Details(ALL)</a>
                    </td>".
                    
        "</tr>";
    }   
    
    return $stdCourses;
}

// ============ Get All Staff Lecturers ========================

function getStaffs($con){
   $stdEmai ="";
   $stf ="";
   $fid="";
       $query = "SELECT ID,StaffCode,DeptID,Title,FirstName, Surname, Job_Role, PhoneNumber,Designation,count(DeptID)TotalinDept, FacID  FROM Staffs   GROUP BY FacID";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $id=$stdList ['ID'];
            $dpt= $stdList ['DeptID'];
             $fid= $stdList ['FacID'];
            $msg=$_GET['msg'];
            $stf .= "<tr><td>" .$stdList ['StaffCode'] . "</td>" .
        "<td>" . $stdList['Title'] . "</td>".
        "<td>".  $stdList['FirstName'] . "</td>" .
         "<td>" . $stdList ['Surname'] . "</td>" .
         "<td>" . $stdList ['Job_Role'] . "</td>" .
         "<td>" . $stdList ['PhoneNumber'] . "</td>" .
         "<td>" . $stdList ['Designation'] . "</td>" .
         "<td>" . $stdList ['TotalinDept'] . "</td>" .
         "<td>" ."<a href='staffDetails.php?cc=$id && msg=$msg && dpt=$dpt && fid=$fid' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure You Want to View The Staffs In This Dept?')\">Details</a>
                    <a href='#stdDetails.php?cc=$id && msg=$msg && dpt=$dpt && fid=$fid' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure you Want to  Remove this Staff? This Task Is Not Reversible. OK to Proceeds)\">Remove Staff</a></td>".
        "</tr>";
    }   
    
    return $stf;
}


 // ======== Get Sdetails By Deptartment ==============
function stfDetails($con,$dpt){
   $dpt ="";
   $stf ="";
   
       $query = "SELECT ID,StaffCode,DeptID,Title,FirstName, Surname, Job_Role, PhoneNumber,Designation,count(DeptID) TotalinDept FROM Staffs WHere DeptID='$dpt'";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $id=$stdList ['ID'];
            $dpt= $stdList ['DeptID'];
            $stf .= "<tr><td>" .$stdList ['StaffCode'] . "</td>" .
        "<td>" . $stdList['Title'] . "</td>".
        "<td>".  $stdList['FirstName'] . "</td>" .
         "<td>" . $stdList ['Surname'] . "</td>" .
         "<td>" . $stdList ['Job_Role'] . "</td>" .
         "<td>" . $stdList ['PhoneNumber'] . "</td>" .
         "<td>" . $stdList ['Designation'] . "</td>" .
         "<td>" . $stdList ['TotalinDept'] . "</td>" .
         "<td>" ."<a href='staffDetails.php?cc=$id && msg=$msg && dpt=$dpt' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure You Want to Edit This Staff')\">Details</a>
                    <a href='#stdDetails.php?cc=$id && msg=$msg && cc=$dpt' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure?' Reoveing this STaff Is Not Reversible. OK to Proceeds)\">Remove Staff</a></td>".
        "</tr>";
    }   
    
    return $stf;
}

?>