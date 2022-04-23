<?php
require('connection.php');
session_start();
$resp="";
$courseCode="";
$appsx="";

// Confirm IF Invoice Is Generated 
function confirmInvoice($con,$stdID){
   
    $inv = mysqli_query($con,"SELECT * From Invoices Where StudentID ='$stdID'");
    if(!$inv){
        return mysqli_error($con);
    }else{
        return $inv;
    }
    
}
/*function confirmLogin (){
    if(!$_SESSION['userID']){
   return header('location:index.php?msg=You Must LogIn First');
}
}
*/
$usid="";
$id="";
 //Get Id of Applicants To Edit
/* function getApplicants_Id($con){
	$query =mysqli_query($con, "SELECT ID From onlineApplications Where RefNum ='120493404148'");
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
 }*/
 
 
//Confirm Credentials Status :

function getCredStatusWithRRR($rrr,$regNum, $con){
    
    $query=mysqli_query($con,"SELECT * FROM Credentials WHERE  RefNumber = '$rrr' AND RegNumber = '$regNum'");
    $fetchdata = mysqli_fetch_assoc($query);
   return $fetchdata;
}

//Confirm Passport  Status :

function getPassportStatusWithRRR($stdID, $rrr,$statu,$con){
    
    $query=mysqli_query($con,"SELECT * FROM OnlineApplications WHERE ID ='$stdID' AND RefNum = '$rrr' AND Status = '$statu'");
    $fetchdata = mysqli_fetch_assoc($query);
   return $fetchdata;
}

//  Get Invoice Details 
function getInvoice($con,$stdID){
   
    $inv =mysqli_query($con,"SELECT * From Invoices Where StudentID ='$stdID'");
    if(!$inv){
        return mysqli_error($con);
    }else{
        while($invs=mysqli_fetch_array($inv)){
           return $invs;
        }
    }
    
}


// Save Generated Invoice
function saveInvoice($stdID,$amount,$payingFor,$orderID,$refNNum,$status,$con){
    
    $query=mysqli_query($con,"INSERT INTO Invoices(StudentID,ServiceType,Amount,RefNum, RefOrderID, InvoiceStatus) VALUES('$stdID','$payingFor','$amount','$refNNum','$orderID','$status')");
    if(!$query){
        return mysqli_error($con);
    }else{
        $msg="Invoice Created Successfully";
    
    }
    return $msg;
}

// update status
function updateInvoice($stdID,$amount,$payingFor,$orderID,$refNNum,$statuspaid,$datapaid,$con){
   $update = "UPDATE `Invoices` SET `InvoiceStatus` = '$statuspaid', `DatePaid` = '$datapaid' WHERE `StudentID` = $stdID AND `RefNum` = $refNNum";
    //$update = "UPDATE `Invoices` SET `InvoiceStatus` = '$statuspaid', `DatePaid` = '$datapaid' WHERE `StudentID` = $stdID AND `ServiceType` = '$payingFor' AND `RefNum` = $refNNum AND `RefOrderID` = $orderID ";
    //$update = "UPDATE `Invoices` SET `InvoiceStatus` = '.$statuspaid.', `DatePaid` = '.$datapaid.' WHERE `StudentID` = '.$stdID.' AND `RefNum` = '.$refNNum.' AND `RefOrderID` = '.$orderID.' ";
    $query=mysqli_query($con, $update);
    if(!$query){
        return mysqli_error($con);
    }elseif($query){
        //$msg = "Invoice Updated Sucessfully"." ".$stdID." ".$amount." ".$payingFor." ".$orderID." ".$refNNum." ".$statuspaid." ".$datapaid;
    $msg = "Invoice Updated Sucessfully";
    }
    return $msg;
}
// get  with type
function getinvoiceWithType($stdID,$status,$type,$con){
    
    $query=mysqli_query($con,"SELECT * FROM Invoices WHERE StudentID ='$stdID' AND InvoiceStatus = '$status' AND ServiceType = '$type'");
    $fetchdata = mysqli_fetch_assoc($query);
   return $fetchdata;
}

// get  with oderId and rrr
function getinvoiceWithOrderidAndRRR($stdID,$rrr,$oderID,$con){
    
    $query=mysqli_query($con,"SELECT * FROM Invoices WHERE StudentID ='$stdID' AND RefNum = '$rrr' AND RefOrderID = '$oderID'");
    $fetchdata = mysqli_fetch_assoc($query);
   return $fetchdata;
}


function getuserdata($user_id,$con){
    
   $query = mysqli_query($con, "SELECT * FROM userAccounts Where ID ='$user_id'");
    $fetchuserdata = mysqli_fetch_assoc($query);
   return $fetchuserdata;
}
// Check If Application Exists For a user

function getAppx($con,$user){
    //$courseID=$courseCode;
    $apx =mysqli_query($con,"SELECT RegNumber From onlineApplications Where Username ='$user'");
    if(!$apx){
        return mysqli_error($con);
    }else{
        $appsx ="";
        while($appxs=mysqli_fetch_array($apx)){
            $appsx=$appxs['RegNumber'];
        }
    }
    return $appsx;
}

 function apiCredential($id, $key){
     $con=mysqli_connect("localhost", "escohsti_portalAdmin","IT;manager","escohsti_studentPortal");
    $data = mysqli_query($con,"SELECT * from ApiCredentials where ID ='$id'");
    $fetchdata = mysqli_fetch_assoc($data);
   return $fetchdata[$key];
}

function ServiceTypeID($ser_id, $key){
     $con=mysqli_connect("localhost", "escohsti_portalAdmin","IT;manager","escohsti_studentPortal");
    $data = mysqli_query($con,"SELECT * from ServiceTypeIDs where ID ='$ser_id'");
    $fetchdata = mysqli_fetch_assoc($data);
   return $fetchdata[$key];
}

?>