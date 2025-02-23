<?php 

include_once '../../path.php';

require_once 'google_auth.php';

if(isset($_SESSION['access_token'])) {
    unset($_SESSION['access_token']);
} 

if(isset($_GET['code'])){
    $_SESSION['access_token'] = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);
}else{
    header("Location:" . base_url . "login?$_SESSION[user_type]&false");
    exit();
}

$o_auth = new Google_Service_Oauth2($google_client);
$user_data = $o_auth->userinfo_v2_me->get();

// $login = get_profile($user_data['email'], 'email');
echo $user_data['email'];