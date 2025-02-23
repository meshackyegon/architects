<?php
$page        = 'property';
require_once 'header.php';

if (!isset($_GET['id'])) redirect_header(admin_url . 'view_properties');

$id = security('id', 'GET');



$units  = get_units($id);

if (!empty($units)) {
    session_assignment(array(
        'edit' => $units['property_unit_id']
    ), false);
    $require = false;
} else {
    $require = true;
}

$type    = empty($units) ? 'Add' : 'Edit';

?>
<div class="container-fluid">
    <form role="form" enctype="multipart/form-data" method="post" id="quickForm" action="<?= model_url ?>units">
        <div class="card-body">

            <div class="row">
                <div id="property_unit_container">
                    <div class="unit">
                        <p class="MyText">VACANT UNIT# 1</p>
                        <div class="row">
                            <div class="col-4 form-group">
                                <label for="name1">Unit Name:</label>
                                <input class="form-control" type="text" name="property_unit[0][property_unit_name]" id="name1" required>
                            </div>
                            <div class="col-4 form-group">
                                <label for="price1">Unit Price:</label>
                                <input class="form-control" type="number" name="property_unit[0][property_unit_price]" id="price1" required>
                            </div>

                            <div class="col-4 form-group ">
                                <label for="type1">Unit/Room Type:</label>
                                <select class="form-control" name="property_unit[0][property_unit_type]" id="type1">
                                    <option value="Bedsitter">Bedsitter</option>
                                    <option value="One_Bedroom">One Bedroom</option>
                                    <option value="Two_Bedrooms">Two Bedroom</option>
                                    <option value="Three_Bedrooms">Three Bedroom</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>

                <button style="margin-bottom:100px;margin-top:10px;" class="btn btn-primary" type="button" id="add_unit">Add Another Unit</button>

            </div>
            <input hidden name="property_id" value="<?= $id ?>">
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

            <?= submit('Submit', 'dark', 'text-center'); ?>

        </div>
    </form>
</div>
<!-- End of Main Content -->

<style>
    .form-group {
        margin-top: 10px;
    }

    .HeaderTxt {
        margin: 1.2em 0em;
        font-size: 1.5em;
        font-weight: 700;
        text-align: center;
    }

    .MyImgStyle {
        border-radius: 5%;
        width: 200px;
        height: auto;
        border-color: grey;
        border-style: solid;
    }
</style>

<script>
    $(document).ready(function() {
        var valueClassCount = 1;

        // Add Value Class
        $('#add_unit').click(function() {
            valueClassCount++;
            var html = '<div class="unit">';
            html += '<p class="MyText">VACANT UNIT# ' + valueClassCount + '</p>';

            html += '<div class="row">';

            html += '<div class="col-4 form-group">';
            html += '<label for="name' + valueClassCount + '">Unit Name:</label>';
            html += '<input class="form-control" type="text" name="property_unit[' + (valueClassCount - 1) + '][property_unit_name]" id="name' + valueClassCount + '" required>';
            html += '</div>';

            html += '<div class="col-4 form-group">';
            html += '<label for="price' + valueClassCount + '">Unit Price:</label>';
            html += '<input class="form-control"  type="number" name="property_unit[' + (valueClassCount - 1) + '][property_unit_price]" id="price' + valueClassCount + '" required>';
            html += '</div>';

            html += '<div class="col-4 form-group">';
            html += '<label for="type' + valueClassCount + '">Unit/Room Type:</label>';
            html += '<select class="form-control" name="property_unit[' + (valueClassCount - 1) + '][property_unit_type]" id="type' + valueClassCount + '">';
            html += '<option value="Bedsitter">Bedsitter</option>';
            html += '<option value="One_Bedroom">One Bedroom</option>';
            html += '<option value="Two_Bedrooms">Two Bedroom</option>';
            html += '<option value="Three_Bedrooms">Three Bedroom</option>';
            html += '</select>';
            html += '</div>';

            html += '</div>';


            html += '<div class="row" style="justify-content: flex-end;align-items: flex-end;">';
            html += '<button type="button" class="delete_unit btn btn-danger" style="width:100px;" data-count="' + valueClassCount + '"> <i class="fa-solid fa-trash"></i> </button>'; // Add delete button
            html += '</div>';
            html += '</div>';
            $('#property_unit_container').append(html);
            updateDeleteButtons();
        });

        // Function to update delete buttons
        function updateDeleteButtons() {
            // Disable delete button if there's only one value class
            $('.delete_unit').prop('disabled', valueClassCount === 1);
        }

        // Delete Value Class
        $(document).on('click', '.delete_unit', function() {
            $(this).closest('.unit').remove();
            valueClassCount--;
            updateDeleteButtons();
        });
    });
</script>

<style>
    .MyText {
        text-align: center;
        font-weight: 800;
    }
</style>


<?php include_once 'footer.php'; ?>