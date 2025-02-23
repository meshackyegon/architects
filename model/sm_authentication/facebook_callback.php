<?php

include_once '../../path.php';

require_once 'facebook_auth.php';

try {
    $access_token = $helper->getAccessToken();
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo "Response Exception: " . $e->getMessage();
    exit();
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "SDK Exception: " . $e->getMessage();
    exit();
}

if(!$access_token) {
    // user false
    exit();
}

$o_auth = $fb->getOAuth2Client();

if(!$access_token->isLongLived())
    $access_token = $o_auth->getLongLivedAccessToken($access_token);
    
$response = $fb->get("/me?fields=id, first_name, last_name, email, gender", $access_token);

$user_data = $response->getGraphNode()->asArray();
echo $user_data['email'];
// $login = get_profile($user_data['email'], 'email');