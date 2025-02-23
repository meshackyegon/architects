<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function build_sql_edit($table, $elements, $id, $col = "id") {
    $sql = "
        UPDATE 
            `$table` 
        SET 
    ";
    
    $i = sizeof($elements);
    $j = 0;
    
    foreach ($elements as $key => $value) {
        $j++;
        if ($i != $j) {
            $sql .= "`$key`" . " = " . "'$value',";
        } else {
            $sql .=  "`$key`" . " = " . "'$value'";
        }
    }

    $sql .= "
        WHERE 
            `$col` = '$id'
    ";
  return insert_delete_edit($sql);
}

function build_multiple_sql_edit($table, $elements, $id, $ids, $col = "id", $cols) {
    $sql = "
        UPDATE 
            `$table` 
        SET 
    ";
    
    $i = sizeof($elements);
    $j = 0;
    
    foreach ($elements as $key => $value) {
        $j++;
        if ($i != $j) {
            $sql .= "`$key`" . " = " . "'$value',";
        } else {
            $sql .=  "`$key`" . " = " . "'$value'";
        }
    }

    $sql .= "
        WHERE 
            `$col` = '$id' 
        AND 
            `$cols` = '$ids'
    ";
    
      return insert_delete_edit($sql);
}