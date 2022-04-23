<?php 
include_once('../functions.php');
require_once('../connection.php');
$amount="";
$fname="";
$email="";
$amt="";
$phone="";
$descr="";
if(isset($_GET['user'])){

$amount = $_GET['amt'];
if($_GET['desc'] == 'School_Fees'){
     $descr = 'School Fees';
}
$user_username_session = $_GET['user'];
if($user_username_session){
    $user_data = mysqli_query($con, "SELECT * FROM students Where matricNumber ='$user_username_session'");
    $fetch_user_data = mysqli_fetch_assoc($user_data);
    $name = $fetch_user_data['lastName'].' '.$fetch_user_data['firstName'].' '.$fetch_user_data['middleName'];
    $phone = $fetch_user_data['stdPhoneNumber'];
    $email = $fetch_user_data['studentEmail'];
    
}
$descr="2021/2022 Application Form";
$sha_value =  $orderID = $apiKey = "";
$seletFromID = 2;
$MerchantID = apiCredential($seletFromID, 'MerchantID');
//$ServiceTypeID = apiCredential($seletFromID, 'ServiceTypeID');
$ser_id = 3;
$ServiceTypeID = ServiceTypeID($ser_id, 'Value');
$ApiKey = apiCredential($seletFromID, 'ApiKey');
$base_url = apiCredential($seletFromID, 'base_url');

$amt = $amount;
 $orderID=rand(10000000000,999999999999999).$MerchantID;
 $orderid_t = "OrderID: " . $orderID ."<br />";
$hash_value =hash("sha512",$MerchantID.$ServiceTypeID.$orderID.$amount.$ApiKey);
$curl = curl_init();
 $_SESSION['orderID'] = $orderID;
curl_setopt_array($curl, array(
  CURLOPT_URL => "{$base_url}/merchant/api/paymentinit",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{ 
    "serviceTypeId": '.$ServiceTypeID.',
	"amount": '.$amt.',
	"orderId": '.$orderID.',
	"payerName": "'.$name.'",
	"payerEmail": "'.$email.'",
	"payerPhone": "'.$phone.'",
	"description": "'.$descr.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    "Authorization: remitaConsumerKey=$MerchantID,remitaConsumerToken=".$hash_value 
  ),
));

$response = curl_exec($curl);
//echo $response;

 $resp= json_decode($response, true);

curl_close($curl);

echo $response;

}else{
    header('location:index.php');
}
