<?php

use PhpOffice\PhpSpreadsheet\Reader\Csv;

require_once '../../path.php';
require_once MODEL_PATH . "operations.php";
include_once('../../PHPSpreadSheet/vendor/autoload.php');
// var_dump($_POST);
$action = (isset($_GET['action']) && $_GET['action'] != '') ? security('action', 'GET') : '';
// var_dump($action);
if (!csrf_verify(security('csrf_token'))) render_warning(admin_url);
unset($_POST['csrf_token']);
// var_dump($_POST);
switch ($action) {
    case 'user_edit':
        post_user_edit();
        break;
    case 'architect_edit':
        post_architect_edit();
        break;
    case 'assign_architect':
        assign_architect();
        break;

       
    case 'structural_edit':
        post_structural_edit();
        break;
    case 'electrical_edit':
        post_electrical_edit();
        break;
        
    case 'mechanical_edit':
        post_mechanical_edit();
        break;
    case 'user_password':
        post_user_password();
        break;
    case 'mechanical_login':
        get_mechanical_login();
        break;
    case 'admin_login':
        get_admin_login();
        break;
    case 'electrical_login':
        get_electrical_login();
        break;
        
    case 'structural_login':
        get_structural_login();
        break;

        // structural_login
    case 'user_login':
        get_user_login();
        break;
    case 'architect_login':
        get_architect_login();
        break;
    case 'landlord_login':
        get_landlord_login();
        break;
    case 'landlord':
        post_landlord();
        break;
    case 'project':
        post_project();
        break;
    case 'architect':
        post_architect();
        break;
    case 'electrical':
        post_electrical();
        break;
        
    case 'landlord_register':
        landlord_register();
        break;
    case 'architect_register':
        architect_register();
        break;
    case 'structural_register':
        structural_register();
        break;
     case 'mechanical_register':
        mechanical_register();
        break;
    case 'electrical_register':
        electrical_register();
        break;
    case 'image':
        post_image();
        break;
    case 'banner':
        post_banner();
        break;
    case 'inquiry':
        post_inquiry();
        break;
    case 'property':
        post_property();
        break;
    case 'service':
        post_service();
        break;
    case 'booking':
        post_booking();
        break;
    case 'booking2':
        post_booking2();
        break;
    case 'user':
        post_tenant();
        break;
    case 'csv':
        post_csv();
        break;
    case 'units':
        post_units();
        break;
    case 'payment':
        post_payment();
        break;
    case 'edit_units':
        edit_units();
        break;
    case 'edit_amenities':
        edit_amenities();
        break;
    case 'edit_landlord':
        edit_landlord();
        break;
    case 'edit_architect':
        edit_architect();
        break;
    case 'edit_mechanical':
        edit_mechanical();
        break;
    case 'edit_structural':
        edit_structural();
        break;
    case 'edit_electrical':
        edit_electrical();
        break;
        
    case 'landlord_profile':
        landlord_profile();
        break;
    case 'landlord_password':
        landlord_password();
        break;
    case 'houses':
        edit_houses();
        break;
    case 'reset':
        post_password_reset();
        break;
    case 'register':
        post_user($_GET['from']);
        break;
    case 'book_visit':
        post_visit();
        break;
    case 'simple':
        post_simple($_GET['table'], $_GET['url']);
        break;
}

function post_simple($table, $url)
{
    global $arr;
    global $error;
    global $success;
    $return_url = admin_url . $url;


    for_loop();


    $param = '';
    if (isset($_SESSION['edit'])) {
        $param = "?id=" . encrypt($_SESSION['edit']);
    }

    if (!empty($error)) {
        $url = $return_url . $param;
        error_checker($url);
    }

    if (isset($_SESSION['edit'])) {
        $id = $_SESSION['edit'];
        unset($_SESSION['edit']);

        if (!build_sql_edit($table, $arr, $id, $table . '_id')) {
            $error[$table] = 149;
            error_checker($return_url . '   ?id=' . encrypt($id));
        }

        $success[$table] = 221;
        render_success($return_url . '?id=' .  encrypt($id));
    }

    $id = $arr[$table . '_id'] = create_id($table, $table . '_id');

    if (!build_sql_insert($table, $arr)) {
        $error[$table] = 150;
        error_checker($return_url);
    }

    $success[$table] = 220;
    render_success($return_url . '?id=' .  encrypt($id));
}

function post_image()
{
    global $arr;
    global $error;
    global $success;

    if (isset($_SESSION['admin_id'])) {
        $return_url = admin_url .  "view_properties";
    }
    if (isset($_SESSION['landlord_id'])) {
        $return_url = landlord_url .  "view_properties";
    }

    $arr['property_id'] = $_POST['property_id'];

    if (!empty($_FILES['property_image_1']['name']))    $arr['property_image_1']    = upload('property_image_1');
    if (!empty($_FILES['property_image_2']['name']))    $arr['property_image_2']    = upload('property_image_2');
    if (!empty($_FILES['property_image_4']['name']))    $arr['property_image_4']    = upload('property_image_4');
    if (!empty($_FILES['property_image_3']['name']))    $arr['property_image_3']    = upload('property_image_3');
    if (!empty($_FILES['property_image_5']['name']))    $arr['property_image_5']    = upload('property_image_5');
    if (!empty($_FILES['property_image_6']['name']))    $arr['property_image_6']    = upload('property_image_6');
    if (!empty($_FILES['property_image_7']['name']))    $arr['property_image_7']    = upload('property_image_7');
    if (!empty($_FILES['property_image_8']['name']))    $arr['property_image_8']    = upload('property_image_8');
    if (!empty($_FILES['property_image_9']['name']))    $arr['property_image_9']    = upload('property_image_9');
    if (!empty($_FILES['property_image_10']['name']))   $arr['property_image_10']   = upload('property_image_10');



    if (isset($_SESSION['edit'])) {
        $id = $_SESSION['edit'];
        unset($_SESSION['edit']);

        if (!empty($arr['property_image_1']))   delete_file('property_image_1',   'property_image', 'property_image_id');
        if (!empty($arr['property_image_2']))   delete_file('property_image_2',   'property_image', 'property_image_id');
        if (!empty($arr['property_image_4']))  delete_file('property_image_4',  'property_image', 'property_image_id');
        if (!empty($arr['property_image_3'])) delete_file('property_image_3', 'property_image', 'property_image_id');
        if (!empty($arr['property_image_5']))   delete_file('property_image_5',   'property_image', 'property_image_id');
        if (!empty($arr['property_image_6']))   delete_file('property_image_6',   'property_image', 'property_image_id');
        if (!empty($arr['property_image_7']))  delete_file('property_image_7',  'property_image', 'property_image_id');
        if (!empty($arr['property_image_8'])) delete_file('property_image_8', 'property_image', 'property_image_id');
        if (!empty($arr['property_image_9']))   delete_file('property_image_9',   'property_image', 'property_image_id');
        if (!empty($arr['property_image_10']))   delete_file('property_image_10',   'property_image', 'property_image_id');


        if (!build_sql_edit('property_image', $arr, $id, 'property_image_id')) {
            $error['image'] = 132;
            error_checker($return_url);
        }

        $success['image'] = 206;
        render_success($return_url);
    }

    $arr['property_image_id'] = create_id('property_image', 'property_image_id');

    if (!build_sql_insert('property_image', $arr)) {
        $error['image'] = 134;
        error_checker($return_url);
    }

    $success['image'] = 205;
    render_success($return_url);
}



function post_payment()
{
    global $arr;
    global $error;
    global $success;
    $return_url = tenant_url . "view_payments";

    // cout($_POST);
    for_loop();

    $arr['payment_id'] = create_id('payment', 'payment_id');

    if (!build_sql_insert('payment', $arr)) {
        $error['view_payments'] = 154;
        error_checker($return_url);
    }

    $success['view_payments'] = 225;
    render_success($return_url);
}
function post_visit()
{
    global $arr;
    global $error;
    global $success;
    $return_url = tenant_url . "view_payments";

    for_loop();

    $arr['payment_id'] = create_id('payment', 'payment_id');
    $phone = $arr['user_phone'];
    $uid = $arr['user_id'];
    $rent = $arr['amount'];
    $id =  $arr['project_id'];
    $response = stk_push_payment($rent, $phone, $uid);
    // cout($response);
    $response = json_decode($response, true);

    // Check if standing order creation was successful
    if (!isset($response['ResponseCode']) || $response['ResponseCode'] != "0") {
        $error['stk_push'] = 104;
        $error_message = isset($response['ResponseDescription']) ? 
        $response['ResponseDescription'] : 'Failed to initiate STK Push';
        error_checker($return_url . 'book_visit?id=' . encrypt($id) . '&error=' . urlencode($error_message));
        return; 
    }

    // STK Push was successfully initiated
    $arr['merchantRequestID'] = $response['MerchantRequestID'];
    $arr['checkoutRequestID'] = $response['CheckoutRequestID'];
    $arr['customerMessage'] = $response['CustomerMessage'];
    if (!build_sql_insert('payments', $arr)) {
        $error['view_payments'] = 104;
        error_checker(tenant_url . 'book_visit?id=' . encrypt($id) . '&error=' . urlencode('Failed to insert request'));
        return;  
    }
    $success["cooperative"] = 202;
    render_success($return_url);

}

