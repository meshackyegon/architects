<?php
include_once '../path.php';
include_once  "operations.php";

include_once '../pesapal/token.php';


$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://pay.pesapal.com/v3/api/Transactions/GetTransactionStatus?orderTrackingId=' . $_GET['OrderTrackingId'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token
    ),
));
$response = curl_exec($curl);
curl_close($curl);
$res = json_decode($response);
// var_dump($res);
// var_dump($res->merchant_reference);

// exit;
if ($res->payment_status_description == "Completed") {
    $reference = $res->merchant_reference;
    $arr['payment_status'] = 'paid';
    build_sql_edit('bookings', $arr, $reference, 'reference');

    header("location:../");
} else {
    echo "something went wrong";
}
