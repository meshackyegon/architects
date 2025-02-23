<?php
$page        = 'category';
$header_name = 'Categories';

//  require_once '../path.php';
require_once 'header.php';
require_once MODEL_PATH . "operations.php";

$category = get_by_id('category', security('id', 'GET'));
//cout($category);
if (!empty($category)) {
    session_assignment(array(
        'edit' => $category['category_id']
    ), false);
    $required = false;
} else {
    $required = true;
}

?>
<div class="content-wrapper"><!-- Begin Page Content -->

    <div class="container-fluid">
        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mr-5 ml-5">
            <div class="card-body card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Add category
                    </h3>
                </div>
                <div class=" m-5">
                    <form enctype="multipart/form-data" action="<?= model_url ?>simple&table=category&url=view_categories" method="POST">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-category ">
                                    <?php
                                    input_hybrid("Category name", "category_name", $category, true);
                                    ?>
                                </div>
                                <div class="text-center">
                                    <button id="add" onclick="return valid();" class="btn btn-info ">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->


    <?php include_once 'footer.php'; ?>