function post_user_edit()
{
    global $arr;
    global $error;
    global $success;
    $return_url = tenant_url . 'profile';
    $success_url = tenant_url . 'profile';


    if (!empty($_FILES['user_image']['name']))
        $arr['user_image'] = upload('user_image');
    if (empty($_FILES['user_image']['name']) && isset($_POST['existing_user_image'])) {
        $arr['user_image'] = $_POST['existing_user_image'];
    }
    unset($_POST['existing_user_image']);


    for_loop();


    $id = $_POST['user_id'];

    if (!build_sql_edit('user', $arr, $id, 'user_id')) {
        $error["cooperative"] = 138;
        error_checker($return_url);
    }

    $success["cooperative"] = 202;
    render_success($return_url);
}
function post_architect_edit()
{
    global $arr;
    global $error;
    global $success;
    $return_url = architects_url . 'profile';
    $success_url = architects_url . 'profile';


    if (!empty($_FILES['architect_image']['name']))
        $arr['architect_image'] = upload('architect_image');
    if (empty($_FILES['architect_image']['name']) && isset($_POST['existing_architect_image'])) {
        $arr['architect_image'] = $_POST['existing_architect_image'];
    }
    unset($_POST['existing_architect_image']);


    for_loop();


    $id = $_POST['architect_id'];

    if (!build_sql_edit('architect', $arr, $id, 'architect_id')) {
        $error["cooperative"] = 138;
        error_checker($return_url);
    }

    $success["cooperative"] = 202;
    render_success($return_url);
}
function post_electrical_edit()
{
    global $arr;
    global $error;
    global $success;
    $return_url = electrical_url . 'profile';
    $success_url = electrical_url . 'profile';


    if (!empty($_FILES['electrical_image']['name']))
        $arr['electrical_image'] = upload('electrical_image');
    if (empty($_FILES['electrical_image']['name']) && isset($_POST['existing_electrical_image'])) {
        $arr['electrical_image'] = $_POST['existing_electrical_image'];
    }
    unset($_POST['existing_electrical_image']);


    for_loop();


    $id = $_POST['electrical_id'];

    if (!build_sql_edit('electrical', $arr, $id, 'electrical_id')) {
        $error["cooperative"] = 138;
        error_checker($return_url);
    }

    $success["cooperative"] = 202;
    render_success($return_url);
}
function post_mechanical_edit()
{
    global $arr;
    global $error;
    global $success;
    $return_url = mechanical_url . 'profile';
    $success_url = mechanical_url . 'profile';


    if (!empty($_FILES['mechanical_image']['name']))
        $arr['mechanical_image'] = upload('mechanical_image');
    if (empty($_FILES['mechanical_image']['name']) && isset($_POST['existing_mechanical_image'])) {
        $arr['mechanical_image'] = $_POST['existing_mechanical_image'];
    }
    unset($_POST['existing_mechanical_image']);


    for_loop();


    $id = $_POST['mechanical_id'];

    if (!build_sql_edit('mechanical', $arr, $id, 'mechanical_id')) {
        $error["cooperative"] = 138;
        error_checker($return_url);
    }

    $success["cooperative"] = 202;
    render_success($return_url);
}
function post_structural_edit()
{
    global $arr;
    global $error;
    global $success;
    $return_url = structural_url . 'profile';
    $success_url = structural_url . 'profile';


    if (!empty($_FILES['structural_image']['name']))
        $arr['structural_image'] = upload('structural_image');
    if (empty($_FILES['structural_image']['name']) && isset($_POST['existing_structural_image'])) {
        $arr['structural_image'] = $_POST['existing_structural_image'];
    }
    unset($_POST['existing_structural_image']);


    for_loop();


    $id = $_POST['structural_id'];

    if (!build_sql_edit('structural', $arr, $id, 'structural_id')) {
        $error["cooperative"] = 138;
        error_checker($return_url);
    }

    $success["cooperative"] = 202;
    render_success($return_url);
}
function post_user_password()
{
    global $arr;
    global $error;
    global $success;
    $return_url = tenant_url . 'password.php';

    $new_password = security('user_password');
    $confirm_password = security('confirm_password');

    // cout($_POST);

    $user = get_by_id('user', $_SESSION['user_id']);

    if ($new_password != $confirm_password) {
        $error['user'] = 145;
        error_checker($return_url);
    }

    $arr['user_password'] = password_hashing_hybrid_maker_checker($new_password);

    if (!build_sql_edit('user', $arr, $user['user_id'], 'user_id')) {
        $error["cooperative"] = 138;
        error_checker($return_url);
    }

    $success["cooperative"] = 202;
    render_success($return_url);
}

function post_banner()
{
    global $arr;
    global $error;
    global $success;
    $return_url = admin_url . "view_banners";

    if (!empty($_FILES['banner_poster']['name']))    $arr['banner_poster']   = upload('banner_poster');

    for_loop();

    if (!empty($error)) {
        error_checker($return_url);
    }


    if (isset($_SESSION['edit'])) {
        $id = $_SESSION['edit'];
        unset($_SESSION['edit']);

        if (!empty($arr['poster']))   delete_file('banner_poster',   'banner', 'banner_id');


        if (!build_sql_edit('banner', $arr, $id, 'banner_id')) {
            $error['view_banners'] = 153;
            error_checker($return_url);
        }

        $success['view_banners'] = 224;
        render_success($return_url);
    }

    $arr['banner_id'] = create_id('banner', 'banner_id');

    if (!build_sql_insert('banner', $arr)) {
        $error['view_banners'] = 154;
        error_checker($return_url);
    }

    $success['view_banners'] = 225;
    render_success($return_url);
}

function post_booking()
{
    global $arr;
    global $error;
    global $success;
    $return_url = tenant_url . "index?suc";

    // for_loop();

    // cout($_POST);
    $_POST['start_date'] = '6';
    $email = security('user_email');
    $sql = "SELECT * FROM user WHERE user_email = '$email' ";
    $row = select_rows($sql)[0];

    if (!empty($row)) {
        $user_id = $row['user_id'];
    } else {
        $array  = array(
            'user_email'        => $email,
            'user_name'         => security('user_name'),
            'user_kra'         => security('user_kra'),
            'user_phone'         => security('user_phone'),
            'kin_phone'         => security('kin_phone'),
            'kin_name'         => security('kin_name'),
            'user_dob'         => security('user_dob'),
            'user_passport'         => security('user_passport'),
            'property_id'         => security('property_id')
        );
        // $arr['user_name'] 
        $array['user_id']   = create_id('user', 'user_id');
        $array['user_password']   = password_hashing_hybrid_maker_checker('1234');

        if (!build_sql_insert('user', $array)) {
            $error['user'] = 139;
            error_checker($return_url);
        }

        $session_login  = array(
            'user_login'        => true,
            'user_email'        => $email,
            'user_name'         => $array['user_name'],
            'user_id'           => $array['user_id'],
            'success'           => array('login' => 204)
        );

        session_assignment($session_login);
    }


    $arr['booking_id'] = create_id('booking', 'booking_id');
    $arr['user_id'] = $user_id;
    $arr['property_id'] = security('property_id');
    $arr['property_unit_id'] = security('property_unit_id');
    $arr['booking_check_in'] = security('check_in');
    $arr['starting_from'] = '2024-06-06';
    $arr['preferred_date'] = date('d', strtotime($arr['starting_from']));
    if (!build_sql_insert('booking', $arr)) {
        $error['view_bookings'] = 154;
        error_checker($return_url);
    }

    $success['view_bookings'] = 227;
    render_success($return_url);
}

