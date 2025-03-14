<?php
$page        = 'project';
require_once 'header.php';

$current_year   = date("Y");

$project = get_by_id('project', security('id', 'GET'));
// cout($project['project_id']);
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
 
    <form enctype="multipart/form-data" action="<?= model_url ?>mch" method="POST">
        <input type="hidden" name="project_id" value="<?= $project['project_id'] ?>">
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <br>
                <div class="divider MyDiver">
                    <div class="divider-text">PLumbing </div>
                </div>
                <p>Plumbing drawings illustrate the layout, sizing, and specifications of plumbing systems, including piping networks, fixtures, drainage systems, water supply, and waste management.</p>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("General Arrangement PDF:", "plumbing_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("General Arrangement Project File:", "plumbing_file", $images, $require, "file", 'my_image1', '', 'dwg');
                        textarea_input("plumbing Description:", "plumbing_description", $project, true);
                        ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Piping and instrumentation </div>
                </div>
                <p>Piping and Instrumentation Diagrams depict the interconnections of pipes, valves, instruments, and equipment in a process system. They illustrate the flow of fluids, control systems, and instrumentation.</p>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("General Arrangement PDF::", "piping_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("General Arrangement File:", "piping_file", $images, $require, "file", 'my_image1', '', 'dwg');
                        textarea_input("Piping Description:", "piping_description", $project, true);
                          ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Equipment Installation </div>
                </div>
                <p>Equipment installation drawings provide details on the layout, positioning, and connection of mechanical equipment, such as pumps, compressors, boilers, chillers, and generators.</p>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("General Arrangement PDF:", "equipment_installation_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("General Arrangement File:", "equipment_installation_file", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Equipment Installation:", "equipment_installation_description", $project, true);
                          ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Mechaical Fabrication </div>
                </div>
                <p>Mechanical fabrication drawings provide detailed information for the fabrication and manufacturing of mechanical components and structures. They include dimensions, tolerances, material specifications, welding details, and assembly instructions.</p>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("General Arrangement PDF:", "mechaical_fabrication_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("General Arrangement File:", "mechaical_fabrication_file", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Mechaical Fabrication Description:", "mechaical_fabrication_description", $project, true);
                            ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Full Mechanical</div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Connection Drawings PDF:", "full_mechanical_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("Connection Drawings Project File:", "full_mechanical_file", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Connection Description:", "full_mechanical_description", $project, true);
                            ?>
                    </div>
                </div>
 
                        <input hidden name="created_by" value="self" />
                        <!-- <input hidden name="user_id" value="<?= $_SESSION['user_id'] ?>" /> -->
                        <!-- </div> -->
                    

                
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