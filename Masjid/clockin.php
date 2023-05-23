<?php
$request_body = file_get_contents('php://input');
$curl = curl_init();
curl_setopt($curl, CURLOPT_POST, true);
if($_GET['rekod'] == 1) curl_setopt($curl, CURLOPT_URL, "https://mysejahtera.malaysia.gov.my/clockin_dua");
else curl_setopt($curl, CURLOPT_URL, "https://mysejahtera.malaysia.gov.my/clockin");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $request_body);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type:application/json')
);
$result = curl_exec($curl);
$info = curl_getinfo($curl);
curl_close($curl);
$obj = json_decode($result, true);
foreach ($info as $key => $val) ${'cURL_'.$key} = $val;
if($_GET['rekod'] == 1) http_response_code(200);
else http_response_code($cURL_http_code);
?>