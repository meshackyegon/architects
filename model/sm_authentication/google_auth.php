<?php

require_once 'google/vendor/autoload.php';

$google_client = new Google_Client();

$google_client->setClientId(G_ID);
$google_client->setClientSecret(G_SECRET);
$google_client->setApplicationName("Rentals Konekt");
$google_client->setRedirectUri(base_url . "model/sm_authentication/google_callback");
$google_client->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");