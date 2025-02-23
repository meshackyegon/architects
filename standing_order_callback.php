<?php
include_once 'path.php';
require_once MODEL_PATH . 'operations.php';


function logToFile($message) {
    $logFile = fopen("standing_callback.txt", "a");
    fwrite($logFile, date('Y-m-d H:i:s') . " - " . $message . "\n");
    fclose($logFile);
}

function isJson($string) {
    logToFile("Checking if string is JSON");
    json_decode($string);
    $isJson = json_last_error() === JSON_ERROR_NONE;
    logToFile("Result: " . ($isJson ? "true" : "false"));
    return $isJson;
}

function getRequestBody() {
    logToFile("Getting request body");
    $requestData = [];
    $requestBody = file_get_contents('php://input');
    logToFile("Request body: " . $requestBody);
    if (!empty($requestBody) && isJson($requestBody)) {
        $requestData = json_decode($requestBody, true);
    } elseif (!empty($requestBody) && !isJson($requestBody)) {
        $requestData = $_POST;
    } else {
        $requestData = [];
    }
    logToFile("Request data: " . print_r($requestData, true));
    return $requestData;
}
function msg($status, $code, $message, $data = [])
{
    logToFile("Computing: Sending message");
    http_response_code($code);
    $response = [
        'status' => $status,       
        'code' => $code,
        'message' => $message,
        'data' => $data
    ];
    logToFile("Response: " . print_r($response, true));
    echo json_encode($response);
    exit;
}

logToFile("Standing order callback function started");
    
header('Content-Type: application/json');
$requestBody = getRequestBody();

if (empty($requestBody)) {
    logToFile("Request body is empty");
    msg(false, 400, 'The request body is empty!');
}

    $responseHeader = $requestBody['responseHeader'] ?? [];
    $responseBody = $requestBody['responseBody'] ?? [];

    if (empty($responseHeader) || empty($responseBody)) {
        logToFile("Missing responseHeader or responseBody");
        msg(false, 400, 'Invalid request structure');
    }

    $orderId = $responseHeader['requestRefID'] ?? '';
    $responseCode = $responseHeader['responseCode'] ?? '';
    $responseDescription = $responseHeader['responseDescription'] ?? '';

    $transactionId = '';
    $msisdn = '';
    $status = '';

    foreach ($responseBody['responseData'] as $data) {
        switch ($data['name']) {
            case 'TransactionID':
                $transactionId = $data['value'];
                break;
            case 'Msisdn':
                $msisdn = $data['value'];
                break;
            case 'Status':
                $status = $data['value'];
                break;
        }
    }

    // // Fetch the user_id and amount from the existing request table
    // $sql = "SELECT user_id, request_amount FROM request WHERE request_id = ?";
    // $stmt = prepare_stmt($sql);
    // $stmt->bind_param('s', $orderId);
    // $stmt->execute();
    // $result = $stmt->get_result();
    // $row = $result->fetch_assoc();

    // if (!$row) {
    //     logToFile("No matching request found for order_id: $orderId");
    //     msg(false, 404, 'No matching request found');
    // }

    // $userId = $row['user_id'];
    // $amount = $row['request_amount'];

    // Insert the standing order information into the database
   
    $arrr['order_id'] = $orderId;
    $arrr['reference'] = $orderId;
    $arrr['status'] = $status;
    $arrr['transaction_id'] = $transactionId;
    $arrr['msisdn'] = $msisdn;
    $arrr['response_code'] = $responseCode;
    $arrr['response_description'] = $responseDescription;

    if (build_sql_insert("standing_order", $arrr)) {
        logToFile("Standing order information stored successfully");
        msg(true, 200, 'Standing order information stored successfully', [
            'order_id' => $orderId,
            'status' => $status,
            'transaction_id' => $transactionId
        ]);
    } else {
        logToFile("Error storing standing order information");
        msg(false, 500, 'Error storing standing order information');
    }
