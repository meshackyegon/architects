<?php
include_once 'header.php';

?>

<!-- LOGIN AREA START -->
<div class="ltn__login-area pb-65">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Create A User Account</h1>
                    <p>If you'd like to sign up as a landlord or property owner, <a style="font-weight: 900;color: #007fff;" href="landlord_register">Click Me.</a> </p>
                </div>
            </div>
        </div>

        <div class="container">

            <div class="row">

                <div class="col-lg-12">
                    <div class="account-create text-center">
                        <form enctype="multipart/form-data" action="<?= model_url ?>mechanical_register" method="POST">
                            <div class="card shadow mb-4">
                                <div class="card-body card-secondary">
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <p>Required fields are marked **</p>
                                            <?php
                                            input_hybrid("Your Name**", "mechanical_name", $mechanical, false);
                                            input_hybrid("Your Phone Number (use 07...)**", "mechanical_phone", $mechanical, true);
                                            ?>

                                            <div class="form-group">
                                                <input class="form-control" type="email" name="mechanical_email" id="landlord_email" required placeholder="Enter Your Email" onBlur="checkAvailabilityEmailid()">
                                                <span id="emailid-availability" style="font-size:12px;"></span>
                                            </div>
                                            <input hidden name="mechanical_status" value="inactive" />

                                            <?php
                                            input_hybrid("Your ID Number**", "mechanical_passport", $mechanical, false);
                                            input_hybrid("Your Password**", "mechanical_password", $mechanical, true);
                                            input_hybrid("Your KRA Pin**", "mechanical_kra", $mechanical, false);
                                            
                                            ?>
                                        </div>

                                    </div>

                                    <div class="divider MyDiver">
                                        <div class="divider-text">Next of Kin Details</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <?php
                                            input_hybrid("Next of Kin's Name**", "kin_name", $mechanical, false);
                                            ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <?php
                                            input_hybrid("Next of Kin's Phone Number**", "kin_phone", $mechanical, false);
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
                </div>
            </div>
        </div>

    </div>
</div>
<!-- LOGIN AREA END -->

<!-- CALL TO ACTION START (call-to-action-6) -->
<div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bg="img/1.jpg--">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg text-center---">
                    <div class="coll-to-info text-color-white">
                        <h1>Looking for a dream home?</h1>
                        <p>We can help you realize your dream of a new home</p>
                    </div>
                    <div class="btn-wrapper">
                        <a class="btn btn-effect-3 btn-white" href="contact.html">Explore Properties <i class="icon-next"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function checkAvailabilityEmailid() {
        jQuery.ajax({
            url: "check_available.php",
            data: 'landlord_email=' + $("#landlord_email").val(),
            type: "POST",
            success: function(data) {
                $("#emailid-availability").html(data);
            },
            error: function() {}
        });
    }
</script>

<style>
    .nice-select {
        width: 100%;
        margin: 20px 0px;
        height: 60px;
    }

    label {
        display: none;
    }



    input {
        background-color: #fff;
        border: 2px solid;
        border-color: #e4ecf2;
        -webkit-box-shadow: none;
        box-shadow: none;
        padding-left: 20px;
        font-size: 16px;
        color: #5C727D;
        width: 100%;
        margin-bottom: 30px;
        border-radius: 0;
        padding-right: 40px;
        height: 65px !important;
    }

    .divider-text {
        font-weight: 700;
        margin: 20px 0px;
    }
</style>
<!-- CALL TO ACTION END -->
<?php include_once 'footer.php'; ?>