<?php

function get_admin($attr, $col = 'admin_email', $login = false)
{
    $sql = "SELECT admin_id,admin_name, ";

    if ($login === true) $sql .= "admin_password,";
    if ($login === false) $sql .= " admin_email,";

    $sql .= "
            admin_privileges         
        FROM 
            admin 
        WHERE 
            $col='$attr'
    ";

    return select_rows($sql)[0];
}

function get_admin_profile()
{
    $sql = "
        SELECT
            *
        FROM admin
    ";

    return select_rows($sql);
}

function get_admin_login()
{
    global $error;
    $email      = $_POST['admin_email'];


    error_checker(admin_url);

    $login = get_admin($email, 'admin_email', true);

    if (empty($login)) {
        $error['login'] = 135;
        error_checker(admin_url);
    }

    if (!password_hashing_hybrid_maker_checker($_POST['admin_password'], $login['admin_password'])) {
        $error['login'] = 135;
        error_checker(admin_url);
    }

    $session_login  = array(
        'admin_login'       => true,
        'admin_email'       => $email,
        'admin_name'        => $login['admin_name'],
        'admin_id'          => $login['admin_id'],
        'admin_privileges'  => $login['admin_privileges'],
        'success'           => array('login' => 204)
    );

    session_assignment($session_login);
    redirect_header(admin_url);
}

function get_all_admins($admin_id)
{
    $sql = "SELECT * FROM admin WHERE admin_id != '$admin_id' ";
    return select_rows($sql);
}
