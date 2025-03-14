<?php
$page = 'assign_electricals';
include_once 'header.php';
$current_year = date("Y");

$project = get_by_id('project', security('id', 'GET'));

$assigned_electrical = get_by_field('project_assignment','project_id', $project['project_id']);
$senior_electricals = get_all_where('electrical', ['role' => 'senior', 'electrical_status' => 'active']);
$junior_electricals = get_all_where('electrical', ['role' => 'junior', 'electrical_status' => 'active']);
// cout($junior_electricals);
?>

<div class="container-fluid">
    <form enctype="multipart/form-data" action="<?= model_url ?>assign_junior_electrical" method="POST">
        <input type="hidden" name="project_id" value="<?= $project['project_id'] ?>">

        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <h4 class="text-center">Assign Junior Electrical to  <strong><?= $project['project_name'] ?></strong></h4>
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
                <!-- Assign Junior Architect (Only if Senior Architect is Assigned) -->
                <?php if (!empty($assigned_electrical['senior_electrical_id'])): ?>
                    <div class="form-group">
                        <label for="junior_architect">Select Junior Electrical</label>
                        <select class="form-control" name="junior_electrical_id" id="junior_electrical" required <?= !empty($assigned_electrical['junior_electrical_id']) ? 'disabled' : '' ?>>
                            <option value="">-- Select Junior Electrical --</option>
                            <?php foreach ($junior_electricals as $electrical): ?>
                                <option value="<?= $electrical['electrical_id'] ?>" <?= ($assigned_electrical['junior_electrical_id'] ?? '') == $electrical['electrical_id'] ? 'selected' : '' ?>>
                                    <?= $electrical['electrical_name'] ?> (<?= $electrical['electrical_email'] ?>)
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
