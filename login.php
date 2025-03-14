<?php
include_once 'header.php';
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<!-- LOGIN AREA START -->
<div class="ltn__login-area pb-65">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Sign In To Your Account</h1>

                </div>
            </div>
        </div>

        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <p>If you dont have an account, <a style="font-weight: 900;color: #007fff;" href="register">Create An Account Now.</a> </p>
                    <?php
                    input_select('Log In As:', 'user_type', $row, true, array('user','architect','electrical', 'mechanical','structural',));
                    
                    ?>
                    <div class="account-login-inner">
                        <form id="user_login" action="<?= model_url ?>user_login&from=index" method="POST">

                            <input type="text" required name="user_email" placeholder="Enter Your Email*">
                            <input type="password" required name="user_password" placeholder="Enter Your Password*">
                            <div class="btn-wrapper mt-0">
                                <button class="theme-btn-1 btn btn-block" type="submit">LOG IN</button>
                            </div>
                            <div class="go-to-btn mt-20">
                                <a href="#" title="Forgot Password?" data-toggle="modal" data-target="#ltn_forget_password_modal"><small>FORGOTTEN YOUR PASSWORD?</small></a>
                            </div>
                        </form>

                        <form id="architect_login" action="<?= model_url ?>architect_login" method="POST">

                            <input type="text" required name="architect_email" placeholder="Enter Your Email*">
                            <input type="password" required name="architect_password" placeholder="Enter Your Password*">
                            <div class="btn-wrapper mt-0">
                                <button class="theme-btn-1 btn btn-block" type="submit">LOG IN</button>
                            </div>
                            <div class="go-to-btn mt-20">
                                <a href="#" title="Forgot Password?" data-toggle="modal" data-target="#ltn_forget_password_modal"><small>FORGOTTEN YOUR PASSWORD?</small></a>
                            </div>
                        </form>
                        <form id="structural_login" action="<?= model_url ?>structural_login" method="POST">

                            <input type="text" required name="structural_email" placeholder="Enter Your Email*">
                            <input type="password" required name="structural_password" placeholder="Enter Your Password*">
                            <div class="btn-wrapper mt-0">
                                <button class="theme-btn-1 btn btn-block" type="submit">LOG IN</button>
                            </div>
                            <div class="go-to-btn mt-20">
                                <a href="#" title="Forgot Password?" data-toggle="modal" data-target="#ltn_forget_password_modal"><small>FORGOTTEN YOUR PASSWORD?</small></a>
                            </div>
                        </form>
                        <form id="electrical_login" action="<?= model_url ?>electrical_login" method="POST">

                            <input type="text" required name="electrical_email" placeholder="Enter Your Email*">
                            <input type="password" required name="electrical_password" placeholder="Enter Your Password*">
                            <div class="btn-wrapper mt-0">
                                <button class="theme-btn-1 btn btn-block" type="submit">LOG IN</button>
                            </div>
                            <div class="go-to-btn mt-20">
                                <a href="#" title="Forgot Password?" data-toggle="modal" data-target="#ltn_forget_password_modal"><small>FORGOTTEN YOUR PASSWORD?</small></a>
                            </div>
                        </form>
                         <form id="mechanical_login" action="<?= model_url ?>mechanical_login" method="POST">

                            <input type="text" required name="mechanical_email" placeholder="Enter Your Email*">
                            <input type="password" required name="mechanical_password" placeholder="Enter Your Password*">
                            <div class="btn-wrapper mt-0">
                                <button class="theme-btn-1 btn btn-block" type="submit">LOG IN</button>
                            </div>
                            <div class="go-to-btn mt-20">
                                <a href="#" title="Forgot Password?" data-toggle="modal" data-target="#ltn_forget_password_modal"><small>FORGOTTEN YOUR PASSWORD?</small></a>
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

<style>
    #landlord_login {
        display: none;
    }
   

    input {
        width: 100%;
    }

    .nice-select {
        width: 100%;
        margin: 20px 0px;
        height: 60px;
    }

    label {
        display: none;
    }
</style>

<script>
    $(document).ready(function() {
    // Hide all login forms initially
    $('.account-login-inner form').hide();

    // Show the default login form (user login)
    $('#user_login').show();

    $('#user_type').change(function() {
        var selectedValue = $(this).val();

        // Hide all forms
        $('.account-login-inner form').hide();

        // Show the selected form based on user type
        if (selectedValue) {
            $('#' + selectedValue + '_login').show();
        }
    });
});

</script>

<!-- CALL TO ACTION END -->
<?php include_once 'footer.php'; ?>