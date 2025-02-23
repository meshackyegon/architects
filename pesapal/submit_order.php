<?php
function order($customer_obj, $ref, $amount)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://pay.pesapal.com/v3/api/Auth/RequestToken',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{"consumer_key": "k9/mo3jtrihaJWP6WP6RdKbgWfKFgg+1","consumer_secret": "Yj32MEwmOknf5PBAurNTM29+zeU="}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $token = json_decode($response)->token;

    $arr = array(
        "email_address" => $customer_obj['email'],
        "phone_number" => $customer_obj['phone'],
        "country_code" => "KE",
        "first_name" => $customer_obj['name'],
        "middle_name" => "",
        "last_name" => "Doe",
        "line_1" => "Pesapal Limited",
        "line_2" => "",
        "city" => "",
        "state" => "",
        "postal_code" => "",
        "zip_code" => ""
    );
    $arr = json_encode($arr);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://pay.pesapal.com/v3/api/Transactions/SubmitOrderRequest',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '	{
	    "id": "' . $ref . '",
	    "currency": "KE",
	    "amount": ' . $amount . ',
	    "description": "Payment description goes here",
	    "callback_url": "http://localhost/rentpesa/model/verify.php",
	    "notification_id": "c950b26f-2a5d-48c1-a1b3-df084ee73689",
	    "billing_address": ' . $arr . '
	}',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
