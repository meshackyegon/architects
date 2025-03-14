<?php
$page = 'assign_architects';
include_once 'header.php';
$current_year = date("Y");

$project = get_by_id('project', security('id', 'GET'));
// cout($project);
// $assigned_architect = get_by_field('project_assignment', 'project_id', $project['project_id']); 
$assigned_architect = get_by_field('project_assignment', 'project_id', $project['project_id']);
$assigned_electrical = get_by_field('project_assignment','project_id', $project['project_id']);
$assigned_mechanical = get_by_field('project_assignment', 'project_id', $project['project_id']);
$assigned_structural = get_by_field('project_assignment', 'project_id', $project['project_id']);

$senior_architects = get_all_where('architect', ['role' => 'senior', 'architect_status' => 'active']);
$senior_electricals = get_all_where('electrical', ['role' => 'senior', 'electrical_status' => 'active']);
$senior_mechanicals = get_all_where('mechanical', ['role' => 'senior', 'mechanical_status' => 'active']);
$senior_structurals = get_all_where('structural', ['role' => 'senior', 'structural_status' => 'active']);
$junior_architects = get_all_where('architect', ['role' => 'junior', 'architect_status' => 'active']);
// cout($senior_mechanicals);
?>

<div class="container-fluid">
    <form enctype="multipart/form-data" action="<?= model_url ?>assign_architect" method="POST">
        <input type="hidden" name="project_id" value="<?= $project['project_id'] ?>">

        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <h4 class="text-center">Assign Architects to  <strong><?= $project['project_name'] ?></strong></h4>
                <br>

                <div class="row">
                    <!-- Display project details -->
                    <div class="col-md-12">
                        <h5>Project: <strong><?= $project['project_name'] ?></strong></h5>
                        <p>Location: <?= $project['county'] ?>, <?= $project['subcounty'] ?>, <?= $project['ward'] ?></p>
                        <p>Size: <?= $project['land_size'] ?> m²</p>
                    </div>
                </div>

                <hr>

                <!-- Assign Senior Architect -->
                <div class="form-group">
                    <label for="senior_architect">Select Senior Architect</label>
                    <select class="form-control" name="senior_architect_id" id="senior_architect" required <?= !empty($assigned_architect['senior_architect_id']) ? 'disabled' : '' ?>>
                        <option value="">-- Select Senior Architect --</option>
                        <?php foreach ($senior_architects as $architect): ?>
                            <option value="<?= $architect['architect_id'] ?>" <?= ($assigned_architect['senior_architect_id'] ?? '') == $architect['architect_id'] ? 'selected' : '' ?>>
                                <?= $architect['architect_name'] ?> (<?= $architect['architect_email'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Assign Junior Architect (Only if Senior Architect is Assigned) -->
                <?php if (!empty($assigned_architect['senior_architect_id'])): ?>
                    <div class="form-group">
                        <label for="junior_architect">Select Junior Architect</label>
                        <select class="form-control" name="junior_architect_id" id="junior_architect" required <?= !empty($assigned_architect['junior_architect_id']) ? 'disabled' : '' ?>>
                            <option value="">-- Select Junior Architect --</option>
                            <?php foreach ($junior_architects as $architect): ?>
                                <option value="<?= $architect['architect_id'] ?>" <?= ($assigned_architect['junior_architect_id'] ?? '') == $architect['architect_id'] ? 'selected' : '' ?>>
                                    <?= $architect['architect_name'] ?> (<?= $architect['architect_email'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="senior_electrical">Select Senior Electrical</label>
                    <select class="form-control" name="senior_electrical_id" id="senior_electrical" required <?= !empty($assigned_electrical['senior_electrical_id']) ? 'disabled' : '' ?>>
                        <option value="">-- Select Senior Electrical --</option>
                        <?php foreach ($senior_electricals as $electrical): ?>
                            <option value="<?= $electrical['electrical_id'] ?>" <?= ($assigned_electrical['senior_electrical_id'] ?? '') == $electrical['electrical_id'] ? 'selected' : '' ?>>
                                <?= $electrical['electrical_name'] ?> (<?=$electrical['electrical_email'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="senior_architect">Select Senior Mechanical</label>
                    <select class="form-control" name="senior_mechanical_id" id="senior_mechanical" required <?= !empty($assigned_mechanical['senior_mechanical_id']) ? 'disabled' : '' ?>>
                        <option value="">-- Select Senior Mechanical --</option>
                        <?php foreach ($senior_mechanicals as $mechanical): ?>
                            <option value="<?= $mechanical['mechanical_id'] ?>" <?= ($assigned_mechanical['senior_mechanical_id'] ?? '') == $mechanical['mechanical_id'] ? 'selected' : '' ?>>
                                <?= $mechanical['mechanical_name'] ?> (<?= $mechanical['mechanical_email'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="senior_architect">Select Senior Structural</label>
                    <select class="form-control" name="senior_structural_id" id="senior_structural" required <?= !empty($assigned_structural['senior_structural_id']) ? 'disabled' : '' ?>>
                        <option value="">-- Select Senior structural --</option>
                        <?php foreach ($senior_structurals as $structural): ?>
                            <option value="<?= $structural['structural_id'] ?>" <?= ($assigned_structural['senior_structural_id'] ?? '') == $structural['structural_id'] ? 'selected' : '' ?>>
                                <?= $structural['structural_name'] ?> (<?= $structural['structural_email'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group text-center">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

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
</style>

<?php include_once 'footer.php'; ?>
