<?php

// if (!defined('auth')) {
//     http_response_code(401);
//     exit();
// }

function connect($db_username = DB_USERNAME, $db_password = DB_PASSWORD, $db_host = DB_HOST, $db_name = DB_NAME)
{
   
    $connection =  mysqli_connect($db_host, $db_username, $db_password, $db_name);

    if (mysqli_connect_errno()) {
        $db_rror_msg = 'Database responded with [ ' . mysqli_connect_errno()  . ' ]';
       
    }

    return $connection;
}