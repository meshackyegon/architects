<?php

function get_employee($attr, $col = 'employee_email', $login = false)
{
    $sql = "SELECT employee_id, employee_name, ";

    if ($login === true) $sql .= "employee_password,";
    if ($login === false) $sql .= " employee_email,";

    $sql .= "       
        employee_date_created 
        
        FROM 
            employee 
        WHERE 
            $col='$attr'
    ";

    return select_rows($sql)[0];
}

function get_employee_profile()
{
    $sql = "
        SELECT
            *
        FROM employee
    ";

    return select_rows($sql);
}

function get_employee_login()
{
    global $error;
    $email      = $_POST['employee_email'];

    writing_system_logs("Logging user of email: [ $email ] in, session: [ " . json_encode($_SESSION) . ' ]');

    error_checker(employee_url);

    $login = get_employee($email, 'employee_email', true);

    if (empty($login)) {
        $error['login'] = 135;
        writing_system_logs("Login failed with reason: [ " . $error[135] . ' ] for session: [ ' . json_encode($_SESSION) . ' ]');
        error_checker(employee_url);
    }
    
    
    
    if (!password_hashing_hybrid_maker_checker($_POST['employee_password'], $login['employee_password'])) {
        $error['login'] = 135;
        writing_system_logs("Password_Login failed with reason: [ " . $error[135] . ' ] for session: [ ' . json_encode($_SESSION) . ' ]');
        error_checker(employee_url);
    }


    $session_login  = array(
        'employee_login'        => true,
        'employee_email'        => $email,
        'employee_name'         => $login['employee_name'],
        'employee_id'           => $login['employee_id'],
        'success'               => array('login' => 204)
    );

    session_assignment($session_login);
    writing_system_logs("Login successful session created: [ " . json_encode($_SESSION) . ' ]');
    redirect_header(employee_url . 'dashboard');
}
