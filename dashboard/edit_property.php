<?php
$page        = 'property';
require_once 'header.php';

$current_year   = date("Y");

$id = security('id', 'GET');

$property = get_by_id('property',$id);

if (!empty($property)) {
    session_assignment(array(
        'edit' => $property['property_id']
    ), false);
    $require = false;
} else {
    $require = true;
}



?>
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <form enctype="multipart/form-data" action="<?= model_url ?>edit_property" method="POST">
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">



                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                        <?php
                       
                        input_hybrid("What is Your Property Name/Title", "property_name", $property, true);
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                        <?php
                        
                        input_select('What is your space?', 'property_type', $property, true, array('house', 'bungalow', 'maisonette', 'apartment', 'bed and breakfast'));
                        ?>
                    </div>
                </div>

                <div class="divider MyDiver">
                    <div class="divider-text">Pricing Details</div>
                </div>


                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                        <?php

                        input_select('Does the Property Have Multiple Units?', 'has_unit', $property, true, array('yes', 'no'));
                        input_hybrid("Total number of units  (optional)", "property_units", $property, false, 'number');
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                        <?php
                        input_select('Stay', 'property_stay', $property, true, array('Short Term', 'Long Term'));
                         input_hybrid("Number of Vacant Units (optional)", "property_vacant", $property, false, 'number');
                        ?>
                    </div>
                </div>



                <div id="yesyes">

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                            <?php
                            input_hybrid("Rent for one bedroom (optional)", "one_bedroom", $property, false, 'number');
                            input_hybrid("Rent for two bedroom (optional)", "two_bedroom", $property, false, 'number');
                            ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                            <?php
                            input_hybrid("Rent for bedsitter (optional)", "bedsitter", $property, false, 'number');
                            input_hybrid("Rent for ground floor units (optional)", "ground_floor", $property, false, 'number');
                            ?>
                        </div>
                    </div>

                </div>

                <div id="nono">

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php
                            input_hybrid("Property Price", "property_price", $property, false, 'number');
                            ?>
                        </div>

                    </div>

                </div>


                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                        <?php
                        input_hybrid("Cost for garbage/service (optional)", "property_garbage", $property, false, 'number');
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                        <?php
                        input_hybrid("Cost for water (optional)", "property_water", $property, false, 'number');
                        ?>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_select('Payment Details', 'property_price_details', $property, true, array('1 Month Deposit and 1 Month Rent', '2 Months Deposit and 1 Month Rent', '3 Months Deposit and 1 Month Rent'));
                        ?>
                    </div>
                </div>

        


                <div class="divider MyDiver">
                    <div class="divider-text">Location</div>
                </div>
                <p><b>Map Link:</b> Go to Google Maps and type in the location of the property, click on the <b>Share icon</b> on the left sidebar and copy the <b>Link for sharing</b>.
                    It generally looks like this: <i>https://goo.gl/maps/abc123</i> </p>
                <br>


                <div class="row">
                    <div class="col-12">
                        <?php
                        input_hybrid("City", "property_city", $property, false);
                        input_hybrid("Location", "property_location", $property, false);
                        textarea_input("Add Map Link", "property_map", $property, false);
                        ?>
                    </div>
                </div>

                <input hidden name="property_id" value="<?= $id ?>" />



                <div class="divider MyDiver">
                    <div class="divider-text">Images</div>
                </div>




                <div class="row">
                    <div class="col-12">
                        <?php
                        if (!empty($property['property_image'])) {
                            $require = false;
                            $property_image = $property['property_image'];
                        } else {
                            $require = true;
                            $property_image = 'white_bg_image.png';
                        }
                        input_hybrid("First Image", "property_image", $property, $require, "file", 'my_img', '', 'img');
                        ?>

                        <img alt="image" src="<?= file_url . $property_image ?>" id="img_loader" style="border-radius: 5%; border-color:grey; border-style: solid; height:auto; width: 60%;">
                    </div>


                    <div class="col-12">
                        <?php
                        if (!empty($property['property_image2'])) {
                            $require = false;
                            $property_image2 = $property['property_image2'];
                        } else {
                            $require = true;
                            $property_image2 = 'white_bg_image.png';
                        }
                        input_hybrid("Second Image", "property_image2", $property, false, "file", 'my_image1', '', 'img');
                        ?>

                        <img alt="image" src="<?= file_url . $property_image2 ?>" id="image_loader1" style="border-radius: 5%; border-color:grey; border-style: solid; height:auto; width: 60%;">
                    </div>
                </div>






                <div class="divider MyDiver">
                    <div class="divider-text">Features and Description</div>
                </div>



                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                        <?php
                        input_hybrid("Rent due on: (optional)", "due", $property, false, 'date');
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                        <?php
                        input_select('Number of Bathrooms', 'property_bathrooms', $property, true, array(1, 2, 3, 4, 5, 6));
                        ?>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <?php
                        textarea_input("Description", "property_description", $property, true);
                        textarea_input("Cancellation Policy", "property_policy", $property, false);

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

    #yesyes,
    #nono {
        display: none;
    }

    .HeaderTxt {
        margin: 1.2em 0em;
        font-size: 1.5em;
        font-weight: 700;
        text-align: center;
    }

    .MyDiver {
        margin-top: 100px;
        margin-bottom: 50px;
    }
</style>

<script>
    $(document).ready(function() {
        var selectedValue;
        $('#has_unit').change(function() {
            selectedValue = $(this).val()
            if (selectedValue == 'yes') {
                $('#yesyes').css('display', 'block');
                $('#nono').css('display', 'none');
                $('#property_units').prop('disabled', false).val('');
            } else {
                $('#yesyes').css('display', 'none');
                $('#nono').css('display', 'block');
                $('#property_units').prop('disabled', true).val('1');
            }
        })
    });
</script>



<?php include_once 'footer.php'; ?>