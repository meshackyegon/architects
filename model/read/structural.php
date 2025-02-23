<?php

function get_structural($attr, $col = 'structural_email')
{
    $sql = "SELECT *       
        FROM 
            structural
        WHERE 
            $col='$attr'
    ";

    return select_rows($sql)[0];
}

function get_structural_profile()
{
    $sql = "
        SELECT
            *
        FROM structural
    ";

    return select_rows($sql);
}

function get_structural_login()
{
    global $error;
    $email      = $_POST['structural_email'];
    // cout($email);

   error_checker(structural_url);
    // error_checker(admin_url);

    $login = get_structural($email, 'structural_email', true);
    // cout($login);

    if (empty($login)) {
        $error['login'] = 135;
        error_checker(structural_url);
        // error_checker(admin_url);
    }

    if (!password_hashing_hybrid_maker_checker($_POST['structural_password'], $login['structural_password'])) {
        $error['login'] = 135;
        error_checker(structural_url);
        // error_checker(admin_url);
    }

    $session_login  = array(
        'structural_login'       => true,
        'structural_email'       => $email,
        'structural_name'        => $login['structural_name'],
        'structural_id'          => $login['structural_id'],
        'success'               => array('login' => 204)
    );
    // cout( $session_login);
    session_assignment($session_login);
    // cout(session_assignment($session_login));
    redirect_header(structural_url);
    // // redirect_header(admin_url);


   
}