function paybill_standing_order($rent, $phone, $uid, $starting_from, $end_date)
{
    // First cURL request to get the access token
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sandbox.safaricom.co.ke/oauth2/v1/generate?grant_type=client_credentials',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic WWpYOHZyV2ExVlc5UWFZM1VqQW5WZGlBMTVhMkJsa3pHSmNvdk0zbFBQYWk3ZHZvOjN2RnNIS21Yd0IwTWk2cE84RjhvNXBtbFZhY0o3NHFFRHdnb1dNMG85S1lLQWVVamNLejBldUcyMU5MYWxDZTI=',
            'Cookie: incap_ses_1040_2742146=42RiFUz+Z3PzDlkAntJuDgUX22YAAAAAgEu9AiIB8z4SHJW5Lg0Zvg==; visid_incap_2742146=UlO1Xh5EQwy3gYiZObiJgGig2WYAAAAAQUIPAAAAAADCIB5rLhMvXmHz4rA1J6R1'
        ),
    ));

    $token_response = curl_exec($curl);
    curl_close($curl);

    // Parse the JSON response to get the access token
    $token_data = json_decode($token_response, true);
    $access_token = $token_data['access_token'] ?? '';

    if (empty($access_token)) {
        // Handle error: unable to get access token
        return json_encode(['error' => 'Unable to get access token']);
    }

    // Second cURL request to create the standing order
    $data = [
        "StandingOrderName" => "RENTPESA RENT PAYMENT",
        "BusinessShortCode" => "4119835",
        "TransactionType" => "Standing Order Customer Pay Bill",
        "Amount" => $rent,
        "PartyA" => $phone,
        "ReceiverPartyIdentifierType" => "4",
        "CallBackURL" => "https://webhook.site/e210a221-fbb4-4ec5-bd0d-086afe397c09",
        //"CallBackURL" => "https://rentpesa.com/standing_order_callback.php",
        "AccountReference" => $uid,
        "TransactionDesc" => "Rent Payment",
        "Frequency" => "5",
        "StartDate" => $starting_from,
        "EndDate" => $end_date
    ];
    // cout($data);
    // exit;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sandbox.safaricom.co.ke/standingorder/v1/createStandingOrderExternal',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'X-Source-System: dxl-ms-starter- mapped by apigee, not exposed externally',
            'X-Correlation-ConversationID: ffc2f5f4-4ec1-4468-8f30-3238648b7d47',
            'X-Source-System: API-EXTERNAL',
            'X-App: dxl',
            'Accept: application/json',
            'x-source-timestamp: 2021-09-29 12:39:22',
            'x-msisdn: 254725297723**',
            'x-source-division: DE',
            'x-messageid: 93777w7hdkuueuuwsiidiiei7783@',
            'x-deviceinfo: 93777w7hdkuueuuwsiidiiei7783@',
            'x-source-countrycode: ke',
            'x-api-key: OWqwCWWp1w9FlWBWUOnOv5F5hLmWDdQs7rvS9IsS',
            'x-deviceid: cdvasc0bvnbda',
            'x-source-operator: mysafaricom',
            'x-devicetoken: eyJraWQiOiJxKzhTdEwrVXoyR3cxVmpXdXd3VlVTaXJFY3NHZU9iWFp4',
            'x-version: 1y:OWqwCWWp1w9FlWBWUOnOv5F5hLmWDdQs7rvS9IsS',
            'X-Content-Type-Options: nosniff',
            'X-Frame-Options: deny',
            'content-security-policy: default-src \'none\'',
            'Content-Type: application/json',
            'x-source-msisdn: 254725297723',
            'Authorization: Bearer ' . $access_token,
            'Cookie: incap_ses_1040_2742146=42RiFUz+Z3PzDlkAntJuDgUX22YAAAAAgEu9AiIB8z4SHJW5Lg0Zvg==; visid_incap_2742146=UlO1Xh5EQwy3gYiZObiJgGig2WYAAAAAQUIPAAAAAADCIB5rLhMvXmHz4rA1J6R1; b24c6d4b7474117e03f467b43fc0585a=5a3be420591abf79b5c4ac4f82050d3d'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}
function stk_push_payment($rent, $phone, $uid)
{
   
    $consumerKey = "6ESTZxev4Gba5AFQMQQz0e2j1nYku0WWrZulGMsJPgRqvL1x"; 
    $consumerSecret = "JPP48K3zch4HFF0oJoxkDbUFY2G3jCOT6nsHsS4R4ILeLJLViXhz82Dl0kHwiRy8";
    $credentials = base64_encode($consumerKey . ":" . $consumerSecret);

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            "Authorization: Basic $credentials"
        ),
    ));

    $token_response = curl_exec($curl);
    curl_close($curl);

    $token_data = json_decode($token_response, true);
    $access_token = $token_data['access_token'] ?? '';

    if (empty($access_token)) {
        return json_encode(['error' => 'Unable to get access token']);
    }

 
    $BusinessShortCode = "174379"; 
    $PassKey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919"; 
    $Timestamp = date("YmdHis");
    $Password = base64_encode($BusinessShortCode . $PassKey . $Timestamp);
    $CallbackURL = "https://domysuma.compassionaid.org/callback.php"; 

    $stk_push_data = [
        "BusinessShortCode" => $BusinessShortCode,
        "Password" => $Password,
        "Timestamp" => $Timestamp,
        "TransactionType" => "CustomerPayBillOnline",
        "Amount" => $rent,
        "PartyA" => $phone,
        "PartyB" => $BusinessShortCode,
        "PhoneNumber" => $phone,
        "CallBackURL" => $CallbackURL,
        "AccountReference" => $uid,
        "TransactionDesc" => "Book Visit Payment"
    ];

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($stk_push_data),
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $access_token",
            "Content-Type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}
function post_booking2()
{
    global $arr;
    global $error;
    global $success;
    $return_url = base_url;

    $id = security('property_id');
    $uid = security('user_id');
    $phone = get_by_id("user", $uid)['user_phone'];

    $arr['request_id'] = create_id('request', 'request_id');
    $arr['user_id'] = $uid;
    $arr['property_id'] = $id;
    $arr['property_unit_id'] = security('property_unit_id');
    $arr['request_check_in'] = security('check_in');
    $arr['end_date'] = security('end_date');
    $arr['starting_from'] = security('start_date');
    $arr['preferred_date'] = date('d', strtotime($arr['starting_from']));
    $end_date = date('Ymd', strtotime($arr['end_date']));
    $starting_from = date('Ymd', strtotime($arr['starting_from']));
    $rent = (int) security('amount_figures');
    $arr['amount_figures'] = $rent;

    // Step 1: Create Standing Order
    $response = paybill_standing_order($rent, $phone, $uid, $starting_from, $end_date);
    $response = json_decode($response, true);

    // Check if standing order creation was successful
    if (!isset($response['ResponseBody']['responseCode']) || $response['ResponseBody']['responseCode'] != 200) {
        $error['view_bookings'] = 104;
        $error_message = isset($response['ResponseBody']['responseDescription']) ?
            $response['ResponseBody']['responseDescription'] : 'Failed to create standing order';
        error_checker(base_url . 'booking?id=' . encrypt($id) . '&error=' . urlencode($error_message));
        return;  // Stop execution if standing order creation failed
    }

    // Step 2: Insert into request table
    if (!build_sql_insert('request', $arr)) {
        $error['view_bookings'] = 104;
        error_checker(base_url . 'booking?id=' . encrypt($id) . '&error=' . urlencode('Failed to insert request'));
        return;  // Stop execution if insertion failed
    }

    // Step 3: Fetch property and user details
    $sql = "SELECT * FROM property WHERE property_id = '$id' ";
    $row = select_rows($sql)[0];
    $sql2 = "SELECT * FROM user WHERE user_id = '$uid' ";
    $row2 = select_rows($sql2)[0];

    // Step 4: Handle landlord notification (if not admin)
    if ($row['added_by'] != 'admin') {
        $landlord = get_by_id('landlord', $row['added_by']);
        $email = $landlord['landlord_email'];
        $subject = APP_NAME . ' Tenant Request';
        $name = APP_NAME;

        $body = '<p style="font-family:Poppins, sans-serif;"> ';
        $body .= 'Hello, <b>' . $landlord['landlord_name'] . '</b> <br>';
        $body .= 'A user has requested to be onboarded onto your property. The details are as follows:';
        $body .= '</p>';
        $body .= '<p style="font-family:Poppins, sans-serif;"> ';
        $body .= '<b>PROPERTY NAME:</b> ' . $row['property_name'];
        $body .= '</p>';
        $body .= '<p style="font-family:Poppins, sans-serif;"> ';
        $body .= '<b>USER NAME:</b> ' . $row2['user_name'];
        $body .= '</p>';
        $body .= '<p style="font-family:Poppins, sans-serif;"> ';
        $body .= '<b>USER EMAIL:</b> ' . $row2['user_email'];
        $body .= '</p>';
        $body .= '<p style="font-family:Poppins, sans-serif;"> ';
        $body .= '<b>PHONE NUMBER:</b> ' . $row2['user_phone'];
        $body .= '</p>';
        $body .= '<p style="font-family:Poppins, sans-serif;"> ';
        $body .= '<b>HAS THE USER BEEN IN RENT PESA BEFORE:</b> ' . 'No';
        $body .= '</p>';
        $body .= '<p style="font-family:Poppins, sans-serif;"> ';
        $body .= 'Log in to your user dashboard here: <a href=" ' . landlord_url . ' ">' . landlord_url . '</a>';
        $body .= '</p>';

        email($email, $subject, $name, $body);

        $text4 = "A user has requested to be onboarded onto your property. Kindly check your email to view the details.";
        // send_an_sms($landlord['landlord_phone'], $text4);
    }

    // Step 5: Set success message and redirect
    $success['view_bookings'] = 227;
    render_success(base_url . 'success');
}

