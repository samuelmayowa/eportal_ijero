<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "{{baseUrl}}/echannelsvc/merchant/api/paymentinit",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"{ \n\t\"serviceTypeId\": \"{{4006470211}}\",\n\t\"amount\": \"{{30000}}\",\n\t\"orderId\": \"{{CHTADM001}}\",\n\t\"payerName\": \"ADIN IT SUPPORT\",\n\t\"payerEmail\": \"hiimmaculate.ci@gmail.com\",\n\t\"payerPhone\": \"09069674088\",\n\t\"description\": \"Payment for Certificate Fees\"\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: remitaConsumerKey={{4143763381}},remitaConsumerToken={{798431}}"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$rs = json_decode($response, true);
echo $refNum ="Ref Num: " .$rs['RRR'];
echo $refNum ="Ref Num: ". $rs['status'];
?>