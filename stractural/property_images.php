<?php
$page        = 'property';
require_once 'header.php';

if (!isset($_GET['id'])) redirect_header(admin_url . 'view_properties');

$id = security('id', 'GET');



$images  = get_image($id);

if (!empty($images)) {
    session_assignment(array(
        'edit' => $images['property_image_id']
    ), false);
    $require = false;
} else {
    $require = true;
}

$type    = empty($images) ? 'Add' : 'Edit';

?>
<div class="container-fluid">
    <form role="form" enctype="multipart/form-data" method="post" id="quickForm" action="<?= model_url ?>image">
        <div class="card-body">

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                    <!-- IMAGE ONE -->
                    <?php
                    $require = false;
                    $property_image_1 = 'white_bg_image.png';
                    if (!empty($images['property_image_1'])) {
                        $require = false;
                        $property_image_1 = $images['property_image_1'];
                    }

                    input_hybrid("First Image", "property_image_1", $images, $require, "file", 'my_image1', '', 'img');
                    ?>

                    <img alt="First Image" src="<?= file_url . $property_image_1 ?>" id="image_loader1" class="MyImgStyle">



                    <!-- IMAGE THREE -->

                    <?php
                    $require = false;
                    $property_image_3 = 'white_bg_image.png';
                    if (!empty($images['property_image_3'])) {
                        $require = false;
                        $property_image_3 = $images['property_image_3'];
                    }

                    input_hybrid("Third Image", "property_image_3", $images, false, "file", 'my_image3', '', 'img');
                    ?>

                    <img alt="Third Image" src="<?= file_url . $property_image_3 ?>" id="image_loader3" class="MyImgStyle">



                    <!-- IMAGE FIVE -->

                    <?php
                    $require = false;
                    $property_image_5 = 'white_bg_image.png';
                    if (!empty($images['property_image_5'])) {
                        $require = false;
                        $property_image_5 = $images['property_image_5'];
                    }

                    input_hybrid("Fifth Image", "property_image_5", $images, false, "file", 'my_image5', '', 'img');
                    ?>

                    <img alt="Fifth Image" src="<?= file_url . $property_image_5 ?>" id="image_loader5" class="MyImgStyle">


                    <!-- IMAGE SEVEN -->

                    <?php
                    $require = false;
                    $property_image_7 = 'white_bg_image.png';
                    if (!empty($images['property_image_7'])) {
                        $require = false;
                        $property_image_7 = $images['property_image_7'];
                    }

                    input_hybrid("Seventh Image", "property_image_7", $images, false, "file", 'my_image7', '', 'img');
                    ?>

                    <img alt="Seventh Image" src="<?= file_url . $property_image_7 ?>" id="image_loader7" class="MyImgStyle">



                    <!-- IMAGE NINE -->

                    <?php
                    $require = false;
                    $property_image_9 = 'white_bg_image.png';
                    if (!empty($images['property_image_9'])) {
                        $require = false;
                        $property_image_9 = $images['property_image_9'];
                    }

                    input_hybrid("Nineth Image", "property_image_9", $images, false, "file", 'my_image9', '', 'img');
                    ?>

                    <img alt="Nineth Image" src="<?= file_url . $property_image_9 ?>" id="image_loader9" class="MyImgStyle">


                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                    <!-- IMAGE TWO -->
                    <?php
                    $require = false;
                    $property_image_2 = 'white_bg_image.png';
                    if (!empty($images['property_image_2'])) {
                        $require = false;
                        $property_image_2 = $images['property_image_2'];
                    }

                    input_hybrid("Second Image", "property_image_2", $images, $require, "file", 'my_image2', '', 'img');
                    ?>

                    <img alt="Second Image" src="<?= file_url . $property_image_2 ?>" id="image_loader2" class="MyImgStyle">


                    <!-- IMAGE FOUR -->
                    <?php
                    $require = false;
                    $property_image_4 = 'white_bg_image.png';
                    if (!empty($images['property_image_4'])) {
                        $require = false;
                        $property_image_4 = $images['property_image_4'];
                    }

                    input_hybrid("Four Image", "property_image_4", $images, $require, "file", 'my_image4', '', 'img');
                    ?>

                    <img alt="Four Image" src="<?= file_url . $property_image_4 ?>" id="image_loader4" class="MyImgStyle">



                    <!-- IMAGE SIX -->
                    <?php
                    $require = false;
                    $property_image_6 = 'white_bg_image.png';
                    if (!empty($images['property_image_6'])) {
                        $require = false;
                        $property_image_6 = $images['property_image_6'];
                    }

                    input_hybrid("Sixth Image", "property_image_6", $images, $require, "file", 'my_image6', '', 'img');
                    ?>

                    <img alt="Sixth Image" src="<?= file_url . $property_image_6 ?>" id="image_loader6" class="MyImgStyle">




                    <!-- IMAGE EIGHT -->
                    <?php
                    $require = false;
                    $property_image_8 = 'white_bg_image.png';
                    if (!empty($images['property_image_8'])) {
                        $require = false;
                        $property_image_8 = $images['property_image_8'];
                    }

                    input_hybrid("Eighth Image", "property_image_8", $images, $require, "file", 'my_image8', '', 'img');
                    ?>

                    <img alt="Eighth Image" src="<?= file_url . $property_image_8 ?>" id="image_loader8" class="MyImgStyle">


                    <!-- IMAGE TEN -->
                    <?php
                    $require = false;
                    $property_image_10 = 'white_bg_image.png';
                    if (!empty($images['property_image_10'])) {
                        $require = false;
                        $property_image_10 = $images['property_image_10'];
                    }

                    input_hybrid("Tenth Image", "property_image_10", $images, $require, "file", 'my_image10', '', 'img');
                    ?>

                    <img alt="Tenth Image" src="<?= file_url . $property_image_10 ?>" id="image_loader10" class="MyImgStyle">

                </div>

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

    });
</script>

<?php include_once 'footer.php'; ?>