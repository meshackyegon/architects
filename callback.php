<?php
include_once 'path.php';
require_once MODEL_PATH . 'operations.php';

function logToFile($message) {
    $logFile = fopen("stk_callback_log.txt", "a");
    fwrite($logFile, date('Y-m-d H:i:s') . " - " . $message . "\n");
    fclose($logFile);
}

function isJson($string) {
    logToFile("Checking if string is JSON");
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
}

function getRequestBody() {
    logToFile("Getting request body");
    $requestBody = file_get_contents('php://input');
    logToFile("Request body: " . $requestBody);
    
    if (!empty($requestBody) && isJson($requestBody)) {
        return json_decode($requestBody, true);
    } elseif (!empty($_POST)) {
        return $_POST;
    }
    return [];
}

function msg($status, $code, $message, $data = []) {
    logToFile("Response: " . json_encode(compact('status', 'code', 'message', 'data')));
    http_response_code($code);
    echo json_encode(compact('status', 'code', 'message', 'data'));
    exit;
}

logToFile("STK Push callback function started");

header('Content-Type: application/json');
$requestBody = getRequestBody();

if (empty($requestBody)) {
    logToFile("Request body is empty");
    msg(false, 400, 'The request body is empty!');
}

// Extract STK Callback response
$stkCallback = $requestBody['Body']['stkCallback'] ?? null;

if (!$stkCallback) {
    logToFile("Missing STK Callback data");
    msg(false, 400, 'Invalid request structure');
}

$merchantRequestID = $stkCallback['MerchantRequestID'] ?? '';
$checkoutRequestID = $stkCallback['CheckoutRequestID'] ?? '';
$resultCode = $stkCallback['ResultCode'] ?? '';
$resultDesc = $stkCallback['ResultDesc'] ?? '';

$paymentStatus = ($resultCode == 0) ? "Success" : "Failed";
$amount = 0;
$mpesaReceiptNumber = null;
$transactionDate = null;
$phoneNumber = null;


if ($resultCode == 0 && isset($stkCallback['CallbackMetadata']['Item'])) {
    foreach ($stkCallback['CallbackMetadata']['Item'] as $item) {
        switch ($item['Name']) {
            case "Amount":
                $amount = $item['Value'];
                break;
            case "MpesaReceiptNumber":
                $mpesaReceiptNumber = $item['Value'];
                break;
            case "TransactionDate":
                $transactionDate = date("Y-m-d H:i:s", strtotime($item['Value']));
                break;
            case "PhoneNumber":
                $phoneNumber = $item['Value'];
                break;
        }
    }
}
$status='paid';
$arr['mpesa_receipt_number']=$mpesaReceiptNumber;
$arr['checkoutRequestID']=$checkoutRequestID;
$arr['transaction_date']=$transactionDate;
$arr['phone_number']=$phoneNumber;
$arr['payment_status']= $status;
if (build_sql_edit("payments", $arr, $checkoutRequestID, 'checkoutRequestID')) {
    logToFile("Payment information updated successfully");
    msg(true, 200, 'Payment information stored successfully', $paymentData);
    // $return_url = tenant_url . 'index';
} else {
    logToFile("Error updating payment information");
    msg(false, 500, 'Error updating payment information');
}

?>
