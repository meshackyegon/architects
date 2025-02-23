<?php
$page        = 'structural';
require_once 'header.php';

$id = security('id', 'GET');

$structural = get_by_id('structural', $id);

if (!empty($structural['structural_image'])) :
    $require = false;
    $image = $structural['structural_image'];
else :
    $require = true;
    $image = 'default.png';
endif;

$houses = explode(',', $structural['property_id']);

$properties = get_all('property');

$string = $structural['property_id'];
?>

<head>
    <link rel="stylesheet" href="<?= admin_url ?>assets/vendor/css/pages/page-profile.css" />
</head>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Structural Profile /</span> Profile</h4>

    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="<?= admin_url ?>assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top" />
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="<?= file_url . $image ?>" alt="structural image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4><?= $structural['structural_name'] ?></h4>
                                <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                    <li class="list-inline-item fw-semibold"><i class="bx bx-pen"></i> structural</li>
                                    <li class="list-inline-item fw-semibold">
                                        <i class="bx bx-calendar-alt"></i> Joined 
                                        
                                    </li>
                                </ul>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-primary text-nowrap">
                                <i class="bx bx-user-check me-1"></i>Connected
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Header -->

    <!-- User Profile Content -->
    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">
                    <small class="text-muted text-uppercase">About</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-user"></i><span class="fw-semibold mx-2">Full Name:</span>
                            <span><?= $structural['structural_name'] ?></span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-check"></i><span class="fw-semibold mx-2">Status:</span> <span>Active</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-star"></i><span class="fw-semibold mx-2">Role:</span> <span>Structural</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-flag"></i><span class="fw-semibold mx-2">Country:</span> <span>Kenya</span>
                        </li>

                    </ul>
                    <small class="text-muted text-uppercase">Contacts</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-phone"></i><span class="fw-semibold mx-2">Contact:</span>
                            <span><?= $structural['structural_phone'] ?></span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-chat"></i><span class="fw-semibold mx-2">KRA:</span> <span><?= $structural['structural_kra'] ?></span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-envelope"></i><span class="fw-semibold mx-2">Email:</span>
                            <span style="width: 200px;"><?= $structural['structural_email'] ?></span>
                        </li>
                    </ul>
                    <a class="btn btn-outline-primary MyNewNew" href="edit_structural?id=<?= $_GET['id'] ?>">Edit structural's Details</a>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7 col-md-7">

            <div class="card card-action mb-4">
                <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0"><i class="bx bx-list-ul me-2"></i>Project Assigned</h5>
                </div>

                <div class="card-body">
                    <?php
                    if (!empty($properties)) { ?>
                        <form role="form" enctype="multipart/form-data" method="post" action="<?= model_url ?>houses">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <?php
                                    foreach ($properties as $key => $val) {
                                        // Check if the property ID is in the string
                                        $checked = strpos($string, $val['property_id']) !== false ? "checked" : "";
                                    ?>
                                        <div class="form-check mt-2">
                                            <div class="row">
                                                <div class="col-8">
                                                    <input class="form-check-input mr-2" <?= $checked ?> type="checkbox" name="property_id[]" value="<?= $val['property_id'] ?>" id="<?= $val['property_id'] ?>">
                                                    <?= $val['property_name'] ?>
                                                </div>
                                                <div class="col-2">
                                                    <?= $rate ?>
                                                </div>
                                                <div class="col-2">
                                                    <?= $cost ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <input hidden name="structural_id" value="<?= $id ?>" />
                           
                           <button type="submit" id="submit" class="btn btn-outline-primary MyNewNew"  >Edit Properties</button>
                        </form>
                    <?php
                    } else {
                        echo 'Add properties';
                    }
                    ?>
                </div>
            </div>
            
            
            
            <!--/ Connections -->
           
        </div>

        </div>
        <!--/ Activity Timeline -->
        
    </div>
</div>


<style>
.MyNewNew{
        text-align: center;
    display: block;
    margin: auto;
    width: fit-content;
}

</style>



<?php include_once 'footer.php'; ?>