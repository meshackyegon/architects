<?php

function get_image($property_id){
    $sql = "
        SELECT 
            *
        FROM 
            property_image
        WHERE
            property_id = '$property_id'
       
    ";

return select_rows($sql)[0];
}

function get_units($property_id){
    $sql = "
        SELECT 
            *
        FROM 
            property_unit
        WHERE
            property_id = '$property_id'
       
    ";

return select_rows($sql)[0];
}

function get_check_in_image($rentee_id)
{
        $sql = "
        SELECT 
            *
        FROM 
            check_in_image
        WHERE
            rentee_id = '$rentee_id'
       
    ";

return select_rows($sql)[0];
}