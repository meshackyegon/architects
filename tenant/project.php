<?php
$page        = 'project';
require_once 'header.php';

$current_year   = date("Y");

$project = get_by_id('project', security('id', 'GET'));

if (!empty($project)) {
    session_assignment(array(
        'edit' => $project['prod_id']
    ), false);
    $require = false;
} else {
    $require = true;
}


$properties = get_all('property');
?>
<div class="container-fluid">
 
    <form enctype="multipart/form-data" action="<?= model_url ?>project" method="POST">
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <br>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Project's Name", "project_name", $project, true);
                        input_select('Project Type As:', 'project_type', $row, true, array('Flats and Apartments', 'Bungalows','Maisonettes','Townhouses', 'Bedsitters and Studio Apartments','Villas',));
                        input_hybrid("Project's County", "county", $project, false);
                        input_hybrid("Project's Subcounty", "subcounty", $project, true);
                        input_hybrid("Project's Ward", "ward", $project, true);
                        input_hybrid("Project's Nearest Town", "nearest_town", $project, true);
                        input_hybrid("Project's Pin", "location_pin", $project, true);
                        input_hybrid("Project's Land Size", "land_size", $project, true);
                        
                        ?>
                        <input hidden name="created_by" value="self" />
                        <input hidden name="user_id" value="<?= $_SESSION['user_id'] ?>" />
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