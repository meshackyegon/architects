<?php

// if (!defined('auth')) {
//     http_response_code(401);
//     exit();
// }

function sql_counter($sql)
{
    $conn = connect();


    $result = mysqli_num_rows(mysqli_query($conn, $sql));
    mysqli_close($conn);

    return $result;
}