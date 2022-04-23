<?php
include_once('../functions.php');
require_once('../connection.php');



if(isset($_GET['user']) && isset($_GET['rrr']) || isset($_GET['orderId'])){
$sha_value =  $orderID = $apiKey = "";

$rrr = $_GET['rrr'];
$seletFromID = 2;
$MerchantID = apiCredential($seletFromID, 'MerchantID');
//$ServiceTypeID = apiCredential($seletFromID, 'ServiceTypeID');
$ser_id = 2;
$ServiceTypeID = ServiceTypeID($ser_id, 'Value');
$ApiKey = apiCredential($seletFromID, 'ApiKey');
$base_url = apiCredential($seletFromID, 'base_url');
$academic_session = apiCredential($seletFromID, 'session_value');
 //$hash_value =hash("sha512",$rrr.'/'.$orderID.$ApiKey.$MerchantID);
$hash_value =hash("sha512",$rrr.$ApiKey.$MerchantID);
//$hash_value =hash("sha512",$MerchantID.$ServiceTypeID.$orderID.$amount.$ApiKey);
if($_GET['orderId']){
    $_SESSION['orderID'] = $orderID = $_GET['orderId']; 
}else{
    $orderID = rand(10000,100000000000);
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "{$base_url}/{$MerchantID}/{$rrr}/{$hash_value}/status.reg",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    "Authorization: remitaConsumerKey=$MerchantID,remitaConsumerToken=".$hash_value 
  ),
));

$response = curl_exec($curl);

curl_close($curl);
    $update = json_decode($response);
    $paymentment_time = $update->transactiontime;
    $statusCode = $update->status;
    $user_id = $_SESSION['user_id'];
    $amountPaid = $amount = $update->amount;
    if($update->orderId){
        $orderID = $update->orderId;
    }else{
        $orderID = rand(10000,100000000000);
    }
    $refNNum = $update->RRR;
    $statuspaid = $update->message;
    $matricID =$_SESSION['userID'];
        $query3="SELECT firstName, middleName, lastName, stateOfOrigin, studentLevel, Citizenship FROM students WHERE matricNumber='$matricID'";
        $query3 = mysqli_query($con, $query3) or die (mysqli_error($con));
        while ($userdata = mysqli_fetch_array($query3)){
                
                $CourseName=$userdata['firstName'];
                $CourseCode= $userdata['middleName'];
                $CourseUnits = $userdata ['lastName'];
                $faculty = $userdata['stateOfOrigin'];
                $level =$userdata['studentLevel'] ;
                $citizenship =$userdata['Citizenship'];
                                                              
    }
    
    $matric_no = $matricID;
   $return = array();
    $paymentCategoryData = getPayment_categories($citizenship,$level,'School Fees',$con);
   $payingFor = $paymentCategoryData['payCategories'];
   $fixed_amount = $paymentCategoryData['Amount'];
   // $rrdata = getinvoiceWithOrderidAndRRR($user_id,$refNNum,$orderID,$con);

