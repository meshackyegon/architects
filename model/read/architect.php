<?php

function get_architect($attr, $col = 'architect_email')
{
    $sql = "SELECT *       
        FROM 
            architect 
        WHERE 
            $col='$attr'
    ";

    return select_rows($sql)[0];
}

function get_architect_profile()
{
    $sql = "
        SELECT
            *
        FROM architect
    ";

    return select_rows($sql);
}
function get_by_field($table, $field, $value) {
    $sql = "SELECT * FROM $table WHERE $field = '$value' LIMIT 1";
    return select_rows($sql)[0]; 
}
function get_all_where($table, $conditions = []) {
    $whereClause = [];
    foreach ($conditions as $field => $value) {
        $whereClause[] = "$field = '$value'";
    }
    $whereString = implode(" AND ", $whereClause);

    $sql = "SELECT * FROM $table WHERE $whereString";
    return select_rows($sql); // Assuming select_rows() executes the query and returns an array
}

function get_architect_login()
{
    global $error;
    $email      = $_POST['architect_email'];
    // cout($email);

   error_checker(architects_url);
    // error_checker(admin_url);

    $login = get_architect($email, 'architect_email', true);
    // cout($login);

    if (empty($login)) {
        $error['login'] = 135;
        error_checker(architects_url);
        // error_checker(admin_url);
    }

    if (!password_hashing_hybrid_maker_checker($_POST['architect_password'], $login['architect_password'])) {
        $error['login'] = 135;
        error_checker(architects_url);
        // error_checker(admin_url);
    }

    $session_login  = array(
        'architect_login'       => true,
        'architect_email'       => $email,
        'architect_name'        => $login['architect_name'],
        'architect_id'          => $login['architect_id'],
        'architect_role'        => $login['role'],
        'success'               => array('login' => 204)
    );
    // var_dump(architects_url);
    session_assignment($session_login);
    // // cout(session_assignment($session_login));
    redirect_header(architects_url);
   

}


