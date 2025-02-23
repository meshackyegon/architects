<?php

function get_property($parent = '',$type='')
{
    $sql = " SELECT  * FROM  property ";
    $parent != '' ? $sql .= " WHERE property_is_subunit = 'no' " : '';
    $type != '' ? $sql .= " WHERE property_type = '$type' " : '';
    $sql .= " ORDER BY property_date_created DESC ";
    return select_rows($sql);
}

function get_properties_for_frontend($start = 0,$order_by = 'property_date_created DESC', $limit = null)
{
    $sql = " SELECT  * FROM  property ";
    
    $sql .= " ORDER BY $order_by  LIMIT  $start ";   
    
    if (!empty($limit)) {
        $sql .= ",$limit";
    }

    return select_rows($sql);
}

function get_property_count($id, $name)
{
    $sql = "
        SELECT 
            property_id
        FROM 
            property 
    ";

    if (($id != null) && ($name != null)) $sql .= " WHERE $name = '$id'";

    return sql_counter($sql);
}

function get_property_subunits($property_id, $not_id = '')
{
    $sql = " SELECT  * FROM  property WHERE property_parent_id = '$property_id'  ";
    $not_id != '' ? $sql .= " AND property_id != '$not_id' " : " ";
    $sql .= " ORDER BY property_date_created DESC";

    return select_rows($sql);
}

function get_single_property($property_id)
{
    $sql = "
       SELECT 
            *
        FROM 
            property
     
       WHERE property_id = '$property_id'
    ";

    return select_rows($sql)[0];
}

function get_property_cities()
{
    $sql = "SELECT property_city FROM property GROUP BY property_city ";
    return select_rows($sql);
}

function get_property_locations()
{
    $sql = "SELECT property_location FROM property GROUP BY property_location ";
    return select_rows($sql);
}

function get_property_by_location($name)
{
    $sql = "SELECT * FROM property WHERE property_location = '$name'";
    return select_rows($sql);
}

function get_featured_properties()
{
    $sql = "SELECT * FROM featured_property ";
    return select_rows($sql);
}

function get_property_features($property_id)
{
    $sql = "SELECT * FROM features WHERE property_id = '$property_id' ";

    return select_rows($sql);
}


function get_landlord_properties($landlord_id)
{
    $sql = "SELECT * FROM property WHERE added_by = '$landlord_id' ";

    return select_rows($sql);
}

function get_landlord_tenants($landlord_id)
{
    $sql = "SELECT booking.*, property.property_name, property.added_by, user.user_name, user.user_id FROM  booking JOIN property ON booking.property_id = property.property_id JOIN user ON user.user_id =  booking.user_id WHERE property.added_by = '$landlord_id' GROUP BY user.user_id;";
    return select_rows($sql);
}



