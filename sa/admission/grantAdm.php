<?php
include_once('../../functions.php');
require_once('../../connection.php');
confirmLogin();
$id="";
$sid="";
$avg="";
$admStatus="";
$regNum="";
$dpt="";
$fname="";

if(isset($_GET['stdID']) || isset($_GET['cc'])){
    
                $sid = $_GET['cc'];
         $id = $_GET['stdID'];
    
    if(!empty($id) && !empty($sid)){
        // Very Results Uploaded 
        if(!empty($sid)){
            $rs=mysqli_num_rows(confirmResultsUploaded($con,$sid));
          if($rs==0){
             echo  $msg="<script> alert('You Have not Uploaded Results for Applicant ID: $sid.$id . $rs');</script>";
             header('location:dashboard.php?msg=$user && upd=Your Results Has not been Uploaded for Admission Processing');
          }else{
        $query = mysqli_query($con, "Update ScreeningResults SET Status =1
                                    Where   ID ='$id' OR StudentID='$sid'");
                                    
                if(!$query){
                    echo $msg="Unbale to Approve Admission".mysqli_error($con);
                } else{
                    echo $msg="<script> alert('You Have Successfully Approved Admission For Applicants Reg: $sid . $id');</script>";
                    
                }
                     $query11 = mysqli_query($con, "SELECT  RegNumber, CONCAT(FirstName,' , ',  MiddleName,'  ',  Surname) AS FULLNAME,
                                            PhoneNO, Departments,Schools, StOrigin,AmountPaid,Gender  
                                    FROM    onlineApplications
                                    Where   ID ='$id'");
                    while($rs= mysqli_fetch_array($query11)){
                        $regNum=$rs['RegNumber'];
                        $dtp=$rs ['Departments'];
                        $_SESSION['dpt']= $dpt;
                        $fname=$rs['FULLNAME']. "<br />";
                        
                }
                $query1=mysqli_query($con, "SELECT Average From ScreeningResults Where StudentID='$regNum' AND Status=1");
                if(mysqli_num_rows($query1) == 1){
                    while($rws =mysqli_fetch_array($query1)){
                         $avg=$rws ['Average'];
                        
                    }
                $query2=mysqli_query($con, "INSERT INTO admissions(RegNumber,FullName,Departments,AvgScore,AdmStatus) VALUES('$regNum', '$fname', '$dtp','$avg',1)");
                if(!$query2){
                    $msg = "There Was Error An In Updating Your Admission Records For Applicants with  ID: $sid.$id :  "."  Error: " .mysqli_error($con);
                    echo "<script> alert('$msg');</script>";
                } else {
                     $msg="You Have Successfully Approved Admission For Applicants with  ID: $sid.$id";
                     header('location:dashboard.php?upd='.$msg);
                }
                    }
                }
      }
        }
      
//}

//header('location:dashboard.php?upd='.$msg);
}
?>

<?php 
require('../../close_connection.php');

?>
