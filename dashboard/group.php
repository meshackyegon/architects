<?php
$page        = 'group';
$header_name = 'Groups';

//  require_once '../path.php';
require_once 'header.php';
$company = get_by_id('company', security('id', 'GET'));
//cout($company);
if (!empty($company)) {
    session_assignment(array(
        'edit' => $company['company_id']
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
                        Add group
                    </h3>
                </div>
                <div class=" m-5">
                    <form enctype="multipart/form-data" action="<?= model_url ?>simple&table=company&url=view_groups" method="POST">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group ">
                                    <?php
                                                         input_hybrid("company name", "company_name", $company, true);
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