function post_user($url)
{
    global $arr;
    global $error;
    global $success;

    $return_url = base_url . $url;

    for_loop();
    $id = $arr['user_id']   = create_id('user', 'user_id');
    $arr['user_password']   = password_hashing_hybrid_maker_checker($arr['user_password']);

    if (!build_sql_insert('user', $arr)) {
        $error['user'] = 139;
        error_checker($return_url);
    }

    $session_login  = array(
        'user_login'        => true,
        'user_email'        => $arr['user_email'],
        'user_name'         => $arr['user_name'],
        'user_id'           => $arr['user_id'],
        'success'           => array('login' => 204)
    );

    session_assignment($session_login);


    $success['user'] = 203;
    render_success($return_url);
}

function detectDateFormat($date)
{
    $formats = array(
        'd/m/Y',
        'm/d/Y',
        'Y/m/d',

    );
    foreach ($formats as $format) {
        $d = DateTime::createFromFormat($format, $date);
        if ($d && $d->format($format) === $date) {
            return $format;
        }
    }
    return false;
}

function post_csv()
{
    if ($_POST['added_by'] == 'admin') {
        $return_url = admin_url . 'view_users';
    } else {
        $return_url = landlord_url . 'view_users';
    }

    $reader = new Csv();
    $spreadsheet = $reader->load($_FILES['tenants_csv']['tmp_name']);
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();
    $columns = array_shift($rows);


    foreach ($rows as $row) {
        $arr = array();
        foreach ($columns as $index => $column) {
            if ($column == 'user_dob') {

                $format = detectDateFormat($row[$index]);
                if ($format) {

                    $date = DateTime::createFromFormat($format, $row[$index]);
                    $arr[$column] = $date ? $date->format('Y-m-d') : null;
                } else {
                    $arr[$column] = $row[$index];
                }
            } else {


                $arr[$column] = $row[$index];
            }
        }

        $arr['property_id'] = security('property_id');
        $arr['added_by'] = $_POST['added_by'];
        $arr['user_password']   = password_hashing_hybrid_maker_checker("123456");
        $arr['user_image'] = 'default.png';
        $arr['user_id']        = create_id('user', 'user_id');

        if (!build_sql_insert('user', $arr)) {
            $error['user'] = 140;
            error_checker($return_url);
        }

        $email      = $arr['user_email'];
        $subject    = APP_NAME . ' User Onboarding';
        $name       = APP_NAME;
        $body       = '<p style="font-family:Poppins, sans-serif;"> ';
        $body       .= 'Hello, <b>' . $arr['user_name'] . '</b> <br>';
        $body       .= 'You have been successfully onboarded as a <b>' . $name . '</b> user';
        $body       .= 'Log in to your user dashboard here: <a href=" ' . tenant_url . ' ">' . tenant_url . '</a>';
        $body       .= '</p>';

        //email($email, $subject, $name, $body);


        $text4 = "Welcome " . $arr['user_name'] . " to RentPesa. You have successfully signed up as a user.";
        send_an_sms($arr['user_phone'], $text4);
    }


    header("Location: $return_url?success=Uploaded successfully!");
}

function post_tenant()
{
    global $arr;
    global $error;
    global $success;

    if ($_POST['added_by'] == 'admin') {
        $return_url = admin_url . 'view_users';
    } else {
        $return_url = landlord_url . 'view_users';
    }

    for_loop();

    $arr['user_password']       = password_hashing_hybrid_maker_checker('1234');


    $arr['user_id']        = create_id('user', 'user_id');
    $id                     = $arr['user_id'];


    if (!build_sql_insert('user', $arr)) {
        $error['user'] = 140;
        error_checker($return_url);
    }

    $array['password_token_id'] = create_id('password_token', 'password_token_id');
    $array['password_token'] = generateRandomString();
    $array['user_key'] = $id;
    build_sql_insert('password_token', $array);



    $email      = $arr['user_email'];
    $subject    = APP_NAME . ' User Onboarding';
    $name       = APP_NAME;
    $body       = '<p style="font-family:Poppins, sans-serif;"> ';
    $body       .= 'Hello, <b>' . $arr['user_name'] . '</b> <br>';
    $body       .= 'You have been successfully onboarded as a <b>' . $name . '</b> user';
    $body       .= 'Set your user password here: <a href=" ' . base_url . 'password_reset?id=' . encrypt($id) . ' "> CLICK TO SET PASSWORD </a>';
    $body       .= 'Use <b>' . $array['password_token'] . '</b> as the unique token to log in. <br> ';
    $body       .= '</p>';

    email($email, $subject, $name, $body);


    $text4 = "Welcome " . $arr['user_name'] . " to RentPesa. You have been successfully signed up as a user. Check your email for your account details.";
    send_an_sms($arr['user_phone'], $text4);


    $success['user'] = 203;
    render_success($return_url);
}

function post_service()
{
    global $arr;
    global $error;
    global $success;
    $return_url = admin_url . 'view_services';


    for_loop();

    if (!empty($_FILES['service_image']['name'])) $arr['service_image'] = upload('service_image');

    if (isset($_SESSION['edit'])) {
        $id = $_SESSION['edit'];
        if (!empty($arr['service_image'])) delete_file('service_image', 'service', 'service_id', $id);

        unset($_SESSION['edit']);

        if (!build_sql_edit('service', $arr, $id, 'service_id')) {
            $error['service'] = 133;
            error_checker($return_url);
        }

        $success['service'] = 202;
        render_success($return_url);
    }

    $id = $arr['service_id']    = create_id('service', 'service_id');

    if (!build_sql_insert('service', $arr)) {
        $error['service'] = 139;
        error_checker($return_url);
    }

    $success['service'] = 203;
    render_success($return_url);
}

function post_property()
{
    global $arr;
    global $error;
    global $success;
    if ($_POST['added_by'] == 'admin') {
        $return_url = admin_url . 'view_properties';
    } else {
        $return_url = landlord_url . 'view_properties';
    }


    if (isset($_POST['regulation_id'])) {
        $arr['regulation_id'] = implode(",", $_POST['regulation_id']);
        unset($_POST['regulation_id']);
    }

    if (isset($_POST['property_bedrooms'])) {
        $arr['property_bedrooms'] = implode(",", $_POST['property_bedrooms']);
        unset($_POST['property_bedrooms']);
    }

    // cout($_POST);

    // for_loop();
    $conn = connect();

    if (isset($_POST['property_price']) && $_POST['property_price'] !== '') {
        $arr['property_price'] = security('property_price');
    } else {
        $arr['property_price'] = 0;
    }

    $fields_to_check = array(
        'property_units',
        'one_bedroom',
        'two_bedroom',
        'bedsitter',
        'ground_floor',
        'property_garbage',
        'property_water',
        'property_vacant',
        'due',
        'has_unit',
        'added_by',
        'property_city',
        'property_location',
        'property_policy',
        'property_bathrooms',
        'property_description',
        'property_stay',
        'property_name',
        'property_type'
    );

    foreach ($fields_to_check as $field) {
        if (isset($_POST[$field]) && $_POST[$field] !== '') {
            $arr[$field] = security($field);
        }
    }



    if (!empty($_FILES['property_image']['name'])) $arr['property_image'] = upload('property_image');
    if (!empty($_FILES['property_image2']['name'])) $arr['property_image2'] = upload('property_image2');


    $arr['property_id'] = create_id('property', 'property_id');

    if (!build_sql_insert('property', $arr)) {
        $error['property'] = 139;
        error_checker($return_url);
    }


    foreach ($_POST['amenities_id'] as $key => $val) {
        $featuresArray['features_id'] = create_id('features', 'features_id');
        $featuresArray['amenities_id'] = mysqli_real_escape_string($conn, $val);
        $featuresArray['property_id'] = $arr['property_id'];
        build_sql_insert("features", $featuresArray);
    }

    $success['property'] = 203;
    render_success($return_url);
}



