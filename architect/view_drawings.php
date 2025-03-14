<?php
$page = 'structurals';
include_once 'header.php';
$current_year = date("Y");

$project = get_by_id('project', security('id', 'GET'));
$sql = "SELECT * FROM project p JOIN archdrawing ard ON p.project_id = ard.project_id WHERE p.project_id = '$project[project_id]'";
$drawings = select_rows($sql);

?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> Projects</h4>

    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Arch Pdf</th>
                        <th>Arch File</th>
                        <th>Arch Image</th>
                        <th>Site Layout</th>
                        <th>Floor</th>
                        <th>Elevation</th>
                        <th>Section</th>
                        <th>Roof</th>
                        <th>Detail Drawing</th>
                        <th>Arch Calculation</th>
                        <th>Action</th>
                        <th>Created On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($drawings as $drawing) {
                        $archdrawing_id = encrypt($drawing['archdrawing_id']);

                        function renderFile($file) {
                            $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                return "<img src='" . file_url . $file . "' style='width:150px; height:auto; border-radius:5px;'>";
                            } elseif ($file_ext === 'pdf') {
                                return "<a href='" . file_url . $file . "' target='_blank'>View PDF</a>";
                            } elseif (!empty($file)) {
                                return "<a href='" . file_url . $file . "' download>Download File</a>";
                            } else {
                                return "No file available";
                            }
                        }
                    ?>
                        <tr>
                            <td><?= $cnt ?></td>
                            <td><?= renderFile($drawing['arch_pdf']) ?></td>
                            <td><?= renderFile($drawing['arch_file']) ?></td>
                            <td><?= renderFile($drawing['arch_img']) ?></td>
                            <td><?= renderFile($drawing['site_layout_pdf']) ?></td>
                            <td><?= renderFile($drawing['floor_pdf']) ?></td>
                            <td><?= renderFile($drawing['elevation_pdf']) ?></td>
                            <td><?= renderFile($drawing['section_pdf']) ?></td>
                            <td><?= renderFile($drawing['roof_pdf']) ?></td>
                            <td><?= renderFile($drawing['detail_drawing_pdf']) ?></td>
                            <td><?= renderFile($drawing['arch_calculation_pdf']) ?></td>
                            <td>
                                <a href="?id=<?= $project_id ?>" class="btn btn-primary">
                                    <i class="fas fa-pencil"></i> Edit
                                </a>
                                <a href="<?= base_url ?>model/delete?id=<?= $archdrawing_id ?>&table=<?= encrypt('archdrawing') ?>&page=<?= encrypt('view_drawings') ?>&method=drawing" class="btn btn-danger mt-1">
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

<?php include_once 'footer.php'; ?>
