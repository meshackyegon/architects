<?php
$page = 'assign_mechanicals';
include_once 'header.php';
$current_year = date("Y");

$project = get_by_id('project', security('id', 'GET'));

$assigned_mechanical = get_by_field('project_assignment','project_id', $project['project_id']);
$senior_mechanicals = get_all_where('mechanical', ['role' => 'senior', 'mechanical_status' => 'active']);
$junior_mechanicals = get_all_where('mechanical', ['role' => 'junior', 'mechanical_status' => 'active']);
// cout($junior_mechanicals);
?>

<div class="container-fluid">
    <form enctype="multipart/form-data" action="<?= model_url ?>assign_junior_mechanical" method="POST">
        <input type="hidden" name="project_id" value="<?= $project['project_id'] ?>">

        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <h4 class="text-center">Assign Junior mechanical to  <strong><?= $project['project_name'] ?></strong></h4>
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
                    <label for="senior_mechanical">Select Senior mechanical</label>
                    <select class="form-control" name="senior_mechanical_id" id="senior_mechanical" required <?= !empty($assigned_mechanical['senior_mechanical_id']) ? 'disabled' : '' ?>>
                        <option value="">-- Select Senior mechanical --</option>
                        <?php foreach ($senior_mechanicals as $mechanical): ?>
                            <option value="<?= $mechanical['mechanical_id'] ?>" <?= ($assigned_mechanical['senior_mechanical_id'] ?? '') == $mechanical['mechanical_id'] ? 'selected' : '' ?>>
                                <?= $mechanical['mechanical_name'] ?> (<?=$mechanical['mechanical_email'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Assign Junior Architect (Only if Senior Architect is Assigned) -->
                <?php if (!empty($assigned_mechanical['senior_mechanical_id'])): ?>
                    <div class="form-group">
                        <label for="junior_architect">Select Junior mechanical</label>
                        <select class="form-control" name="junior_mechanical_id" id="junior_mechanical" required <?= !empty($assigned_mechanical['junior_mechanical_id']) ? 'disabled' : '' ?>>
                            <option value="">-- Select Junior mechanical --</option>
                            <?php foreach ($junior_mechanicals as $mechanical): ?>
                                <option value="<?= $mechanical['mechanical_id'] ?>" <?= ($assigned_mechanical['junior_mechanical_id'] ?? '') == $mechanical['mechanical_id'] ? 'selected' : '' ?>>
                                    <?= $mechanical['mechanical_name'] ?> (<?= $mechanical['mechanical_email'] ?>)
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
