<?php
require_once '../path.php';
require_once MODEL_PATH . "operations.php";

$_SESSION['page'] = $page;

if (!isset($_SESSION) || $_SESSION['structural_login'] == false) {
    $warning['login'] = 300;
    render_warning(base_url . 'login');
}

if (isset($_SESSION['edit'])) {
    unset($_SESSION['edit']);
}


$profile = get_by_id('structural', $_SESSION['structural_id']);

if (!empty($profile['structural_image'])) :
    $require = false;
    $image = $profile['structural_image'];
else :
    $require = true;
    $image = 'white_bg_image.png';
endif;
?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="<?= admin_url ?>assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?= APP_NAME ?></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://rentpesa.com/img/logo.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= admin_url ?>assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/libs/typeahead-js/typeahead.css" />


    <!-- <link rel="stylesheet" href="../backoffice/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../backoffice/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"> -->


    <!--<link rel="stylesheet" href="<?= admin_url ?>assets/vendor/libs/flatpickr/flatpickr.css" />-->
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/libs/animate-css/animate.css" />
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/libs/sweetalert2/sweetalert2.css" />

    <!-- Row Group CSS -->
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css" />
    <!-- Form Validation -->
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/css/pages/page-account-settings.css" />
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/css/pages/page-profile.css" />

    <!-- Helpers -->
    <script src="<?= admin_url ?>assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="<?= admin_url ?>assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= admin_url ?>assets/js/config.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>

<body>
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
            font-weight: bold;
        }

        .datatables-basic thead tr {
            background-color: #269491C4;
        }

        .datatables-basic thead tr th {
            color: #fff !important;
            text-transform: capitalize;
        }


        .alert {
            z-index: 99999 !important;
            position: absolute !important;
            width: 100% !important;
            cursor:pointer;
        }
    </style>

    <?php
    if (!empty($_SESSION['error'])) {
        foreach ($_SESSION['error'] as $err) {
            error_message(ERROR_DEFINITION[$err]) . PHP_EOL;
        }
    }

    if (!empty($_SESSION['success'])) {
        foreach ($_SESSION['success'] as $success) {
            success_message(SUCCESS_DEFINITION[$success]) . PHP_EOL;
        }
    }

    if (!empty($_SESSION['warning'])) {
        foreach ($_SESSION['warning'] as $warning) {
            warning_message(WARNING_DEFINITION[$warning]) . PHP_EOL;
        }
    }

    unset_session_error();
    unset_session_success();
    unset_session_warning();


    ?>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php
            include_once 'sidebar.php'; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item navbar-search-wrapper mb-0">
                                <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                                    <i class="bx bx-search bx-sm"></i>
                                    <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                                </a>
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            
                            <!-- Style Switcher -->
                            <li class="nav-item me-2 me-xl-0">
                                <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                                    <i class="bx bx-sm"></i>
                                </a>
                            </li>
                            <!--/ Style Switcher -->

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="<?= file_url . $image ?>" alt style="height: 40px;object-fit: cover; "  class="w-px-40   rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="pages-account-settings-account.html">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="<?= file_url . $image ?>" alt style="height: 40px;object-fit: cover; "  class="w-px-40  rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block"><?= $profile['user_name'] ?></span>
                                                    <small class="text-muted">Tenant</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="profile">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="?logout" >
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>

                    <!-- Search Small Screens -->
                    <div class="navbar-search-wrapper search-input-wrapper d-none">
                        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search..." />
                        <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->