<?php
include_once MODEL_PATH . "operations.php";

function available($attr, $text)
{

    $attribute_availability = check_error($attr, security($attr));

    if (!empty($attribute_availability)) {
        echo "<span style='color:red'> " . $text . " already exists .</span>";
        echo "<script>$('#add').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'> " . $text . " available for Registration .</span>";
        echo "<script>$('#add').prop('disabled',false);</script>";
    }
}

if (!empty($_POST["phoneNumber"])) {
    echo available('phoneNumber', ' Phone number');
}

if (!empty($_POST["email"])) {
    echo available('email', 'Email');
}

if (!empty($_POST["idNumber"])) {
    echo available('idNumber', 'National Id/Passport');
}