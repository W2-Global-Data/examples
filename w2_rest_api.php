<?php
// To make use of this script extension=openssl needs to be uncommented out in your php.ini file
// Also a valid CACert is needed locally and values of curl.cainfo and openssl.cafile need to be set to 
// its location locally

// To execute this file run php W2RestApiGist.php

echo "Starting W2 API Call...\r\n";
$url = 'https://api.w2globaldata.com/kyc-check';
// Replace Base64EncodedW2ApiKey with your Base64 Encoded W2ApiKey
$apiKey = 'Basic Base64EncodedW2ApiKey';
$data = array('Bundle' => 'WatchlistCheck', 
              'Data' => array('NameQuery' => 'Kim Jong Un'), 
              'Options' => array('Sandbox' => 'false'),
              'ClientReference' => 'W2RestApiPhpGist');
$jsonData = json_encode($data);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: ' . $apiKey,
    'Content-Type: application/json'
));
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT,100);

$curl_response = curl_exec($ch);

$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if(curl_errno($ch)){
    echo 'Curl error: ' . curl_error($ch);
}

echo 'HTTP code: ' . $httpcode . "\r\n";

// Nicer view of the results
//$jsonResult = json_decode($curl_response);
//var_dump($jsonResult);

// Basic Json Response
var_dump($curl_response);

curl_close($ch);
?>
