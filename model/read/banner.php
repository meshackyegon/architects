<?php

function get_all_banners(){
    $sql = "
        SELECT 
            poster,
            bannerId,
            bannerTitle,
            bannerStatus,
            bannerDescription
        FROM 
            BANNER
        WHERE 
            bannerStatus != 'deleted'
        ORDER BY
            date_created 
        DESC
    ";
    
    return select_rows($sql);
}

function get_banner_by_id($id)
{
    $sql = "
        SELECT
            poster,
            bannerId,
            bannerTitle,
            bannerStatus,
            bannerDescription
        FROM 
            BANNER 
        WHERE 
            bannerId='$id' 
    ";
    
    return select_rows($sql)[0];
}