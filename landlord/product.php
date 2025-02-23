<?php
$page        = 'product';
require_once 'header.php';

$current_year   = date("Y");

$product = get_by_id('product', security('id', 'GET'));

if (!empty($product)) {
    session_assignment(array(
        'edit' => $product['product_id']
    ), false);
    $require = false;
} else {
    $require = true;
}

$writers    = get_dropdown_data(get_all('writer'), 'writer_name', 'writer_id');
$cats       = get_dropdown_data(get_all('category'), 'category_name', 'category_id');
$subcats    = get_dropdown_data(get_all('subcategory'), 'subcategory_name', 'subcategory_id');
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body card-secondary">
            <div class="card-header">
                <h3 class="card-title">Add Product </h3>
            </div>
            <div class="mt-4">
                <form enctype="multipart/form-data" action="<?= model_url ?>product" method="POST">
                    <div class="row clearfix">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php
                            input_hybrid('Product Name', 'product_name', $product, $require);
                    
                                    input_select('Cover Duration', 'product_duration', $product, $require, array('1 month', '12 months'));
                                

                            ?>
                            <div class="col-lg-12 col-md-6 col-sm-12 col-xs-6">
                                <?php
                                input_select('Rate or Block Figure', 'product_mode', $product, false, array('price', 'rate'))
                                ?>
                            </div>

                            <div id="prodmode">
                                <?php
                                input_hybrid('product_rate', 'product_rate', $product, false, "number");
                                input_hybrid('product_price', 'product_price', $product, false, "number");
                                input_hybrid('product_mincap', 'product_mincap', $product, false, "number");
                                ?>
                            </div>




                            <?php
                            input_select_array("Select An Underwriter", "writer_id", $product, $required, $writers, 'Click Here');
                            input_select_array("Cat", "category_id", $product, $required, $cats, 'Click Here');
                            ?>

                            <div id="subcat">
                                <?php
                                input_select_array("SubCat", "subcategory_id", $product, false, $subcats, 'Click Here');
                                ?>
                            </div>

                        </div>

                        <div class="divider MyDiver">
                            <div class="divider-text">Benefits</div>
                        </div>


                        <div class="BenefitsRow">
                            <p class="benefitCounter">Benefit 1</p>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="form-label">Benefit Name</label>
                                <input class="form-control" type="text" autocomplete="off" name="benefit_name[]" placeholder="Enter name" />
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                                    <?php
                                    input_select('Free or Paid', 'benefit_free[]', $product, false, array('yes', 'no'))
                                    ?>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                                    <?php
                                    input_select('Mode', 'benefit_mode[]', $product, false, array('price', 'rate'))
                                    ?>
                                </div>


                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                                    <?php
                                    input_hybrid('Benefit price', 'benefit_price[]', $product, false, "number")
                                    ?>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                                    <?php
                                    input_hybrid('Benefit rate', 'benefit_rate[]', $product, false, "number")
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="AdditionButton">
                            <button type="button" class="btn rounded-pill btn-info" style="margin-top:1em;" id="add_benefit_row">Add More</button>
                        </div>

                        <div class="divider MyDiver">
                            <div class="divider-text">Levies</div>
                        </div>


                        <div class="LeviesRow">
                            <p class="levyCounter">levy 1</p>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="form-label">levy Name</label>
                                <input class="form-control" type="text" autocomplete="off" name="levy_name[]" placeholder="Enter name" />
                            </div>

                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                    <?php
                                    input_select('Mode', 'levy_mode[]', $product, false, array('price', 'rate'))
                                    ?>
                                </div>


                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                                    <?php
                                    input_hybrid('levy price', 'levy_price[]', $product, false, "number")
                                    ?>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                                    <?php
                                    input_hybrid('levy rate', 'levy_rate[]', $product, false, "number")
                                    ?>
                                </div>
                            </div>
                        </div>


                        <div class="LevyAdditionButton">
                            <button type="button" class="btn rounded-pill btn-primary" style="margin-top:1em;" id="add_levy_row">Add More</button>
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
<!-- End of Main Content -->

<style>
    /*#subcat {*/
    /*    display: none;*/
    /*}*/

    .form-group {
        margin-top: 10px;
    }
</style>

<script>
    $(document).ready(function() {
        // var SelectedValue;
        // $('#category_id').change(function() {
        //     SelectedValue = this.value;
        //     console.log(SelectedValue)
        //     if (SelectedValue == 'CAT20240205ghdSw0f') {
        //         $('#subcat').css('display', 'none');
        //     } else {
        //         $('#subcat').css('display', 'block');
        //     }
        // });

        var rowCounter, levyCount = 1;

        // Add click event listener to the "Add Another" button
        $("#add_benefit_row").click(function() {
            rowCounter++;

            var clonedRow = $(".BenefitsRow").first().clone();

            clonedRow.find(".benefitCounter").text("Benefit " + rowCounter);
            clonedRow.find("input").val("");

            $(".AdditionButton").before(clonedRow);
        });



        // Add click event listener to the "Add Another" button
        $("#add_levy_row").click(function() {
            levyCount++;

            var clonedLevyRow = $(".LeviesRow").first().clone();

            clonedLevyRow.find(".levyCounter").text("levy " + levyCount);
            clonedLevyRow.find("input").val("");

            $(".LevyAdditionButton").before(clonedLevyRow);
        });
    });
</script>

<style>
    .MyDiver{
        margin-top:200px;
        margin-bottom:200px;
    }
</style>

<?php include_once 'footer.php'; ?>