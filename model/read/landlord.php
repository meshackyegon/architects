<?php

function get_landlord($attr, $col = 'landlord_email')
{
    $sql = "SELECT *       
        FROM 
            landlord 
        WHERE 
            $col='$attr'
    ";

    return select_rows($sql)[0];
}

function get_landlord_profile()
{
    $sql = "
        SELECT
            *
        FROM landlord
    ";

    return select_rows($sql);
}

function get_landlord_login()
{
    global $error;
    $email      = $_POST['landlord_email'];
    // cout($email);

   error_checker(landlord_url);
    // error_checker(admin_url);

    $login = get_landlord($email, 'landlord_email', true);
    // cout($login);

    if (empty($login)) {
        $error['login'] = 135;
        error_checker(landlord_url);
        // error_checker(admin_url);
    }

    if (!password_hashing_hybrid_maker_checker($_POST['landlord_password'], $login['landlord_password'])) {
        $error['login'] = 135;
        error_checker(landlord_url);
        // error_checker(admin_url);
    }

    $session_login  = array(
        'landlord_login'       => true,
        'landlord_email'       => $email,
        'landlord_name'        => $login['landlord_name'],
        'landlord_id'          => $login['landlord_id'],
        'success'               => array('login' => 204)
    );
    // cout( $session_login);
    session_assignment($session_login);
    // cout(session_assignment($session_login));
    redirect_header(landlord_url);
    // // redirect_header(admin_url);


   
}


