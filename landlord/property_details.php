<?php
$page        = 'property';
require_once 'header.php';

$current_year   = date("Y");
$id = security('id', 'GET');
$property = get_by_id('property', security('id', 'GET'));
$sql = "SELECT * FROM property_unit WHERE property_id = '$id' ";
$rows = select_rows($sql);

$amenities = get_all('amenities');
$added = get_by_id("admin", $property['added_by'])['admin_name'];    
if(empty($added)){
    $added = get_by_id("landlord", $property['added_by'])['landlord_name']; 
} 
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><?= $property['property_name'] ?> </h4>
    <div class="row">
        <!-- User Sidebar -->
        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
            <!-- User Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <img class="img-fluid rounded my-4" src="<?= file_url . $property['property_image'] ?>" height="110" width="110" alt="User avatar" />
                            <div class="user-info text-center">
                                <h4 class="mb-2"><?= $property['property_name'] ?></h4>
                                <span class="badge bg-label-secondary">Added by <?= $added ?></span>
                            </div>
                        </div>
                    </div>

                    <h5 class="pb-2 border-bottom mt-4 mb-4">Details</h5>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <span class="fw-bold me-2">Price/type:</span>
                                <span><?= $property['property_price'] ?></span>
                            </li>

                            <li class="mb-3">
                                <span class="fw-bold me-2">Vacant:</span>
                                <span><?= $property['property_vacant'] ?></span>
                            </li>

                            <li class="mb-3">
                                <span class="fw-bold me-2">Price Plan:</span>
                                <span><?= $property['property_price_details'] ?></span>
                            </li>

                            <li class="mb-3">
                                <span class="fw-bold me-2">location:</span>
                                <span><?= $property['property_location'] ?></span>
                            </li>

                            <?php
                            if ($property['property_water'] != NULL) { ?>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Water:</span>
                                    <span><?= $property['property_water'] ?></span>
                                </li>
                            <?php
                            }
                            ?>

                            <?php
                            if ($property['property_garbage'] != NULL) { ?>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Service fee:</span>
                                    <span><?= $property['property_garbage'] ?></span>
                                </li>
                            <?php
                            }
                            ?>




                            <?php
                            if ($property['property_bedrooms'] != NULL) { ?>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Bedrooms:</span>
                                    <span><?= $property['property_bedrooms'] ?></span>
                                </li>
                            <?php
                            }
                            ?>





                        </ul>
                        <!--<div class="d-flex justify-content-center pt-3">-->
                        <!--    <a href="#" class="btn btn-primary me-3">Edit</a>-->
                        <!--    <a href="javascript:;" class="btn btn-label-danger suspend-user">Delete</a>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
            <!-- /User Card -->
        </div>
        <!--/ User Sidebar -->

        <!-- User Content -->
        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">


            <div class="card mb-4" style="padding:1em;">
                <h3 class="card-header" style="text-align:center;font-weight:800;">Units</h3>

                <form action="<?= model_url ?>edit_units" method="post">
                    <input hidden name="property_id" value="<?= $id ?>" />
                    <div id="edit_property_form">
                        <!-- Loop through each value class -->
                        <?php foreach ($rows as $index => $valueClass) : ?>

                            <div class="unit" data-index="<?= $index; ?>">
                                <div class="row">
                                    <div class="col-12 form-group">
                                        <label for="name<?= $index; ?>">Unit Name:</label>
                                        <input class="form-control" type="text" name="property_unit[<?= $index; ?>][property_unit_name]" id="name<?= $index; ?>" value="<?= $valueClass['property_unit_name']; ?>" required>
                                    </div>

                                    <div class="col-12 form-group">
                                        <label for="type<?= $index; ?>">Unit Type: <?= $valueClass['property_unit_type']; ?> </label>
                                        <select name="property_unit[<?= $index; ?>][property_unit_type]" id="type<?= $index; ?>" class="form-control" >
                                            <?php if (!empty($valueClass['property_unit_type'])) { ?>
                                                <option value="<?= $valueClass['property_unit_type']; ?>" selected><?= $valueClass['property_unit_type']; ?></option>
                                                <option disabled>Select Unit Type</option>
                                            <?php } else { ?>
                                                <option selected disabled>Select Unit Type</option>
                                            <?php } ?>
                                            <option value="Bedsitter">Bedsitter</option>
                                            <option value="One_Bedroom">One Bedroom</option>
                                            <option value="Two_Bedrooms">Two Bedroom</option>
                                            <option value="Three_Bedrooms">Three Bedroom</option>
                                        </select>
                                    </div>


                                    <div class="col-12 form-group">
                                        <label for="price<?= $index; ?>">Price:</label>
                                        <input class="form-control"  type="number" name="property_unit[<?= $index; ?>][property_unit_price]" id="price<?= $index; ?>" value="<?= $valueClass['property_unit_price']; ?>" required>
                                    </div>
                                </div>
                                <div class="row" style="justify-content: flex-end;align-items: flex-end;padding-right: 2em;">
                                    <button type="button" class="delete_property_unit btn btn-danger" style="width:100px;"> <i class="fa-solid fa-trash"></i> </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Button to add new value class -->
                    <button type="button" style="margin-bottom:10px;margin-top:10px;" class="btn btn-primary" id="add_property_unit">Add Another Unit</button>

                    <!-- Submit Button -->
                    <div>
                        <input type="submit" class="btn btn-info" value="Update Property">
                    </div>
                </form>

            </div>




            <div class="card mb-4">
                <h5 class="card-header">Features</h5>

                <form action="<?= model_url ?>edit_amenities" method="post">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php
                                foreach ($amenities as $key => $val) {
                                    $sql = "SELECT * FROM features WHERE property_id = '$id' and amenities_id = '$val[amenities_id]'";
                                    $r = select_rows($sql);
                                    $p = false;
                                    if (!empty($r)) {
                                        $p = true;
                                    }
                                ?>
                                    <div class="form-check">
                                        <input class="form-check-input" <?= $p ? "checked" : "" ?> type="checkbox" name="amenities_id[]" value="<?= $val['amenities_id'] ?>" id="<?= $val['amenities_id'] ?>">
                                        <label class="form-check-label" for="<?= $val['id'] ?>">
                                            <?= $val['amenities_name'] ?>
                                        </label>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                            <input hidden name="property_id" value="<?= $id ?>">

                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                        <?= submit('Submit', 'dark', 'text-center'); ?>

                    </div>
                </form>
            </div>

        </div>
        <!--/ User Content -->
    </div>


</div>

<style>
    .fw-bold {
        text-transform: capitalize;
    }
</style>


<script>
    $(document).ready(function() {
        // Add Unit
        $('#add_property_unit').click(function() {
            var index = $('.unit').length; // Get the current number of units
            var html = '<div class="unit" data-index="' + index + '">';
            html += '<div class="row">';
            html += '<div class="col-12 form-group">';
            html += '<label for="name' + index + '">Unit Name:</label>';
            html += '<input class="form-control"   type="text" name="property_unit[' + index + '][property_unit_name]" id="name' + index + '" required>';
            html += '</div>';
            html += '<div class="col-12 form-group">';
            html += '<label for="type' + index + '">Unit Type:</label>';
            html += '<select class="form-control"   name="property_unit[' + index + '][property_unit_type]" id="type' + index + '">';
            html += '<option selected disabled>Select Unit Type</option>';
            html += '<option value="Bedsitter">Bedsitter</option>';
            html += '<option value="One_Bedroom">One Bedroom</option>';
            html += '<option value="Two_Bedrooms">Two Bedroom</option>';
            html += '<option value="Three_Bedrooms">Three Bedroom</option>';
            html += '</select>';
            html += '</div>';
            html += '<div class="col-12 form-group">';
            html += '<label for="price' + index + '">Price:</label>';
            html += '<input class="form-control"   type="number" name="property_unit[' + index + '][property_unit_price]" id="price' + index + '" required>';
            html += '</div>';
            html += '</div>';
            html += '<div class="row" style="justify-content: flex-end;align-items: flex-end;padding-right: 2em;">';
            html += '<button type="button" class="delete_property_unit btn btn-danger" style="width:100px;"> <i class="fa-solid fa-trash"></i> </button>';
            html += '</div>';
            html += '</div>';
            $('#edit_property_form').append(html);
        });

        // Delete Unit
        $(document).on('click', '.delete_property_unit', function() {
            $(this).closest('.unit').remove();
        });
    });
</script>


<?php include_once 'footer.php'; ?>