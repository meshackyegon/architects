<?php

function get_mechanical($attr, $col = 'mechanical_email')
{
    $sql = "SELECT *       
        FROM 
            mechanical 
        WHERE 
            $col='$attr'
    ";

    return select_rows($sql)[0];
}

function get_mechanical_profile()
{
    $sql = "
        SELECT
            *
        FROM mechanical
    ";

    return select_rows($sql);
}

function get_mechanical_login()
{
    global $error;
    $email      = $_POST['mechanical_email'];
    // cout($email);

   error_checker(mechanical_url);
    // error_checker(admin_url);

    $login = get_mechanical($email, 'mechanical_email', true);
    // cout($login);

    if (empty($login)) {
        $error['login'] = 135;
        error_checker(mechanical_url);
        // error_checker(admin_url);
    }

    if (!password_hashing_hybrid_maker_checker($_POST['mechanical_password'], $login['mechanical_password'])) {
        $error['login'] = 135;
        error_checker(mechanical_url);
        // error_checker(admin_url);
    }

    $session_login  = array(
        'mechanical_login'       => true,
        'mechanical_email'       => $email,
        'mechanical_name'        => $login['mechanical_name'],
        'mechanical_id'          => $login['mechanical_id'],
        'mechanical_role'        => $login['role'],
        'success'               => array('login' => 204)
    );
    // cout( $session_login);
    session_assignment($session_login);
    // cout(session_assignment($session_login));
    redirect_header(mechanical_url);
    // // redirect_header(admin_url);


   
}


