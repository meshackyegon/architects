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
 
    <form enctype="multipart/form-data" action="<?= model_url ?>elect" method="POST">
        <input type="hidden" name="project_id" value="<?= $project['project_id'] ?>">
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <br>
                <div class="divider MyDiver">
                    <div class="divider-text">Single Line Diagrams</div>
                </div>
                <p>- Illustrate the electrical system in a simplified format using single lines and symbols.</P>
                <p>- Show the flow of electrical power, major components, and connections between them.</P>
                <p>- Provide an overview of the system's configuration and interconnections</P>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Single-Line Diagrams (SLDs) PDF::", "single_line_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("Single-Line Diagrams (SLDs) File:", "single_line_file", $images, $require, "file", 'my_image1', '', 'dwg');
                        textarea_input("Single-Line Diagrams Description:", "single_line_description", $project, true);
                        ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Wiring Diagrams </div>
                </div>
                <p>- Detail the electrical connections and wiring layouts for specific equipment, devices, or systems.</P>
                <p>- Show the physical layout of wires, terminals, and components.</P>
                <p>- Provide information on the connections, color codes, and wire sizes.</P>
                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Wiring Diagrams PDF:", "wiring_diagram_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("Wiring Diagrams File:", "wiring_diagram_file", $images, $require, "file", 'my_image1', '', 'dwg');
                        textarea_input("Wiring Diagrams Description:", "wiring_diagram_description", $project, true);
                          ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Schematic diagrams </div>
                </div>
                <p>- Represent the electrical circuits using standardized symbols and lines.</P>
                <p>- Illustrate the relationships and interactions between various electrical components.</P>
                <p>- Show the sequence of operation and control logic of the circuit.</P>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Schematic Diagrams PDF:", "schematic_diagrams_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("Schematic Diagrams  File:", "schematic_diagrams_file", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Schematic Diagrams  Description::", "schematic_diagrams_description", $project, true);
                          ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Power and Ligting Plans </div>
                </div>
                <p>- Illustrate the layout and distribution of electrical power and lighting systems within a building or structure.</P>
                <p>- Show the location of outlets, switches, lighting fixtures, and other electrical devices.</P>
                <p>- Provide information on circuitry, load calculations, and switchboard distribution</P>
                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Power and Lighting Plans PDF::", "power_lighting_plans_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("Power and Lighting Plans  File:", "power_lighting_plans_file", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Power and Lighting Plans  Description:", "power_lighting_plans_description", $project, true);
                            ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Control & Instrumentation </div>
                </div>
                <p>- Show the layout and connections of control panels, instruments, and control devices.</P>
                <p>- Illustrate the control logic, signal flow, and interconnections between various control components.</P>
                <p>- Provide information on control loops, alarms, and instrumentation details.</P>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Control And Instrumentation PDF:", "control_instrumentation_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("Control And Instrumentation File:", "control_instrumentation_file", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Control And Instrumentation  Description:", "control_instrumentation_description", $project, true);
                            ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Panel Schedules</div>
                </div>
                <p>- Provide detailed information about the electrical panels, including circuit breakers, fuses, and load calculations.</P>
                <p>- List the circuits, their respective loads, and associated panel information.</P>
                <p>- Facilitate proper distribution and management of electrical power within a building</P>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Panel Schedules PDF:", "panel_schedules_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("Panel Schedules  FILE:", "panel_schedules_file", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Panel Schedules Description:", "panel_schedules_description", $project, true);
                            ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Cable Conduit Schedules</div>
                </div>
                <p>- Specify the types, sizes, and routing of electrical cables and conduits within a system or building.</P>
                <p>- Provide information on cable lengths, types of insulation, and installation details.</P>
                <p>- Ensure proper cable management and organization.</P>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Cable and Conduit Schedules PDF:", "cable_conduit_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("Cable and Conduit Schedules File::", "cable_conduit_file", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Cable and Conduit Schedules  Description:", "cable_conduit_description", $project, true);
                            ?>
                    </div>
                </div>
                <div class="divider MyDiver">
                    <div class="divider-text">Layout and Elevation</div>
                </div>
                <p>- Illustrate the physical placement and orientation of electrical equipment, devices, and fixtures within a building.</P>
                <p>- Show the locations of panels, switches, outlets, lighting fixtures, and other electrical components.</P>
                <p>- Provide spatial information and assist in installation and maintenance.</P>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Layout and Elevation PDF:", "layout_elevation_pdf", $images, $require, "file", 'my_image1', '', 'pdf');
                        input_hybrid("Layout and Elevation File::", "layout_elevation_file", $images, $require, "file", 'my_image1', '', 'pdf');
                        textarea_input("Layout and Elevation Description:", "layout_elevation_description", $project, true);
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