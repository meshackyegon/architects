<?php
error_reporting(E_ALL ^ E_WARNING);
include_once 'path.php';
require_once MODEL_PATH . 'operations.php';

if (!empty($_POST["email"])) {
    echo available('user_email', 'Email','user',security('email'));
}
if (!empty($_POST["architect_email"])) {
    echo available('architect_email', 'Email','architect',security('architect_email'));
}

if (!empty($_POST["landlord_email"])) {
    echo available('landlord_email', 'Email','landlord',security('landlord_email'));
}
if (!empty($_POST["electrical_email"])) {
    echo available('electrical_email', 'Email','electrical',security('electrical_email'));
}
if (!empty($_POST["mechanical_email"])) {
    echo available('mechanical_email', 'Email','mechanical',security('mechanical_email'));
}
if (!empty($_POST["structural_email"])) {
    echo available('structural_email', 'Email','structural',security('structural_email'));
}


function available($col, $text,$table,$attr)
{
    $sql = "SELECT * FROM $table WHERE $col = '$attr' ";
    $attribute_availability = select_rows($sql)[0];

    if (!empty($attribute_availability)) {
        echo "<span style='color:red'> " . $text . " already exists .</span>";
        echo "<script>$('#add').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'> " . $text . " available for Registration .</span>";
        echo "<script>$('#add').prop('disabled',false);</script>";
    }
}
