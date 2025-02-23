<?php
require_once "create.php";

$id         = security('id', 'GET');
$return_url = landlord_url . 'view_users';

$sql = "SELECT * FROM request WHERE request_id = '$id' ";
$row = select_rows($sql)[0];
$uid = $row['user_id'];

$sql2 = "SELECT * FROM user WHERE user_id = '$uid' ";
$row2 = select_rows($sql2)[0];

$arr['booking_id'] = create_id('booking', 'booking_id');
$arr['user_id'] = $uid;
$arr['property_id'] = $row['property_id'];
$arr['property_unit_id'] = $row['property_unit_id'];
$arr['booking_check_in'] = $row['request_check_in'];
$arr['preffered_date'] = $row['preffered_date'];
$arr['starting_from'] = $row['starting_from'];

if (!build_sql_insert('booking', $arr)) {
    $error['view_bookings'] = 154;
    error_checker($return_url);
}

$array['property_id'] = $row['property_id'];

if (!build_sql_edit('user', $array, $uid, 'user_id')) {
    $error['user'] = 149;
    error_checker($return_url);
}

$email      = $row2['user_email'];
$subject    = APP_NAME . ' Rental Onboarding';
$name       = APP_NAME;
$body       = '<p style="font-family:Poppins, sans-serif;"> ';
$body       .= 'Hello, <b>' . $row2['user_name'] . '</b> <br>';
$body       .= 'You have been successfully onboarded as a <b>' . $name . '</b> tenant';
$body       .= '</p>';

email($email, $subject, $name, $body);


write_metadata('Booking', 'Admit Tenant', $id, 'Landlord', $_SESSION['landlord_id']);

if (!delete('request', 'request_id',  $id)) {
    $error['delete'] = 144;
    error_checker($return_url);
}
$success[$table] = 221;
render_success($return_url);