function edit_property()
{
    global $arr;
    global $error;
    global $success;
    $return_url = admin_url . 'property_details?id=';
    $id = security('property_id');
    unset($_POST['property_id']);

    if (!empty($_FILES['property_image']['name'])) $arr['property_image'] = upload('property_image');
    if (!empty($_FILES['property_image2']['name'])) $arr['property_image2'] = upload('property_image2');

    $conn = connect();

    if (isset($_POST['property_price']) && $_POST['property_price'] !== '') {
        $arr['property_price'] = security('property_price');
    } else {
        $arr['property_price'] = 0;
    }

    $fields_to_check = array(
        'property_units',
        'one_bedroom',
        'two_bedroom',
        'bedsitter',
        'ground_floor',
        'property_garbage',
        'property_water',
        'property_vacant',
        'due',
        'has_unit',
        'added_by',
        'property_city',
        'property_location',
        'property_policy',
        'property_bathrooms',
        'property_description',
        'property_stay',
        'property_name',
        'property_type'
    );

    foreach ($fields_to_check as $field) {
        if (isset($_POST[$field]) && $_POST[$field] !== '') {
            $arr[$field] = security($field);
        }
    }





    if (!empty($arr['property_image'])) delete_file('property_image', 'property', 'property_id');
    if (!empty($arr['property_image2'])) delete_file('property_image2', 'property', 'property_id');


    if (!build_sql_edit('property', $arr, $id, 'property_id')) {
        $error['property'] = 133;
        error_checker($return_url);
    }

    $success['property'] = 202;
    render_success($return_url . encrypt($id));
}

function post_units()
{
    global $arr;
    global $error;
    global $success;
    $return_url = admin_url . 'view_properties';

    // cout($_POST);

    $conn = connect();

    $valueClasses = $_POST['property_unit'];

    foreach ($valueClasses as $valueClass) {
        $valueClassData = array(
            'property_unit_id' => create_id('property_unit', 'property_unit_id'),
            'property_id' => security('property_id'),
            'property_unit_name' => mysqli_real_escape_string($conn, $valueClass['property_unit_name']),
            'property_unit_type' => mysqli_real_escape_string($conn, $valueClass['property_unit_type']),
            'property_unit_price' => mysqli_real_escape_string($conn, $valueClass['property_unit_price'])
        );

        build_sql_insert("property_unit", $valueClassData);
    }

    $success['property'] = 203;
    render_success($return_url);
}

function edit_units()
{
    global $arr;
    global $error;
    global $success;

    if (isset($_SESSION['admin_id'])) {
        $return_url = admin_url . 'property_details?id=';
    }
    if (isset($_SESSION['landlord_id'])) {
        $return_url = landlord_url . 'property_details?id=';
    }

    // cout($_POST);
    $conn = connect();

    $id = security('property_id');
    $sql = "delete from property_unit where property_id = '$id'";
    insert_delete_edit($sql);
    $valueClasses = $_POST['property_unit'];

    foreach ($valueClasses as $valueClass) {
        $valueClassData = array(
            'property_unit_id' => create_id('property_unit', 'property_unit_id'),
            'property_id' => $id,
            'property_unit_name' => mysqli_real_escape_string($conn, $valueClass['property_unit_name']),
            'property_unit_type' => mysqli_real_escape_string($conn, $valueClass['property_unit_type']),
            'property_unit_price' => mysqli_real_escape_string($conn, $valueClass['property_unit_price'])
        );

        build_sql_insert("property_unit", $valueClassData);
    }

    $success['property'] = 203;
    render_success($return_url . encrypt($id));
}

function edit_amenities()
{
    global $arr;
    global $error;
    global $success;

    if (isset($_SESSION['admin_id'])) {
        $return_url = admin_url . 'property_details?id=';
    }
    if (isset($_SESSION['landlord_id'])) {
        $return_url = landlord_url . 'property_details?id=';
    }

    $conn = connect();
    $id = security('property_id');
    $sql = "delete from features where property_id = '$id'";
    insert_delete_edit($sql);
    foreach ($_POST['amenities_id'] as $key => $val) {
        $arr['features_id'] = create_id('features', 'features_id');
        $arr['amenities_id'] = mysqli_real_escape_string($conn, $val);
        $arr['property_id'] = security('property_id');
        build_sql_insert("features", $arr);
    }

    $success['property'] = 203;
    render_success($return_url . encrypt($id));
}
function post_architect()
{
    global $arr;
    global $error;
    global $success;
    $return_url = admin_url . 'view_architects';

    if (isset($_POST['property_id'])) {
        $arr['property_id'] = implode(",", $_POST['property_id']);
        unset($_POST['property_id']);
    }


    // cout($_POST);
    $password = $_POST['architect_password'];

    for_loop();

    $arr['architect_password']       = password_hashing_hybrid_maker_checker($_POST['architect_password']);


    $arr['architect_id']        = create_id('architect', 'architect_id');
    $id                     = $arr['architect_id'];


    if (!build_sql_insert('architect', $arr)) {
        $error['architect'] = 140;
        error_checker($return_url);
    }

    $email      = $arr['architect_email'];
    $subject    = APP_NAME . ' architect Onboarding';
    $name       = APP_NAME;
    $body       = '<p style="font-family:Poppins, sans-serif;"> ';
    $body       .= 'Hello, <b>' . $arr['architect_name'] . '</b> <br>';
    $body       .= 'You have been successfully onboarded as a <b>' . $name . '</b> architect';
    $body       .= 'Use <b>' . $password . '</b> as the password to log into the link below <br> ';
    $body       .= 'Log in to your user dashboard here: <a href=" ' . architects_url . ' ">' . architects_url . '</a>';
    $body       .= '</p>';

    email($email, $subject, $name, $body);


    $text4 = "Welcome " . $arr['architect_name'] . " to RentPesa. You have successfully signed up as a architect.";
    send_an_sms($arr['architect_phone'], $text4);

    $success['architect'] = 207;
    render_success($return_url);
}
function post_project()
{
    session_start(); // Ensure session is started
    global $arr;
    global $error;
    global $success;
    $return_url = tenant_url . 'view_projects';
   

    if (isset($_POST['property_id'])) {
        $arr['property_id'] = implode(",", $_POST['property_id']);
        unset($_POST['property_id']);
    }
    if (!isset($_SESSION['user_id'])) {
       $return_url = base_url . 'login';
       $error['project'] = 1163;
    }
    // if (isset($_POST['bungalow_features']) && is_array($_POST['bungalow_features'])) {
    //     $arr['bungalow_features'] = json_encode($_POST['bungalow_features']); // Store as JSON
    // }
    // cout($_POST);
    for_loop(); 
    $arr['user_id'] = $_SESSION['user_id'];
    $arr['project_id'] = create_id('project', 'project_id');

    

    
    if (!build_sql_insert('project', $arr)) {
        $error['project'] = 140;
        error_checker($return_url);
    } else {
        $success['project'] = 207;
        render_success($return_url);
    }
    
}
function post_electrical()
{
    global $arr;
    global $error;
    global $success;
    $return_url = admin_url . 'view_electricals';

    if (isset($_POST['property_id'])) {
        $arr['property_id'] = implode(",", $_POST['property_id']);
        unset($_POST['property_id']);
    }


    // cout($_POST);
    $password = $_POST['electrical_password'];

    for_loop();

    $arr['electrical_password']       = password_hashing_hybrid_maker_checker($_POST['electrical_password']);


    $arr['electrical_id']        = create_id('electrical', 'electrical_id');
    $id                     = $arr['electrical_id'];


    if (!build_sql_insert('electrical', $arr)) {
        $error['electrical'] = 140;
        error_checker($return_url);
    }

    $email      = $arr['electrical_email'];
    $subject    = APP_NAME . ' electrical Onboarding';
    $name       = APP_NAME;
    $body       = '<p style="font-family:Poppins, sans-serif;"> ';
    $body       .= 'Hello, <b>' . $arr['electrical_name'] . '</b> <br>';
    $body       .= 'You have been successfully onboarded as a <b>' . $name . '</b> electrical';
    $body       .= 'Use <b>' . $password . '</b> as the password to log into the link below <br> ';
    $body       .= 'Log in to your user dashboard here: <a href=" ' . electrical_url . ' ">' . electrical_url . '</a>';
    $body       .= '</p>';

    email($email, $subject, $name, $body);


    $text4 = "Welcome " . $arr['electrical_name'] . " to RentPesa. You have successfully signed up as a electrical.";
    send_an_sms($arr['electrical_phone'], $text4);

    $success['electrical'] = 207;
    render_success($return_url);
}

