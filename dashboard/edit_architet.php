<?php
$page        = 'architect';
require_once 'header.php';

$current_year   = date("Y");

$architect = get_by_id('architect', security('id', 'GET'));

if (!empty($architect)) {
    session_assignment(array(
        'edit' => $architect['architect_id']
    ), false);
    $require = false;
} else {
    $require = true;
}

$Properties = get_all('property');
?>
<div class="container-fluid">
 
    <form enctype="multipart/form-data" action="<?= model_url ?>edit_architect" method="POST">
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <br>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Architect's Name", "architect_name", $architect, true);
                        input_hybrid("Architect's Phone Number", "architect_phone", $architect, true);
                        input_hybrid("Architect's Email", "architect_email", $architect, true, 'email');
                        input_hybrid("Architect's ID Number", "architect_passport", $architect, true);
                        input_hybrid("Architect's KRA Pin", "architect_kra", $architect, true);
                        input_select('Role As:', 'role', $row, true, array('senior', 'junior',));
                        ?>
                    </div>

                </div>

                <div class="divider MyDiver">
                    <div class="divider-text">Next of Kin</div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php

                        input_hybrid("Next of Kin's Name", "kin_name", $architect, true);
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php

                        input_hybrid("Next of Kin's Phone Number", "kin_phone", $architect, true);
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