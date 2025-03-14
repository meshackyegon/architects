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
 
    <form enctype="multipart/form-data" action="<?= model_url ?>struct" method="POST">
        <input type="hidden" name="project_id" value="<?= $project['project_id'] ?>">
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <br>
                <div class="divider MyDiver">
                    <div class="divider-text">General Arrangement Drawings </div>
                </div>
                <p>These drawings provide an overall view of the structure, including floor plans, elevations, and sections. They show the layout and positioning of major structural components, such as columns, beams, and walls.</p>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("General Arrangement PDF:", "strctural_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("General Arrangement Project File:", "structural_file", $images, $require, "file", 'my_image1', '', 'dwg');
                        textarea_input("Drawing Description:", "struct_description", $project, true);
                        ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Foundation Drawings </div>
                </div>
                <p>These drawings focus on the design and construction details of the building's foundation system, including footings, piles, and mat foundations. They show the dimensions, reinforcement, and other relevant information for proper foundation installation.</p>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Foundation Drawings PDF:", "foundation_layout_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("Foundation Drawings Project File:", "foundation_layout_file", $images, $require, "file", 'my_image1', '', 'dwg');
                        textarea_input("Drawing Description:", "foundation_description", $project, true);
                          ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Framing Drawings </div>
                </div>
                <p>These drawings illustrate the structural framing system of the building, including columns, beams, and load-bearing walls. They provide details about the sizes, locations, and connections of these elements.</p>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Framing Drawings PDF:", "framing_drawing_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("Framing Drawings Project File:", "framing_drawing_file", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Framing Description::", "framing_description", $project, true);
                          ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Reinforcement Drawings </div>
                </div>
                <p>Reinforcement drawings, also known as rebar drawings or detailing drawings, provide information about the reinforcement layout and detailing for concrete structural elements. They specify the location, size, and spacing of reinforcement bars, as well as details of connections, laps, and bends.</p>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Reinforcement Drawings PDF:", "reinforcement_frawing_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("Reinforcement Drawings Project File:", "reinforcement_frawing_file", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Reinforcement Description:", "reinforcement_description", $project, true);
                            ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Connection Details </div>
                </div>
                <p>These drawings focus on the design and construction details of connections between structural elements, such as beam-column connections, beam-to-slab connections, or beam-to-wall connections. They provide specific instructions for proper connection assembly.</p>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Connection Drawings PDF:", "connection_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("Connection Drawings Project File:", "connection_file", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Connection Description:", "connection_description", $project, true);
                            ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Structural Claculations</div>
                </div>
                <p>While not strictly drawings, structural calculations are an essential part of the structural documentation. They include engineering calculations and analysis results that support the design and load-bearing capacity of the structure.</p>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Structural Calculations PDF:", "structural_calculation_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("Structural Calculations FILE:", "structural_calculation_file", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Structural Description:", "structural_calculation_description", $project, true);
                            ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Combined Drawings</div>
                </div>
                <p>These drawings provide an overall view of the structure, including General Arrangement, Foundation Drawings, Framing Drawings, Reinforcement Drawings, Connection Details and Calculations Drawings. They show the layout and positioning of major structural components, such as columns, beams, and walls.</p>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Full Drawings PDF:", "combined_drawing_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("Full Drawings Project File::", "combined_drawing_file", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Full Drawings Description:", "combined_drawing_description", $project, true);
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