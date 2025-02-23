<?php

require_once 'facebook/autoload.php';

$fb = new \Facebook\Facebook([
    'default_graph_version' => 'v2.10',
    'app_id'                => FB_ID,
    'app_secret'            => FB_SECRET
]);

$helper = $fb->getRedirectLoginHelper();