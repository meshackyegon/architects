<?php

if (isset($_GET['logout'])) logout();

function logout()
{
    session_start();

    if (!csrf_verify('csrf_token')){
        $warning['csrf_logout'] = 302;
        render_warning(admin_url);
    } 

    $_SESSION = array();

    if (ini_get('session.use_cookies')) {
        $cookie_param = session_get_cookie_params();

        setcookie(
            session_name(),
            '',
            0,
            $cookie_param['path'],
            $cookie_param['domain'],
            $cookie_param['secure'],
            $cookie_param['httponly']
        );
    }

    unset($_SESSION);

    session_unset();
    session_destroy();
    session_write_close();
    // session_regenerate_id(true);


    redirect_header(base_url . '?logged_out');
}