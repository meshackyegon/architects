<?php
$page        = 'service';
require_once 'header.php';

$current_year   = date("Y");

$service = get_by_id('service', security('id', 'GET'));

if (!empty($service)) {
    session_assignment(array(
        'edit' => $service['prod_id']
    ), false);
    $require = false;
} else {
    $require = true;
}



?>
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <form enctype="multipart/form-data" action="<?= model_url ?>service" method="POST">
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">



                <br>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php

                        input_hybrid("What is Your Service Name/Title", "service_name", $service, true);
                        input_hybrid("What is Your Service Category", "service_category", $service, true);
                        ?>
                    </div>

                </div>




                <div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php
                            input_hybrid("service Price", "service_price", $service, false, 'number');
                            ?>
                        </div>

                    </div>

                </div>





                <div class="divider MyDiver">
                    <div class="divider-text">Images</div>
                </div>




                <div class="row">
                    <div class="col-12">
                        <?php
                        if (!empty($service['service_image'])) {
                            $require = false;
                            $service_image = $service['service_image'];
                        } else {
                            $require = true;
                            $service_image = 'white_bg_image.png';
                        }
                        input_hybrid("First Image", "service_image", $service, false, "file", 'my_img', '', 'img');
                        ?>

                        <img alt="image" src="<?= file_url . $service_image ?>" id="img_loader" style="border-radius: 5%; border-color:grey; border-style: solid; height:auto; width: 60%;">
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


<?php include_once 'footer.php'; ?>