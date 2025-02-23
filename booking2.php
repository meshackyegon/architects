<?php
include_once 'header.php';

$property   = get_single_property(security('id', 'GET'));
$id         = $property['property_id'];
// cout($property);

$property_units    = get_by_column('property_unit', 'property_id', $id);


 $session_login  = array(
        'user_login'        => true,
        'user_email'        => 'pmanyara97@gmail.com',
        'user_name'         => 'Mugambi Manyara',
        'user_id'           => 't3JCHT8PK5F',
        'success'           => array('login' => 204)
    );

    session_assignment($session_login);

?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<div class="ltn__checkout-area mb-105">
    <div class="container">
        <div class="row">
            <?php
            if (!isset($_SESSION['user_login'])) { ?>
                <!-- LOGIN AREA START -->
                    <div class="container">

                        <div class="row">
                            <div class="col-lg-12">
                                <p>If you dont have an account, <a style="font-weight: 900;color: #007fff;" href="register?from=booking?id=<?= $_GET['id'] ?>">Create An Account Now.</a> </p>
                                <div class="account-login-inner">
                                    <form action="<?= model_url ?>user_login&from=booking?id=<?= $_GET['id'] ?>" method="POST">
                                        <input type="text" required name="user_email" placeholder="Email*">
                                        <input type="password" required name="user_password" placeholder="Password*">
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
                <!-- LOGIN AREA END -->
            <?php
            } else {
                $user = get_by_id('user', $_SESSION['user_id']);
            ?>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-12">

                        <div class="booking-form">
                            <h2>Booking Form</h2>
                            <form action="<?= model_url ?>booking" method="post">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <label for="name">Name:</label>
                                        <input type="text" id="name" value="<?= $user['user_name'] ?>" disabled name="name" required>

                                        <label for="email">Email:</label>
                                        <input type="email" id="email" value="<?= $user['user_email'] ?>" disabled name="email" required>

                                        <label for="kra">KRA Pin:</label>
                                        <input type="text" id="kra" value="<?= $user['user_kra'] ?>" disabled name="kra" required>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <label for="phone">Phone Number:</label>
                                        <input type="text" id="phone" value="<?= $user['user_phone'] ?>" disabled name="phone" required>

                                        <label for="email">ID/Passport Number:</label>
                                        <input type="text" id="passport" value="<?= $user['user_passport'] ?>" disabled name="passport" required>


                                        <label for="dob">Date of Birth</label>
                                        <input type="text" id="dob" value="<?= $user['user_dob'] ?>" disabled name="dob" required>

                                    </div>
                                </div>

                                <label for="check-in">When Are You Planning On Moving In:</label>
                                <input type="date" id="check-in" name="check_in" required>

                                <label for="property_unit_id">Select Unit:</label>
                                <select id="property_unit_id" name="property_unit_id" required>
                                    <option value="">Select Unit</option>
                                    <?php foreach ($property_units as $unit) : ?>
                                        <option value="<?php echo $unit['property_unit_id']; ?>" data-price="<?php echo $unit['property_unit_price']; ?>">
                                            <?php echo $unit['property_unit_name'] . ' - ' . $unit['property_unit_type'] . ' - Ksh' . number_format($unit['property_unit_price']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <label for="name">Next of Kin's Name:</label>
                                        <input type="text" id="kin_name" value="<?= $user['kin_name'] ?>" disabled name="kin_name" required>

                                      

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <label for="phone">Next of Kin's Phone Number:</label>
                                        <input type="text" id="kin_phone" value="<?= $user['kin_phone'] ?>" disabled name="kin_phone" required>


                                    </div>
                                </div>
                                
                                
                       

                                <div>
                                    <h4 style="text-align:center;margin-top:10px;">Standing Order Information</h4>
                                </div>

                                <label for="amount_figures">Amount (in figures):</label>
                                <input type="text" id="amount_figures" name="amount_figures" disabled placeholder="Enter amount in figures">

                                <label for="day_of_month">Which Day of each month:</label>
                                <input type="number" id="day_of_month" name="day_of_month" placeholder="Enter day of month">

                                <label for="start_date">Starting From:</label>
                                <input type="date" id="start_date" name="start_date" placeholder="Enter start date (YYYY/MM/DD)">

                                <div class="clearfix"></div>

                                <p style="font-weight: 700;">
                                    I hereby request and authorise you to transfer the amount specified above on the specified date of each and every month commencing
                                    on the date provided above until advised otherwise.

                                </p>

                                <label>
                                    <input type="checkbox" id="terms_agreement" name="terms_agreement" required>
                                    I agree to the <a href="#">Terms and conditions</a>.
                                </label>

                                <input hidden name="property_id" value="<?= $id ?>" />
                                <input hidden name="user_id" value="<?= $_SESSION['user_id'] ?>" />

                                <input type="submit" id="submit" disabled value="Book Now">
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">

                        <div class="property-details">
                            <h2><?php echo $property['property_name']; ?></h2>
                            <p><strong>Location:</strong> <?php echo $property['property_location']; ?></p>
                            <p><strong>Description:</strong> <?php echo $property['property_description']; ?></p>
                            <p><strong>Price Details:</strong> <?php echo $property['property_price_details']; ?></p>
                            <div class="property-image">
                                <img src="<?php echo file_url . $property['property_image']; ?>" alt="<?php echo $property['property_name']; ?>">
                            </div>
                        </div>

                    </div>
                </div>


            <?php

            }
            ?>
        </div>
    </div>
</div>





<script>
    $(document).ready(function() {

        $('#motor_car').click(function() {
            $('#myModal2').modal('show');
        });


        $('.myClose').click(function() {
            $('#myModal').modal('hide');
        });

        $('.myClose2').click(function() {
            $('#myModal2').modal('hide');
        });

        $("#property_unit_id").change(function() {
            var selectedOption = $(this).find(":selected");
            var price = selectedOption.data("price");
            $("#amount_figures").val(price);
        });



    })
</script>



<script>
    document.getElementById("terms_agreement").addEventListener("change", function() {
        document.getElementById("submit").disabled = !this.checked;
    });
</script>

<style>
    .modal {
        z-index: 9999999999999 !important;
    }

    .property-details,
    .booking-form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .property-details {
        /*flex: 1;*/
        margin-right: 20px;
    }

    .booking-form {
        /*flex: 1;*/
    }

    h2 {
        margin-top: 0;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="number"],
    input[type="text"],
    input[type="email"],
    input[type="date"],
    input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        background-color: #1da1f2;
        color: #fff;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0d8eff;
    }

    .property-details h2 {
        margin-top: 0;
    }

    .property-details p {
        margin: 10px 0;
    }

    .property-image {
        flex: 1;
    }

    .property-image img {
        max-width: 100%;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .nice-select {
        width: 100% !important;
    }

    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }

    @media (max-width: 768px) {

        .property-details,
        .booking-form {
            width: 100%;
            margin-right: 0;
            margin-bottom: 20px;
        }
    }
</style>

<?php include_once 'footer.php'; ?>