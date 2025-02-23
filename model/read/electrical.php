<?php

function get_electrical($attr, $col = 'electrical_email')
{
    $sql = "SELECT *       
        FROM 
            electrical 
        WHERE 
            $col='$attr'
    ";

    return select_rows($sql)[0];
}

function get_electrical_profile()
{
    $sql = "
        SELECT
            *
        FROM electrical
    ";

    return select_rows($sql);
}

function get_electrical_login()
{
    global $error;
    $email      = $_POST['electrical_email'];
    // cout($email);

   error_checker(electrical_url);
    // error_checker(admin_url);

    $login = get_electrical($email, 'electrical_email', true);
    // cout($login);

    if (empty($login)) {
        $error['login'] = 135;
        error_checker(electrical_url);
        // error_checker(admin_url);
    }

    if (!password_hashing_hybrid_maker_checker($_POST['electrical_password'], $login['electrical_password'])) {
        $error['login'] = 135;
        error_checker(electrical_url);
        // error_checker(admin_url);
    }

    $session_login  = array(
        'electrical_login'       => true,
        'electrical_email'       => $email,
        'electrical_name'        => $login['electrical_name'],
        'electrical_id'          => $login['electrical_id'],
        'success'               => array('login' => 204)
    );
    // cout( $session_login);
    session_assignment($session_login);
    // cout(session_assignment($session_login));
    redirect_header(electrical_url);
    // // redirect_header(admin_url);


   
}


