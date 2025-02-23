<?php
$page = 'structurals';
include_once 'header.php';
$projects = get_all('project');
// cout($structurals);
$num_columns = 9;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => '#'),
        array('data' => 'Name', 'title' => 'Name'),
        array('data' => 'Type', 'title' => 'Type'),
        array('data' => 'County', 'title' => 'County'),
        array('data' => 'Subcounty', 'title' => 'Subcounty'),
        array('data' => 'Ward', 'title' => 'Ward'),
        array('data' => 'Size', 'title' => 'Size'),
        array('data' => 'Action', 'title' => 'Action'),
        array('data' => 'Created On', 'title' => 'Created On')
    );
}

$add = 'project.php';
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> Projects</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>No.</th>
                        <th>Project Name</th>
                        <th>Type</th>
                        <th>County</th>
                        <th>Subcounty</th>
                        <th>Ward</th>
                        <th>Land Size</th>
                        <th>Action</th>
                        <th>Created On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($projects as $project) {
                        $project_id = encrypt($project['project_id']);
                    ?>
                        <tr>
                            <td> </td>
                            <td><?= $cnt ?></td>
                            <td><?= $project['project_name'] ?></td>
                            <td><?= $project['project_type'] ?></td>
                            <td><?= $project['county'] ?></td>
                            <td><?= $project['subcounty'] ?></td>
                            <td><?= $project['ward'] ?></td>
                            <td><?= $project['land_size'] ?></td>
                            <td>
                                <!-- project_details?id=<?= $project_id ?> -->
                                <a href="" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <!-- <a href="<?= base_url ?>model/delete?id=<?= $project_id ?>&table=<?= encrypt('project') ?>&page=<?= encrypt('view_projects') ?>&method=simple_admin" class="btn btn-danger mt-1">
                                    <i class="fas fa-trash"></i>
                                </a> -->
                            </td>
                            <td><?= get_ordinal_month_year($project['project_date_created']) ?></td>
                        </tr>

                    <?php $cnt++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>



</div>
<!-- / Content -->


<?php
include_once 'footer.php';
?>