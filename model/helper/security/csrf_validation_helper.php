<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

$csrf_life_time = $_SESSION['csrf_time'] + 3600;

function csrf_generate()
{
    global $csrf_life_time;

    if (!isset($_SESSION['csrf']) || !isset($_SESSION['csrf_time']) || $csrf_life_time <= time()) {
        $csrf_session = array(
            'csrf' => bin2hex(random_bytes(32)),
            'csrf_time' => time()
        );

        session_assignment($csrf_session, false);
    }

    $csrf_token = hash_hmac('sha256', $_SESSION['csrf'], CSRF_KEY);


    return $csrf_token;
}

function csrf_verify($csrf_token)
{
    global $warning;
    global $csrf_life_time;

    if (!isset($_SESSION['csrf_time']) || (isset($_SESSION['csrf_time']) && $csrf_life_time <= time())) {
        unset($_SESSION['csrf'], $_SESSION['csrf_time']);
        return $warning['csrf_set_time'] = 305;
    }

    if (!hash_equals(csrf_generate(), $csrf_token)) {
        unset($_SESSION['csrf'], $_SESSION['csrf_time']);
        return $warning['csrf_not_match'] = 304;
    }

    unset($_SESSION['csrf'], $_SESSION['csrf_time']);
    return true;
}
