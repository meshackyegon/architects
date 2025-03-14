<?php
$page = 'assign_electricals';
include_once 'header.php';
$current_year = date("Y");

$project = get_by_id('project', security('id', 'GET'));

$assigned_structural = get_by_field('project_assignment','project_id', $project['project_id']);
$senior_structurals = get_all_where('structural', ['role' => 'senior', 'structural_status' => 'active']);
$junior_structurals = get_all_where('structural', ['role' => 'junior', 'structural_status' => 'active']);
// cout($junior_stracturals);
?>

<div class="container-fluid">
    <form enctype="multipart/form-data" action="<?= model_url ?>assign_junior_structural" method="POST">
        <input type="hidden" name="project_id" value="<?= $project['project_id'] ?>">

        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <h4 class="text-center">Assign Junior structural to  <strong><?= $project['project_name'] ?></strong></h4>
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


                <div class="form-group">
                    <label for="senior_structural">Select Senior structural</label>
                    <select class="form-control" name="senior_structural_id" id="senior_structural" required <?= !empty($assigned_structural['senior_structural_id']) ? 'disabled' : '' ?>>
                        <option value="">-- Select Senior structural --</option>
                        <?php foreach ($senior_structurals as $structural): ?>
                            <option value="<?= $structural['structural_id'] ?>" <?= ($assigned_structural['senior_structural_id'] ?? '') == $structural['structural_id'] ? 'selected' : '' ?>>
                                <?= $structural['structural_name'] ?> (<?=$structural['structural_email'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Assign Junior Architect (Only if Senior Architect is Assigned) -->
                <?php if (!empty($assigned_structural['senior_structural_id'])): ?>
                    <div class="form-group">
                        <label for="junior_architect">Select Junior structural</label>
                        <select class="form-control" name="junior_structural_id" id="junior_structural" required <?= !empty($assigned_structural['junior_structural_id']) ? 'disabled' : '' ?>>
                            <option value="">-- Select Junior structural --</option>
                            <?php foreach ($junior_structurals as $structural): ?>
                                <option value="<?= $structural['structural_id'] ?>" <?= ($assigned_structural['junior_structural_id'] ?? '') == $structural['structural_id'] ? 'selected' : '' ?>>
                                    <?= $structural['structural_name'] ?> (<?= $structural['structural_email'] ?>)
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