function post_landlord()
{
    global $arr;
    global $error;
    global $success;
    $return_url = admin_url . 'view_landlords';

    if (isset($_POST['property_id'])) {
        $arr['property_id'] = implode(",", $_POST['property_id']);
        unset($_POST['property_id']);
    }


    // cout($_POST);
    $password = $_POST['landlord_password'];

    for_loop();

    $arr['landlord_password']       = password_hashing_hybrid_maker_checker($_POST['landlord_password']);


    $arr['landlord_id']        = create_id('landlord', 'landlord_id');
    $id                     = $arr['landlord_id'];


    if (!build_sql_insert('landlord', $arr)) {
        $error['landlord'] = 140;
        error_checker($return_url);
    }

    $email      = $arr['landlord_email'];
    $subject    = APP_NAME . ' Landlord Onboarding';
    $name       = APP_NAME;
    $body       = '<p style="font-family:Poppins, sans-serif;"> ';
    $body       .= 'Hello, <b>' . $arr['landlord_name'] . '</b> <br>';
    $body       .= 'You have been successfully onboarded as a <b>' . $name . '</b> landlord';
    $body       .= 'Use <b>' . $password . '</b> as the password to log into the link below <br> ';
    $body       .= 'Log in to your user dashboard here: <a href=" ' . landlord_url . ' ">' . landlord_url . '</a>';
    $body       .= '</p>';

    email($email, $subject, $name, $body);


    $text4 = "Welcome " . $arr['landlord_name'] . " to RentPesa. You have successfully signed up as a landlord.";
    send_an_sms($arr['landlord_phone'], $text4);

    $success['landlord'] = 207;
    render_success($return_url);
}
function assign_architect() {
    global $arr;
    global $error;
    global $success;
    $return_url = architects_url . 'assign_engineer';

    if (!isset($_POST['project_id']) || empty($_POST['project_id'])) {
        $error['project_assignment'] = "Project ID is required.";
        error_checker($return_url);
        return;
    }

    $project_id = $_POST['project_id'];

    if (isset($_POST['property_id'])) {
        $arr['property_id'] = implode(",", $_POST['property_id']);
        unset($_POST['property_id']);
    }

    // Check if the project already has an assigned architect
    $existing_assignment = get_by_field('project_assignment', 'project_id', $project_id);
    // cout($existing_assignment);

    if ($existing_assignment) {
        $table_id = $existing_assignment['assign_id'];

        // If senior architect is assigned, update the junior architect
        if (!empty($existing_assignment['senior_architect_id']) && empty($existing_assignment['junior_architect_id'])) {
            for_loop();
          

            if (!build_sql_edit('project_assignment', $arr, $table_id, 'assign_id')) {
                $error['project_assignment'] = "Failed to update junior architect.";
                error_checker($return_url . '?id=' . encrypt($project_id));
                return;
            }

            $success['project_assignment'] = "Junior architect assigned successfully.";
            render_success($return_url . '?id=' . encrypt($project_id));
            return;
        }

        $error['project_assignment'] = "This project already has both a senior and a junior architect.";
        error_checker($return_url . '?id=' . encrypt($project_id));
        return;
    }

    for_loop();

    // Assign unique ID for project assignment
    $arr['assign_id'] = create_id('project_assignment', 'assign_id');

    // Insert new assignment if no architect is assigned yet
    if (!build_sql_insert('project_assignment', $arr)) {
        $error['project_assignment'] = 140;
        error_checker($return_url . '?id=' . encrypt($project_id));
        return;
    }

    $success['project_assignment'] = "Senior architect assigned successfully.";
    render_success($return_url . '?id=' . encrypt($project_id));
}




