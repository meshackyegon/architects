<?php

function get_all($table)
{
    $sql = "
       SELECT 
            *
        FROM 
            $table
     
        ORDER BY
            ".$table."_date_created
        DESC
    ";

    return select_rows($sql);
}

function get_by_id($table,$item_id)
{
    $sql = "
       SELECT 
            *
        FROM 
            $table
     
       WHERE ".$table."_id = '$item_id'
    ";

    return select_rows($sql)[0];
    // echo $sql;
}

function get_by_column($table, $column, $value, $multiple = 'yes')
{
    $sql = "
       SELECT 
            *
        FROM 
            $table
     
       WHERE " . $column . " = '$value'
    ";

    if ($multiple == 'yes') {
        $result = select_rows($sql);
    } else {
        $result = select_rows($sql)[0];
    }

    return $result;
    // echo $sql;
}