if(!empty($statusCode ) && $statusCode == '00' && $statuspaid == 'Successful'){
     $datapaid = $update->paymentDate;
    
    if(empty(check_rrrExist($rrr,$matric_no,$con)) && empty(checkother_rrrExist($rrr,$matric_no,$con))){
        $response9 = saveRRRData($matric_no,$payingFor,$amount,$refNNum,$orderID,$fixed_amount,$datapaid,$statuspaid,$level,$academic_session,$con);
    
        if($response9 == 'Invoice Created Successfully'){
            $return['message'] = 'Payment successful and approved';
            session_start();
            $_SESSION['RRR'] = $rrr;
            $_SESSION['DESC'] = $payingFor;
            $_SESSION['AMT'] = $amount;
            $_SESSION['ORDER_ID'] = $orderID;
            $_SESSION['DATE'] = $datapaid;
            $_SESSION['SESSION'] = $academic_session;
            $return['check'] = $_SESSION['check'] = true;
            echo json_encode($return);
        }
    }else{
        $return['message'] = 'RRR '.$rrr.', already exist in our database, processed to reprint receipt';
        echo json_encode($return);
    }
    
    //echo $orderID;
}elseif(!empty($statusCode ) && $statusCode == '01' && $statuspaid == 'Successful'){
    
     $datapaid = $update->paymentDate;
    if(empty(check_rrrExist($rrr,$matric_no,$con)) && empty(checkother_rrrExist($rrr,$matric_no,$con))){
        $response9 = saveRRRData($matric_no,$payingFor,$amount,$refNNum,$orderID,$fixed_amount,$datapaid,$statuspaid,$level,$academic_session,$con);
    
        if($response9 == 'Invoice Created Successfully'){
            $return['message'] = 'Payment successful and approved';
            session_start();
            $_SESSION['RRR'] = $rrr;
            $_SESSION['DESC'] = $payingFor;
            $_SESSION['AMT'] = $amount;
            $_SESSION['ORDER_ID'] = $orderID;
            $_SESSION['DATE'] = $datapaid;
            $return['check'] = $_SESSION['check'] = true;
            $_SESSION['SESSION'] = $academic_session;
            echo json_encode($return);
        }
    }else{
        $return['message'] = 'RRR '.$rrr.', already exist in our database, processed to reprint receipt';
        echo json_encode($return);
    }
    
    //echo $orderID;
}elseif($statusCode == '02'){
    $update = json_decode($response);
    $paymentment_time = $update->transactiontime;
    $statusCode = $update->status;
    $amountPaid = $amount = $update->amount;
    $orderID = $update->orderId;
    $refNNum = $update->RRR;
    $statuspaid = $update->message;
    $return['message'] = $statuspaid;
    echo json_encode($return);
}else{
    $update = json_decode($response);
    $paymentment_time = $update->transactiontime;
    $statusCode = $update->status;
    $amountPaid = $amount = $update->amount;
    $orderID = $update->orderId;
    $refNNum = $update->RRR;
    $statuspaid = $update->message;
    
    if($statuspaid == 'Transaction Pending'){
        $return['message'] = 'Payment not successful';
        echo json_encode($return);
    }else{
        $return['message'] = $statuspaid;
        echo json_encode($return);
    }
}



//echo json_decode($response)->status;


}elseif(isset($_GET['user']) && isset($_GET['rrr']) && isset($_GET['statusGet']) && isset($_GET['statusCodeGet'])){
    
$sha_value =  $orderID = $apiKey = "";
$statusGet = $_GET['statusGet'];
$statusCodeGet = $_GET['statusCodeGet'];
$rrr = $_GET['rrr'];
$seletFromID = 2;
$MerchantID = apiCredential($seletFromID, 'MerchantID');
//$ServiceTypeID = apiCredential($seletFromID, 'ServiceTypeID');
$ser_id = 2;
$ServiceTypeID = ServiceTypeID($ser_id, 'Value');
$ApiKey = apiCredential($seletFromID, 'ApiKey');
$base_url = apiCredential($seletFromID, 'base_url');
$academic_session = apiCredential($seletFromID, 'session_value');
 
$hash_value =hash("sha512",$rrr.$ApiKey.$MerchantID);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "{$base_url}/{$MerchantID}/{$rrr}/{$hash_value}/status.reg",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    "Authorization: remitaConsumerKey=$MerchantID,remitaConsumerToken=".$hash_value 
  ),
));

$response = curl_exec($curl);

