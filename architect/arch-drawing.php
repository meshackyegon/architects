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
 
    <form enctype="multipart/form-data" action="<?= model_url ?>arch" method="POST">
        <input type="hidden" name="project_id" value="<?= $project['project_id'] ?>">
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <br>
                <div class="divider MyDiver">
                    <div class="divider-text">Architectural Drawings </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Architectural Drawings (MUST BE IN PDF FORMAT):", "arch_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("Architectural Drawings (MUST BE EDITABLE PROJECT FILE):", "arch_file", $images, $require, "file", 'my_image1', '', 'dwg');
                        input_hybrid("Architectural View (MUST BE AN IMAGE / PHOTO):", "arch_img", $images, $require, "file", 'my_image1', '', 'img');
                        textarea_input("Input Comment For Architectural Drawing:", "arch_comment", $project, true);
                        ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Site Layout </div>
                </div>
                <p>Site plans provide an overview of the entire property where the building will be constructed. They show the location of the building on the site, along with other features like parking areas, landscaping, and utilities</p>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Site Plan (PDF):", "site_layout_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                          ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Floor Plans </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Floor Name:", "floor_name", $project, true);
                        input_hybrid("Floor Plan PDF:", "floor_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Floor Description::", "floor_description", $project, true);
                          ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Elevation Plans </div>
                </div>
                <p>Elevation drawings depict the exterior views of the building from different angles. They show the building's facade, including the proportions, windows, doors, and other architectural elements.</p>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Elevation Plans Title:", "elevation_title", $project, true);
                        input_hybrid("Elevation Plan Upload PDF File:", "elevation_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                            ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Section Drawings </div>
                </div>
                <p>Section drawings cut through the building to reveal the internal structure and details. They show the building's vertical cross-sections and provide insights into the interior layout, ceiling heights, and structural components.</p>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Section Drawings Title:", "section_title", $project, true);
                        input_hybrid("Section Drawing (PDF):", "section_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                            ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Roof Plans </div>
                </div>
                <p>Roof plans illustrate the design and layout of the roof, including its shape, slopes, and features such as chimneys or skylights. They provide valuable information for roof construction and materials.</p>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Roof PDF File:", "roof_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Roof Description:", "roof_description", $project, true);
                            ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Detail Drawings </div>
                </div>
                <p>Detail drawings zoom in on specific areas or architectural elements of the building. They provide detailed information about construction techniques, materials, and dimensions, ensuring accurate execution of architectural features.</p>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Detail Drawings PDF File:", "detail_drawing_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Detail Drawings Roof Description:", "detail_drawing_description", $project, true);
                            ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Architectural Calculations </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Architectural calculations Upload", "arch_calculation_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Comments:", "arch_calculation_description", $project, true);
                        ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Estimation </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Floor Area:", "floor_area", $project, true);
                        input_hybrid("How many Floors are to be constructed:", "num_floors", $project, true);
                        input_hybrid("What is the size of the compound in square meters:", "compound_size", $project, true);
                        input_hybrid("What is the area to be covered by perimeter wall:", "area_perimeter_wall", $project, true);
                            ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Working Drawings </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Select Working Drawings", "working_drawings_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
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