<?php
$page = 'assign_architects';
include_once 'header.php';
$current_year = date("Y");

$project = get_by_id('project', security('id', 'GET'));
// cout($project);
// $assigned_architect = get_by_field('project_assignment', 'project_id', $project['project_id']); 
$assigned_architect = get_by_field(
    'project_assignment', 
    'project_id', 
    $project['project_id']
);
$senior_architects = get_all_where('architect', ['role' => 'senior', 'architect_status' => 'active']);
$junior_architects = get_all_where('architect', ['role' => 'junior', 'architect_status' => 'active']);

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
