<?php

// if(!defined('auth')){
//     http_response_code(401);
//     exit();
// }

function redirect_header($redirect)
{
    if (!headers_sent()) {
        header("Location: " . $redirect);
    }

    echo "<script>window.location='$redirect';</script>";
    exit();
}