function architect_register()
{
    global $arr;
    global $error;
    global $success;

    for_loop();

    $arr['architect_password']       = password_hashing_hybrid_maker_checker($_POST['architect_password']);

    // $arr['architect_id']        = create_id('architect', 'architect_id');
    $id = $arr['architect_id']   = create_id('architect', 'architect_id');
    // cout($arr['architect_id']);
    
    // // $id                     = $arr['architect_id'];
    $password = $_POST['architect_password'];


    if (!build_sql_insert('architect', $arr)) {
        $error['architect'] = 140;
        error_checker(base_url . 'architect_register');
    }


    $session_login  = array(
        'architect_login'    => true,
        'architect_email'    => $arr['architect_email'],
        'architect_name'     => $arr['architect_name'],
        'architect_id'       => $arr['architect_id'],
        'success'           => array('login' => 204)
    );

    session_assignment($session_login);

    $email      = $arr['architect_email'];
    $subject    = APP_NAME . ' Architect Onboarding';
    $name       = APP_NAME;
    $body       = '<p style="font-family:Poppins, sans-serif;"> ';
    $body       .= 'Hello, <b>' . $arr['architect_name'] . '</b> <br>';
    $body       .= 'You have been successfully onboarded as a <b>' . $name . '</b> architect';
    $body       .= 'Use <b>' . $password . '</b> as the password to log into the link below <br> ';
    $body       .= 'Log in to your user dashboard here: <a href=" ' . architects_url . ' ">' . architects_url . '</a>';
    $body       .= '</p>';

    email($email, $subject, $name, $body);


    $text4 = "Welcome to Domysuma Architects! Your registration as a architect is being processed. Please wait for admin activation to start using your account. You may check the email you used to sign up for further details. Thank you!";
    send_an_sms($arr['architect_phone'], $text4);

    $success['architect'] = 207;
    render_success(architects_url);
}
function electrical_register()
{
    global $arr;
    global $error;
    global $success;

    for_loop();

    $arr['electrical_password']       = password_hashing_hybrid_maker_checker($_POST['electrical_password']);

    // $arr['architect_id']        = create_id('architect', 'architect_id');
    $id = $arr['electrical_id']   = create_id('electrical', 'electrical_id');
    // cout($arr['architect_id']);
    
    // // $id                     = $arr['architect_id'];
    $password = $_POST['electrical_password'];


    if (!build_sql_insert('electrical', $arr)) {
        $error['electrical'] = 140;
        error_checker(base_url . 'electrical_register');
    }


    $session_login  = array(
        'electrical_login'    => true,
        'electrical_email'    => $arr['electrical_email'],
        'electrical_name'     => $arr['electrical_name'],
        'electrical_id'       => $arr['electrical_id'],
        'success'           => array('login' => 204)
    );

    session_assignment($session_login);

    $email      = $arr['electrical_email'];
    $subject    = APP_NAME . ' Architect Onboarding';
    $name       = APP_NAME;
    $body       = '<p style="font-family:Poppins, sans-serif;"> ';
    $body       .= 'Hello, <b>' . $arr['electrical_name'] . '</b> <br>';
    $body       .= 'You have been successfully onboarded as a <b>' . $name . '</b> architect';
    $body       .= 'Use <b>' . $password . '</b> as the password to log into the link below <br> ';
    $body       .= 'Log in to your user dashboard here: <a href=" ' . electrical_url . ' ">' . electrical_url . '</a>';
    $body       .= '</p>';

    email($email, $subject, $name, $body);


    $text4 = "Welcome to Domysuma Architects! Your registration as a architect is being processed. Please wait for admin activation to start using your account. You may check the email you used to sign up for further details. Thank you!";
    send_an_sms($arr['electrical_phone'], $text4);

    $success['electrical'] = 207;
    render_success(electrical_url);
}
function mechanical_register()
{
    global $arr;
    global $error;
    global $success;

    for_loop();

    $arr['mechanical_password']       = password_hashing_hybrid_maker_checker($_POST['mechanical_password']);

    // $arr['architect_id']        = create_id('architect', 'architect_id');
    $id = $arr['mechanical_id']   = create_id('mechanical', 'mechanical_id');
    // cout($arr['architect_id']);
    
    // // $id                     = $arr['architect_id'];
    $password = $_POST['mechanical_password'];


    if (!build_sql_insert('mechanical', $arr)) {
        $error['mechanical'] = 140;
        error_checker(base_url . 'mechanical_register');
    }


    $session_login  = array(
        'mechanical_login'    => true,
        'mechanical_email'    => $arr['mechanical_email'],
        'mechanical_name'     => $arr['mechanical_name'],
        'mechanical_id'       => $arr['mechanical_id'],
        'success'           => array('login' => 204)
    );

    session_assignment($session_login);

    $email      = $arr['mechanical_email'];
    $subject    = APP_NAME . ' Architect Onboarding';
    $name       = APP_NAME;
    $body       = '<p style="font-family:Poppins, sans-serif;"> ';
    $body       .= 'Hello, <b>' . $arr['mechanical_name'] . '</b> <br>';
    $body       .= 'You have been successfully onboarded as a <b>' . $name . '</b> architect';
    $body       .= 'Use <b>' . $password . '</b> as the password to log into the link below <br> ';
    $body       .= 'Log in to your user dashboard here: <a href=" ' . mechanical_url . ' ">' . mechanical_url . '</a>';
    $body       .= '</p>';

    email($email, $subject, $name, $body);


    $text4 = "Welcome to Domysuma Architects! Your registration as a architect is being processed. Please wait for admin activation to start using your account. You may check the email you used to sign up for further details. Thank you!";
    send_an_sms($arr['mechanical_phone'], $text4);

    $success['mechanical'] = 207;
    render_success(mechanical_url);
}
function structural_register()
{
    global $arr;
    global $error;
    global $success;

    for_loop();

    $arr['structural_password']       = password_hashing_hybrid_maker_checker($_POST['structural_password']);

    // $arr['architect_id']        = create_id('architect', 'architect_id');
    $id = $arr['structural_id']   = create_id('structural', 'structural_id');
    // cout($arr['architect_id']);
    
    // // $id                     = $arr['architect_id'];
    $password = $_POST['structural_password'];


    if (!build_sql_insert('structural', $arr)) {
        $error['structural'] = 140;
        error_checker(base_url . 'structural_register');
    }


    $session_login  = array(
        'structural_login'    => true,
        'structural_email'    => $arr['structural_email'],
        'structural_name'     => $arr['structural_name'],
        'structural_id'       => $arr['structural_id'],
        'success'           => array('login' => 204)
    );

    session_assignment($session_login);

    $email      = $arr['structural_email'];
    $subject    = APP_NAME . ' Architect Onboarding';
    $name       = APP_NAME;
    $body       = '<p style="font-family:Poppins, sans-serif;"> ';
    $body       .= 'Hello, <b>' . $arr['structural_name'] . '</b> <br>';
    $body       .= 'You have been successfully onboarded as a <b>' . $name . '</b> architect';
    $body       .= 'Use <b>' . $password . '</b> as the password to log into the link below <br> ';
    $body       .= 'Log in to your user dashboard here: <a href=" ' . structural_url . ' ">' . structural_url . '</a>';
    $body       .= '</p>';

    email($email, $subject, $name, $body);


    $text4 = "Welcome to Domysuma Architects! Your registration as a architect is being processed. Please wait for admin activation to start using your account. You may check the email you used to sign up for further details. Thank you!";
    send_an_sms($arr['structural_phone'], $text4);

    $success['structural'] = 207;
    render_success(structural_url);
}
function landlord_register()
{
    global $arr;
    global $error;
    global $success;

    for_loop();

    $arr['landlord_password']       = password_hashing_hybrid_maker_checker($_POST['landlord_password']);

    $arr['landlord_id']        = create_id('landlord', 'landlord_id');
    $id                     = $arr['landlord_id'];
    $password = $_POST['landlord_password'];


    if (!build_sql_insert('landlord', $arr)) {
        $error['landlord'] = 140;
        error_checker(base_url . 'landlord_register');
    }


    $session_login  = array(
        'landlord_login'    => true,
        'landlord_email'    => $arr['landlord_email'],
        'landlord_name'     => $arr['landlord_name'],
        'landlord_id'       => $arr['landlord_id'],
        'success'           => array('login' => 204)
    );

    session_assignment($session_login);

    $email      = $arr['landlord_email'];
    $subject    = APP_NAME . ' Landlord Onboarding';
    $name       = APP_NAME;
    $body       = '<p style="font-family:Poppins, sans-serif;"> ';
    $body       .= 'Hello, <b>' . $arr['landlord_name'] . '</b> <br>';
    $body       .= 'You have been successfully onboarded as a <b>' . $name . '</b> landlord';
    $body       .= 'Use <b>' . $password . '</b> as the password to log into the link below <br> ';
    $body       .= 'Log in to your user dashboard here: <a href=" ' . landlord_url . ' ">' . landlord_url . '</a>';
    $body       .= '</p>';

    email($email, $subject, $name, $body);


    $text4 = "Welcome to RentPesa! Your registration as a landlord is being processed. Please wait for admin activation to start using your account. You may check the email you used to sign up for further details. Thank you!";
    send_an_sms($arr['landlord_phone'], $text4);

    $success['landlord'] = 207;
    render_success(landlord_url);
}

function edit_landlord()
{
    global $arr;
    global $error;
    global $success;
    $return_url = admin_url . 'landlord_details';

    for_loop();

    if (isset($_SESSION['edit'])) {
        $id = $_SESSION['edit'];
        unset($_SESSION['edit']);

        if (!build_sql_edit('landlord', $arr, $id, 'landlord_id')) {
            $error['landlord'] = 141;
            error_checker($return_url . '   ?id=' . encrypt($id));
        }

        $success['landlord'] = 208;
        render_success($return_url . '?id=' .  encrypt($id));
    }
    $success['landlord'] = 207;
    render_success($return_url);
}
function edit_architect()
{
    global $arr;
    global $error;
    global $success;
    $return_url = admin_url . 'architect_details';

    for_loop();

    if (isset($_SESSION['edit'])) {
        $id = $_SESSION['edit'];
        unset($_SESSION['edit']);

        if (!build_sql_edit('architect', $arr, $id, 'architect_id')) {
            $error['architect'] = 141;
            error_checker($return_url . '   ?id=' . encrypt($id));
        }

        $success['architect'] = 208;
        render_success($return_url . '?id=' .  encrypt($id));
    }
    $success['architect'] = 207;
    render_success($return_url);
}
function edit_mechanical()
{
    global $arr;
    global $error;
    global $success;
    $return_url = admin_url . 'mechanical_details';

    for_loop();

    if (isset($_SESSION['edit'])) {
        $id = $_SESSION['edit'];
        unset($_SESSION['edit']);

        if (!build_sql_edit('mechanical', $arr, $id, 'mechanical_id')) {
            $error['mechanical'] = 141;
            error_checker($return_url . '   ?id=' . encrypt($id));
        }

        $success['mechanical'] = 208;
        render_success($return_url . '?id=' .  encrypt($id));
    }
    $success['mechanical'] = 207;
    render_success($return_url);
}
function edit_structural()
{
    global $arr;
    global $error;
    global $success;
    $return_url = admin_url . 'structural_details';

    for_loop();

    if (isset($_SESSION['edit'])) {
        $id = $_SESSION['edit'];
        unset($_SESSION['edit']);

        if (!build_sql_edit('structural', $arr, $id, 'structural_id')) {
            $error['structural'] = 141;
            error_checker($return_url . '   ?id=' . encrypt($id));
        }

        $success['structural'] = 208;
        render_success($return_url . '?id=' .  encrypt($id));
    }
    $success['structural'] = 207;
    render_success($return_url);
}
function edit_electrical()
{
    global $arr;
    global $error;
    global $success;
    $return_url = admin_url . 'electrical_details';

    for_loop();

    if (isset($_SESSION['edit'])) {
        $id = $_SESSION['edit'];
        unset($_SESSION['edit']);

        if (!build_sql_edit('electrical', $arr, $id, 'electrical_id')) {
            $error['electrical'] = 141;
            error_checker($return_url . '   ?id=' . encrypt($id));
        }

        $success['electrical'] = 208;
        render_success($return_url . '?id=' .  encrypt($id));
    }
    $success['electrical'] = 207;
    render_success($return_url);
}

