<?php
$page        = 'landlord';
require_once 'header.php';

$current_year   = date("Y");

$landlord = get_by_id('landlord', security('id', 'GET'));

if (!empty($landlord)) {
    session_assignment(array(
        'edit' => $landlord['prod_id']
    ), false);
    $require = false;
} else {
    $require = true;
}

$properties = get_all('property');
?>
<div class="container-fluid">
 
    <form enctype="multipart/form-data" action="<?= model_url ?>landlord" method="POST">
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <br>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Landlord's Name", "landlord_name", $landlord, true);
                        input_hybrid("Landlord's Phone Number (use 07...)", "landlord_phone", $landlord, true);
                        input_hybrid("Landlord's Email", "landlord_email", $landlord, true, 'email');
                        input_hybrid("Landlord's ID Number", "landlord_passport", $landlord, false);
                        input_hybrid("Landlord's Password", "landlord_password", $landlord, true);
                        input_hybrid("Landlord's KRA Pin", "landlord_kra", $landlord, true);
                        input_hybrid("Landlord's Commission in Percentage", "landlord_commission", $landlord, true);
                        ?>
                    </div>

                </div>

                <div class="divider MyDiver">
                    <div class="divider-text">Next of Kin</div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php

                        input_hybrid("Next of Kin's Name", "kin_name", $landlord, true);
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php

                        input_hybrid("Next of Kin's Phone Number", "kin_phone", $landlord, true);
                        ?>
                    </div>

                </div>


                <div class="divider MyDiver">
                    <div class="divider-text">Properties</div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="property"><?= ucfirst('Properties ') ?> : <?= !empty($property) ? $rules : '' ?> </label>
                            <select id="exampleFormControlSelect" multiple data-placeholder="Select number of properties under this landlord." class="select2 form-control" name="property_id[]">

                                <?php foreach ($properties as $b) {
                                    $property_id = $b['property_id'];
                                ?>
                                    <option value="<?= $property_id ?>"><?= ucwords($b['property_name']) ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>


                <div class="divider MyDiver">
                    <div class="divider-text">Payment Details</div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Bank Name", "bank_name", $landlord, false);
                        input_hybrid("Bank Account", "bank_account", $landlord, false);
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Amount", "bank_amount", $landlord, false, 'number');
                        input_hybrid("Date Of Payment", "bank_date", $landlord, false, 'number');
                        ?>
                    </div>

                </div>

            </div>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4 text-center">
            <div class="text-center">
                <button class="btn btn-primary" type="submit" id="submit">Submit</button>
            </div>
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

    .MyDiver {
        margin-top: 50px;
        margin-bottom: 25px;
    }
</style>



<?php include_once 'footer.php'; ?>