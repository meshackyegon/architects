<?php

if (!defined('ROOT_PATH')) {
    http_response_code(401);
    exit();
}

define('auth', true);
define('CORE_PATH', realpath(dirname(__FILE__)) . '/');

require_once 'helper/logs.php';
require_once 'constants.php';
require_once 'app_header.php';

if (session_status() == PHP_SESSION_NONE) {

    session_name('JSESSIONID');

    session_start();
    if (isset($_SESSION['session_ip']) === false) {
        $_SESSION['session_ip'] = $_SERVER['REMOTE_ADDR'];
    }
    
}

$error      = array();
$success    = array();
$warning    = array();

require_once 'user_data/index.php';
require_once 'helper/index.php';

if ((($_SESSION['session_ip'] !== $_SERVER['REMOTE_ADDR']) ||
    (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY'] > ($minutesBeforeSessionExpire * 60))))) {
    logout();
}
function encryptmessage($data, $key) {
  // Generate an initialization vector
  $ivlen = openssl_cipher_iv_length('aes-256-cbc');
  $iv = openssl_random_pseudo_bytes($ivlen);

  // Encrypt the data using the key and initialization vector
  $ciphertext = openssl_encrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

  // Return the encrypted data along with the initialization vector
  return base64_encode($iv . $ciphertext);
}

function decryptmessage($data, $key) {
  // Decode the base64-encoded string
  $data = base64_decode($data);

  // Extract the initialization vector and encrypted data
  $ivlen = openssl_cipher_iv_length('aes-256-cbc');
  $iv = substr($data, 0, $ivlen);
  $ciphertext = substr($data, $ivlen);

  // Decrypt the data using the key and initialization vector
  $plaintext = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

  // Return the decrypted data
  return $plaintext;
}

function create_id2($table, $id)
{
	$date_today = date('Ymd');

	$table_prifix = array(
		'admin'             => 'ADM' . $date_today,
		'story'             => 'STO' . $date_today,
		'banner'            => 'BNR' . $date_today,
		'inquiry'           => 'INQ' . $date_today,
		'statistic'         => 'STT' . $date_today,
		'therapist'         => 'THP' . $date_today,
		'speciality'        => 'SPE' . $date_today,
		'prescription'      => 'PRE' . $date_today,
		'bookmark'          => 'BKM' . $date_today,
		'user'              => 'USR' . $date_today,
	    'architect'         => 'ARC' . $date_today,
		'mechanical'        => 'MCH' . $date_today,
		'electrical'        => 'ELC' . $date_today,
		'structural'        => 'STR' . $date_today,
		'post'              => 'PST' . $date_today,
		'comment'           => 'CMT' . $date_today,
		'reply'             => 'REP' . $date_today,
		'service'           => 'SRV' . $date_today,
		'board'             => 'BRD' . $date_today,
		'therapist_move'    => 'TPM' . $date_today,
		'likes'             => 'LIK' . $date_today,
		'subscription'      => 'SUB' . $date_today,
		'session'           => 'SES' . $date_today,
		'voucher'           => 'VOC' . $date_today,
		'subscriber'        => 'SUB' . $date_today,
		'banner'            => 'BNR' . $date_today,

	);

	$random_str = $table_prifix[$table] . rand_str();

	$get_id     = get_ids($table, $id, $random_str);

	while ($get_id == true) {
		$random_str = $table_prifix[$table] . rand_str();
		$get_id     = get_ids($table, $id, $random_str);
	}
	return $random_str;
}



require_once 'read/index.php';
require_once 'email/email.php';