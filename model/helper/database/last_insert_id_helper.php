<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function last_insert_id($sql)
{
    global $error;

    $conn = connect();

    if (mysqli_query($conn, $sql)) {

        $result = mysqli_insert_id($conn);

        mysqli_close($conn);

        return $result;
    }
    mysqli_close($conn);
    return $error[] = 105;
}
