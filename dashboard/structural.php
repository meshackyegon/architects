<?php
$page        = 'structural';
require_once 'header.php';

$current_year   = date("Y");

$structural = get_by_id('structural', security('id', 'GET'));

if (!empty($structural)) {
    session_assignment(array(
        'edit' => $structural['prod_id']
    ), false);
    $require = false;
} else {
    $require = true;
}

$properties = get_all('property');
?>
<div class="container-fluid">
 
    <form enctype="multipart/form-data" action="<?= model_url ?>structural" method="POST">
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <br>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Sstructural's Name", "structural_name", $structural, true);
                        input_hybrid("Structural's Phone Number (use 07...)", "structural_phone", $structural, true);
                        input_hybrid("Structural's Email", "structural_email", $structural, true, 'email');
                        input_hybrid("Structural's ID Number", "structural_passport", $structural, false);
                        input_hybrid("Structural's Password", "structural_password", $structural, true);
                        input_hybrid("Structural's KRA Pin", "structural_kra", $structural, true);
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

                        input_hybrid("Next of Kin's Name", "kin_name", $structural, true);
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php

                        input_hybrid("Next of Kin's Phone Number", "kin_phone", $structural, true);
                        ?>
                    </div>

                </div>


                <div class="divider MyDiver">
                    <div class="divider-text">Properties</div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            
                        </div>
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