function landlord_profile()
{
    global $arr;
    global $error;
    global $success;
    $return_url = landlord_url . 'edit_landlord';

    if (!empty($_FILES['landlord_image']['name']))    $arr['landlord_image']    = upload('landlord_image');

    for_loop();

    if (isset($_SESSION['edit'])) {
        $id = $_SESSION['edit'];
        unset($_SESSION['edit']);

        if (!empty($arr['landlord_image']))   delete_file('landlord_image',  'landlord', 'landlord_id');

        if (!build_sql_edit('landlord', $arr, $id, 'landlord_id')) {
            $error['landlord'] = 141;
            error_checker($return_url . '   ?id=' . encrypt($id));
        }

        $success['landlord'] = 208;
        render_success($return_url);
    }
    $success['landlord'] = 207;
    render_success($return_url);
}


function landlord_password()
{
    global $arr;
    global $error;
    global $success;
    $return_url = landlord_url . 'password.php';

    $new_password = security('new_password');
    $confirm_password = security('confirm_password');

    // cout($_POST);

    // $landlord = get_by_id('landlord', $_SESSION['landlord_id']);

    if ($new_password != $confirm_password) {
        $error['landlord'] = 145;
        error_checker($return_url);
    }

    $arr['landlord_password'] = password_hashing_hybrid_maker_checker($new_password);

    if (!build_sql_edit('landlord', $arr, $_SESSION['landlord_id'], 'landlord_id')) {
        header("Location: $return_url?error=Details not updated!");
        exit;
    }

    header("Location: $return_url?success=Details updated successfully");
}


function edit_houses()
{
    global $arr;
    global $error;
    global $success;
    $return_url = admin_url . 'landlord_details';

    if (isset($_POST['property_id'])) {
        $arr['property_id'] = implode(",", $_POST['property_id']);
        unset($_POST['property_id']);
    }


    // for_loop();


    $id = security('landlord_id');


    if (!build_sql_edit('landlord', $arr, $id, 'landlord_id')) {
        $error['landlord'] = 141;
        error_checker($return_url . '   ?id=' . encrypt($id));
    }

    $success['landlord'] = 208;
    render_success($return_url . '?id=' .  encrypt($id));

    // cout($_POST);
}

function post_password_reset()
{
    global $arr;
    global $error;
    global $success;
    $return_url = base_url . 'login';

    $uid = security('user_id');

    $sql = "SELECT * FROM password_token WHERE user_key = '$uid' ";
    $row = select_rows($sql)[0];

    if (empty($row)) {
        $error['landlord'] = 143;
        error_checker(base_url . 'password_reset?id=' . encrypt($uid));
    } else {
        if (security('token') != $row['password_token']) {
            $error['landlord'] = 142;
            error_checker(base_url . 'password_reset?id=' . encrypt($uid));
        }
        if (!delete('password_token', 'user_key',  $uid)) {
            $error['delete'] = 911;
            error_checker($return_url);
        }
        $arr['user_password'] = password_hashing_hybrid_maker_checker(security('new_password'));

        if (!build_sql_edit('user', $arr, $uid, 'user_id')) {
            $error['landlord'] = 911;
            error_checker(base_url . 'password_reset?id=' . encrypt($uid));
        }
    }

    $sql2 = "SELECT * FROM user WHERE user_id = '$uid' ";
    $row2 = select_rows($sql2)[0];

    $session_login  = array(
        'user_login'        => true,
        'user_email'        => $row2['user_email'],
        'user_name'         => $row2['user_name'],
        'user_id'           => $row2['user_id'],
        'success'           => array('login' => 204)
    );

    session_assignment($session_login);

    $success['landlord'] = 208;
    render_success(tenant_url);
}



function post_inquiry()
{
    global $arr;
    global $error;
    global $success;
    $return_url = base_uri . 'contact?suc';

    for_loop();

    $arr['inquiry_id'] = create_id('inquiry', 'inquiry_id');

    if (!build_sql_insert('inquiry', $arr)) {
        $error['inquiry'] = 152;
        error_checker($return_url);
    }

    $email      = 'nicolarealtykenya@gmail.com';
    $subject    = APP_NAME . ' Inquiry';
    $name       = APP_NAME;
    $body       = '<p style="font-family:Poppins, sans-serif;"> ';
    $body       .= 'Hello, admin</b> <br>';
    $body       .= 'You have a new inquiry';
    $body       .= '<br>';
    $body       .= '<b>NAME:</b> ' . $arr['inquiry_name'] . ' <br>';
    $body       .= '<br>';
    $body       .= '<b>EMAIL:</b> ' . $arr['inquiry_email'] . ' <br>';
    $body       .= '<br>';
    $body       .= '<b>PHONE:</b> ' . $arr['inquiry_phone'] . ' <br>';
    $body       .= '<br>';
    $body       .= '<b>MESSAGE:</b> ' . $arr['inquiry_message'] . ' <br>';
    $body       .= '<br>';
    $body       .= 'Log in to your admin dashboard : <a href=" ' . admin_url . ' "> CLICK HERE </a> to respond to the request';


    // email($email, $subject, $name, $body);
    $success['inquiry'] = 223;
    render_success($return_url);
}

function write_metadata($table, $action, $key, $role, $user)
{
    $arr['metadata_id']     = create_id('metadata', 'metadata_id');
    $arr['metadata_table']  = $table;
    $arr['metadata_action'] = $action;
    $arr['metadata_key']    = $key;
    $arr['metadata_role']   = $role;
    $arr['metadata_user']   = $user;

    build_sql_insert("metadata", $arr);
}

function create_id($table, $id)
{
    $date_today = date('Ymd');

    $table_prifix = array(
        'admin'             => 'ADM' . $date_today,
        'amenities'         => 'AME' . $date_today,
        'banner'            => 'BNR' . $date_today,
        'bedroom'           => 'BED' . $date_today,
        'booking'           => 'BKN' . $date_today,
        'callback'          => 'CBL' . $date_today,
        'check_in_image'    => 'CIM' . $date_today,
        'currency'          => 'CUR' . $date_today,
        'expense'           => 'INV' . $date_today,
        'expense_category'  => 'INV' . $date_today,
        'features'          => 'FTS' . $date_today,
        'guard'             => 'GRD' . $date_today,
        'inquiry'           => 'INQ' . $date_today,
        'invoice'           => 'INV' . $date_today,
        'invoice_item'      => 'INT' . $date_today,
        'landlord'          => 'LAN' . $date_today,
        'metadata'          => 'META' . $date_today,
        'service'           => 'SER' . $date_today,
        'payment'           => 'PAY' . $date_today,
        'property'          => 'APP' . $date_today,
        'architect'         => 'ARC' . $date_today,
		'mechanical'        => 'MCH' . $date_today,
		'electrical'        => 'ELC' . $date_today,
		'structural'        => 'STR' . $date_today,
        'project'           => 'PPJ' . $date_today,
        'property_image'    => 'IMG' . $date_today,
        'property_unit'     => 'UNT' . $date_today,
        'user'              => 'USR' . $date_today,
        'regulation'        => 'REG' . $date_today,
        'project_assignment'=> 'APA' . $date_today,
    );

    $random_str = $table_prifix[$table] . rand_str();

    $get_id     = get_ids($table, $id, $random_str);

    while ($get_id == true) {
        $random_str = $table_prifix[$table] . rand_str();
        $get_id     = get_ids($table, $id, $random_str);
    }
    return $random_str;
}

function delete_file($image, $table, $id_name)
{
    $id_value = $_SESSION['edit'];

    $sql = "select $image from $table where $id_name = '$id_value'";
    $row = select_rows($sql)[0];

    return unlink(TARGET_DIR  . 'images/' . $row[$image]);
}

function for_loop()
{
    global $arr;

    foreach ($_POST as $key => $value) {
        $arr[$key] = security($key);
    }
}

function send_an_sms($userphone, $message)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://accounts.jambopay.com/auth/token',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'grant_type=client_credentials&client_id=ZLatZ8p7MGzlDU%2FI4koLqUZ%2FVEh5il3NcHpTGlzk%2FK4%3D&client_secret=dda53653-1f7c-4261-8264-4793d629dc3bhdMoSrIGyT88KDaMHrRgNyPgk%2FBBZVZBYdDCv%2FXaxOA%3D',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $token = json_decode($response)->access_token;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://swift.jambopay.co.ke/api/public/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
            "contact" : "' . $userphone . '",
            "message" : "' . $message . '",
            "callback" : "https://angacinemas.com/send_sms/callback.php",
            "sender_name" : "VESEN"
        }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    // cout($response);
}