curl_close($curl);
    $update = json_decode($response);
    $paymentment_time = $update->transactiontime;
    $statusCode = $update->status;
    $user_id = $_SESSION['user_id'];
    $amountPaid = $amount = $update->amount;
    $payingFor ="2021/2022 Application Form";
    $orderID = $update->orderId;
    $refNNum = $update->RRR;
    $statuspaid = $update->message;
   
    $matricID =$_SESSION['userID'];
        $query3="SELECT firstName, middleName, lastName, stateOfOrigin, studentLevel, Citizenship FROM students WHERE matricNumber='$matricID'";
        $query3 = mysqli_query($con, $query3) or die (mysqli_error($con));
        while ($userdata = mysqli_fetch_array($query3)){
                
                $CourseName=$userdata['firstName'];
                $CourseCode= $userdata['middleName'];
                $CourseUnits = $userdata ['lastName'];
                $faculty = $userdata['stateOfOrigin'];
                $level =$userdata['studentLevel'] ;
                $citizenship =$userdata['Citizenship'];
                                                              
    }
    
    $matric_no = $matricID;
    $return = array();
    
    $paymentCategoryData = getPayment_categories($citizenship,$level,'School Fees',$con);
   $payingFor = $paymentCategoryData['payCategories'];
   $fixed_amount = $paymentCategoryData['Amount'];
   // $rrdata = getinvoiceWithOrderidAndRRR($user_id,$refNNum,$orderID,$con);

if(!empty($statusCode ) && $statusCode == '00' && $statuspaid == 'Successful'){
     $datapaid = $update->paymentDate;
    
    if(empty(check_rrrExist($rrr,$matric_no,$con)) && empty(checkother_rrrExist($rrr,$matric_no,$con))){
        $response9 = saveRRRData($matric_no,$payingFor,$amount,$refNNum,$orderID,$fixed_amount,$datapaid,$statuspaid,$level,$academic_session,$con);
    
        if($response9 == 'Invoice Created Successfully'){
            $return['message'] = 'Payment successful and approved';
            session_start();
            $_SESSION['RRR'] = $rrr;
            $_SESSION['DESC'] = $payingFor;
            $_SESSION['AMT'] = $amount;
            $_SESSION['ORDER_ID'] = $orderID;
            $_SESSION['DATE'] = $datapaid;
            $_SESSION['SESSION'] = $academic_session;
            $return['check'] = $_SESSION['check'] = true;
            echo json_encode($return);
        }
    }else{
        $return['message'] = 'RRR '.$rrr.', already exist in our database, processed to reprint receipt';
        echo json_encode($return);
    }
    
    //echo $orderID;
}elseif(!empty($statusCode ) && $statusCode == '01' && $statuspaid == 'Successful'){
    
     $datapaid = $update->paymentDate;
    if(empty(check_rrrExist($rrr,$matric_no,$con)) && empty(checkother_rrrExist($rrr,$matric_no,$con))){
        $response9 = saveRRRData($matric_no,$payingFor,$amount,$refNNum,$orderID,$fixed_amount,$datapaid,$statuspaid,$level,$academic_session,$con);
    
        if($response9 == 'Invoice Created Successfully'){
            $return['message'] = 'Payment successful and approved';
            session_start();
            $_SESSION['RRR'] = $rrr;
            $_SESSION['DESC'] = $payingFor;
            $_SESSION['AMT'] = $amount;
            $_SESSION['ORDER_ID'] = $orderID;
            $_SESSION['DATE'] = $datapaid;
            $_SESSION['SESSION'] = $academic_session;
            $return['check'] = $_SESSION['check'] = true;
            echo json_encode($return);
        }
    }else{
        $return['message'] = 'RRR '.$rrr.', already exist in our database, processed to reprint receipt';
        echo json_encode($return);
    }
    
    //echo $orderID;
}elseif($statusCode == '02'){
    $update = json_decode($response);
    $paymentment_time = $update->transactiontime;
    $statusCode = $update->status;
    $amountPaid = $amount = $update->amount;
    $orderID = $update->orderId;
    $refNNum = $update->RRR;
    $statuspaid = $update->message;
    $return['message'] = $statuspaid;
    echo json_encode($return);
    
}else{
    $update = json_decode($response);
    $paymentment_time = $update->transactiontime;
    $statusCode = $update->status;
    $amountPaid = $amount = $update->amount;
    $orderID = $update->orderId;
    $refNNum = $update->RRR;
    $statuspaid = $update->message;
    
    if($statuspaid == 'Transaction Pending'){
        $return['message'] = 'Payment not successful';
        echo json_encode($return);
    }else{
        $return['message'] = $statuspaid;
        echo json_encode($return);
    }
}



//echo json_decode($response)->status;


}else{
    header('location:login.php');
}