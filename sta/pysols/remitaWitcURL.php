<?php
//var apiHash = CryptoJS.SHA512(merchantId+ serviceTypeId+ orderId+totalAmount+apiKey);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https:remitademo.net/echannelsvc/merchant/api/paymentinit',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{ 
	"serviceTypeId": "400647021",
	"amount": "2000",
	"orderId": "654958",
	"payerName": "John Doe",
	"payerEmail": "doe@gmail.com",
	"payerPhone": "09062067384",
	"description": "Payment for Septmeber Fees"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: remitaConsumerKey=4143763381,remitaConsumerToken=798431'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

?>