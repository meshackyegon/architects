<?php
include_once "create.php";
include_once '../../pesapal/submit_order.php';
cout($_POST);

// foreach($_POST as $key=>$val){
//     $_POST[$key] = security($key);
// }

// $customer_obj = array("email"=>$_POST['user_email'],"name"=>$_POST['user_name'],"phone"=>$_POST['user_phone']);
// $ref = bin2hex(random_bytes(6));

// $amount = $_POST['amount'];

// $order = order($customer_obj, $ref, $amount);

// $order_data = json_decode($order);

// // Output the $order_data for debugging
// echo "<pre>";
// print_r($order_data); // or var_dump($order_data) to see more details
// echo "</pre>";

// // Stop the execution before the redirection
// exit();

// // Continue with the rest of your code if needed
// $redirect_url = $order_data->redirect_url;
// $_POST['reference'] = $ref;
// $_POST['redirect_url'] = $redirect_url;

// build_sql_insert("bookings", $_POST);

// header("Location: ../../summary.php?ref=" . $ref);
// exit();