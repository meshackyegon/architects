<?php
$page = 'structurals';
include_once 'header.php';
$current_year = date("Y");

$project = get_by_id('project', security('id', 'GET'));
$sql = "SELECT * FROM project p JOIN structdrawing std ON p.project_id = std.project_id WHERE p.project_id = '{$project['project_id']}'";
$drawings = select_rows($sql);

function renderFile($file, $title) {
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
        return "<img src='" . file_url . $file . "' style='width:150px; height:auto; border-radius:5px;' title='" . htmlspecialchars($title) . "' alt='" . htmlspecialchars($title) . "'>";
    } elseif ($ext === 'pdf') {
        return "<a href='" . file_url . $file . "' target='_blank' class='btn btn-info'>View PDF</a>";
    } else {
        return "<a href='" . file_url . $file . "' download class='btn btn-secondary'>Download File</a>";
    }
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> Projects</h4>
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>No.</th>
                        <th>Structural Pdf</th>
                        <th>Structural File</th>
                        <th>Foundation Pdf</th>
                        <th>Foundation File</th>
                        <th>Framing Pdf</th>
                        <th>Framing File</th>
                        <th>Reinforcement Pdf</th>
                        <th>Reinforcement File</th>
                        <th>Connection Pdf</th>
                        <th>Connection File</th>
                        <th>Calculation Pdf</th>
                        <th>Combined Drawing Pdf</th>
                        <th>Action</th>
                        <th>Created On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($drawings as $drawing) {
                        $structdrawing_id = encrypt($drawing['archdrawing_id']);
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td><?= renderFile($drawing['strctural_pdf'], 'Structural Pdf') ?></td>
                            <td><?= renderFile($drawing['structural_file'], 'Structural File') ?></td>
                            <td><?= renderFile($drawing['foundation_layout_pdf'], 'Foundation Pdf') ?></td>
                            <td><?= renderFile($drawing['foundation_layout_file'], 'Foundation File') ?></td>
                            <td><?= renderFile($drawing['framing_drawing_pdf'], 'Framing Pdf') ?></td>
                            <td><?= renderFile($drawing['framing_drawing_file'], 'Framing File') ?></td>
                            <td><?= renderFile($drawing['reinforcement_frawing_pdf'], 'Reinforcement Pdf') ?></td>
                            <td><?= renderFile($drawing['reinforcement_frawing_file'], 'Reinforcement File') ?></td>
                            <td><?= renderFile($drawing['connection_pdf'], 'Connection Pdf') ?></td>
                            <td><?= renderFile($drawing['connection_file'], 'Connection File') ?></td>
                            <td><?= renderFile($drawing['structural_calculation_pdf'], 'Calculation Pdf') ?></td>
                            <td><?= renderFile($drawing['combined_drawing_pdf'], 'Combined Drawing Pdf') ?></td>
                            <td>
                                <a href="?id=<?= $project['project_id'] ?>" class="btn btn-primary">
                                    <i class="fas fa-pencil"></i> Edit
                                </a>
                                <a href="<?= base_url ?>model/delete?id=<?= $structdrawing_id ?>&table=<?= encrypt('structdrawing') ?>&page=<?= encrypt('view_drawings') ?>&method=drawing" class="btn btn-danger mt-1">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <td><?= get_ordinal_month_year($project['project_date_created']) ?></td>
                        </tr>
                    <?php $cnt++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include_once 'footer.php';
?>