<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);

$enLigne = false; // Set this to true for online, false for offline

if ($enLigne) {

    $http_host  = "https://$_SERVER[HTTP_HOST]";
    $php_self   = explode(".", $_SERVER['PHP_SELF'])[0];
    $http_model = "https://$_SERVER[HTTP_HOST]/model/update/create?action=";
    $http_delete = "https://$_SERVER[HTTP_HOST]/model/delete/index?";

    define('admin_uri', $http_host . "/dashboard");
    define('admin_url', $http_host . "/dashboard/");

    define('landlord_uri', $http_host . "/landlord");
    define('landlord_url', $http_host . "/landlord/");


    define('tenant_uri', $http_host . "/tenant");
    define('tenant_url', $http_host . "/tenant/");

    define('architects_uri', $http_host . "/architect");
    define('architects_url', $http_host . "/architect/");

    define('electrical_uri', $http_host . "/electrical");
    define('electrical_url', $http_host . "/electrical/");

    define('mechanical_uri', $http_host . "/mechanical");
    define('mechanical_url', $http_host . "/mechanical/");

    define('structural_url', $http_host . "/stractural");
    define('structural_url', $http_host . "/stractural/");

    define('model_url', $http_model . '/');

    define('base_url', $http_host . "/");
    define('base_uri', $http_host);

    define('creator_uri', "https://vesencomputing.com/");
    define('delete_url', "$http_delete");


    define('cookie_domain', "$_SERVER[HTTP_HOST]");

    define('ROOT_PATH', realpath(dirname(__FILE__)) . '/');
    define('MODEL_PATH', realpath(dirname(__FILE__)) . '/model/');

    define('TARGET_DIR', "/home/architects/public_html/uploads/");
    // define('LOG_DIR', $http_host . "/log/");


    define('file_url', 'https://architects.com/uploads/images/');
    define('logo_url', $http_host . "/img/logo.png");
} else {
    // LOCAL
    $http_host  = "https://$_SERVER[HTTP_HOST]";
    $php_self   = explode(".", $_SERVER['PHP_SELF'])[0];
    $http_model = "https://$_SERVER[HTTP_HOST]/architects/model/update/create?action=";
    $http_delete = "https://$_SERVER[HTTP_HOST]/architects/model/delete/index?";

    define('admin_uri', $http_host . "/architects/dashboard");
    define('admin_url', $http_host . "/architects/dashboard/");
    define('landlord_uri', $http_host . "/architects/landlord");
    define('landlord_url', $http_host . "/architects/landlord/");
    define('tenant_uri', $http_host . "/architects/tenant");
    define('tenant_url', $http_host . "/architects/tenant/");



    define('architects_uri', $http_host . "/architects/architect");
    define('architects_url', $http_host . "/architects/architect/");

    define('electrical_uri', $http_host . "/architects/electrical");
    define('electrical_url', $http_host . "/architects/electrical/");

    define('mechanical_uri', $http_host . "/architects/mechanical");
    define('mechanical_url', $http_host . "/architects/mechanical/");

    define('structural_url', $http_host . "/architects/stractural");
    define('structural_url', $http_host . "/architects/stractural/");
    define('model_url', $http_model);
    define('base_uri', "https://localhost/architects");
    define('base_url', "https://localhost/architects/");

    define('creator_uri', "https://vesencomputing.com/");
    define('delete_url', "$http_delete");

    define('cookie_domain', "$_SERVER[HTTP_HOST]");

    define('ROOT_PATH', realpath(dirname(__FILE__)) . '/');
    define('MODEL_PATH', realpath(dirname(__FILE__)) . '/model/');

    define('TARGET_DIR', 'C:/xampp/htdocs/architects/uploads/');
    define('LOG_DIR', 'C:/xampp/htdocs/architects/log/');


    define('file_url', "$http_host/architects/uploads/images/");
    define('logo_url', $http_host . "/architects/dashboard/assets/img/logos/domysuma-logo.svg");
}
