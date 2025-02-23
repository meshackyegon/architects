<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function delete($table, $id, $id_val) {
    global $error;
    
    $sql = "
        DELETE 
        FROM 
            `$table` 
        WHERE 
            $id = '$id_val'
    ";

    $alt_connection = false;
    
    if (!insert_delete_edit($sql, $alt_connection)) {
        return $error[] = 103;
    }
    
    return true;
}