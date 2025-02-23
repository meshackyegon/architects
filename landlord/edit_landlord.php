<?php
$page        = 'profile';
require_once 'header.php';

$current_year   = date("Y");

// $profile = get_by_id('landlord', security('id', 'GET'));

if (!empty($profile)) {
    session_assignment(array(
        'edit' => $profile['landlord_id']
    ), false);
    $require = false;
} else {
    $require = true;
}

$Properties = get_all('property');
?>
<div class="container-fluid">

    <form enctype="multipart/form-data" action="<?= model_url ?>landlord_profile" method="POST">
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <br>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Your Name", "landlord_name", $profile, true);
                        input_hybrid("Your Phone Number", "landlord_phone", $profile, true);
                        input_hybrid("Your Email", "landlord_email", $profile, true, 'email');
                        input_hybrid("Your ID Number", "landlord_passport", $profile, true);
                        input_hybrid("Your KRA Pin", "landlord_kra", $profile, true);
                        ?>
                    </div>

                </div>

                <div class="divider MyDiver">
                    <div class="divider-text">Next of Kin</div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Next of Kin's Name", "kin_name", $profile, true);
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Next of Kin's Phone Number", "kin_phone", $profile, true);
                        ?>
                    </div>

                </div>



                <div class="divider MyDiver">
                    <div class="divider-text">Payment Details</div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Bank Name", "bank_name", $profile, true);
                        input_hybrid("Bank Account", "bank_account", $profile, true);
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Amount", "bank_amount", $profile, true, 'number');
                        input_hybrid("Date Of Payment", "bank_date", $profile, true, 'number');
                        ?>
                    </div>
                    
                </div>
                
                 <div class="divider MyDiver">
                    <div class="divider-text">Profile Image</div>
                </div>
                
                <div class="row">
                    
                    <div class="col-12">
                        <?php
                        if (!empty($profile['landlord_image'])) {
                            $require = false;
                            $profile_image = $profile['landlord_image'];
                        } else {
                            $require = false;
                            $profile_image = 'white_bg_image.png';
                        }
                        input_hybrid("Your Profile Pic", "landlord_image", $profile, $require, "file", 'my_img', '', 'img');
                        ?>

                        <img alt="image" src="<?= file_url . $profile_image ?>" id="img_loader" style="border-radius: 5%; border-color:grey; border-style: solid; height:auto; width: 60%;">
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