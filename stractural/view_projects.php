<?php
$page = 'projects';
include_once 'header.php';
$sql = "SELECT * FROM project_assignment pa join project p on pa.project_id=p.project_id join structural st on pa.senior_structural_id=st.structural_id WHERE pa.senior_structural_id='$_SESSION[structural_id]' OR pa.junior_structural_id='$_SESSION[structural_id]' ";
// join electrical el on pa.junior_electrical_id=el.electrical_id WHERE pa.junior_electrical_id='$_SESSION[electrical_id]' OR pa.senior_electrical_id='$_SESSION[electrical_id]'
$projects=select_rows($sql);
// cout($projects);
$num_columns = 8;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => '#'),
        array('data' => 'project_name', 'title' => 'Project'),
        array('data' => 'project_type', 'title' => 'Type'),
        // array('data' => 'county', 'title' => 'County'),
        array('data' => 'land_size', 'title' => 'Land Size'),
        array('data' => 'architect_name', 'title' => 'SR Structural'),
        // array('data' => 'completion_status', 'title' => 'Architect Status'),
        array('data' => 'approval_status', 'title' => 'Approval Status'),
        // array('data' => 'status', 'title' => 'Status'),
        array('data' => 'action', 'title' => 'Action'),
    );
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">My </span>Projects</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>No.</th>
                        <th>Project</th>
                        <th>Type</th>
                        <!-- <th>County</th> -->
                        <th>Land Size</th>
                        <th>SR Structural</th>
                        <!-- <th>Ectrical Status</th> -->
                        <th>Approval Status</th>
                        <!-- <th>Status</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($projects as $project) { 
                        // $project = get_by_id('project', $project['project_id']);
                        $project_id = encrypt($project['project_id']);
                        
                    ?>
                        <tr>
                            <td> </td>
                            <td><?= $cnt ?></td>
                            <td><?= $project['project_name'] ?></td>
                            <td><?=  $project['project_type'] ?></td>
                            <!-- <td><?=  $project['county'] ?></td> -->
                            <td><?=  $project['land_size'] ?></td>
                            <td><?=  $project['structural_name'] ?>(<?=  $project['structural_email'] ?>)</td>
                            <!-- <td><?=  $project['completion_status'] ?></td> -->
                            <td><?=  $project['approval_status'] ?></td>
                            <!-- <td><?=  $project['status'] ?></td> -->
                            <td>
                                <?php if($_SESSION['structural_role']==='senior'){?>
                                    <a href="assign_engineer?id=<?= $project_id ?>" class="btn btn-info">
                                        <i class="fas fa-eye"></i>Assign
                                    </a>
                                    <a href="<?= base_url ?>model/update/update?id=<?= $project_id ?>&table=<?= encrypt('project_assignment') ?>&page=<?= encrypt('my-projects') ?>" class="btn rounded-pill btn-label-dark">
                                        <small>Approve</small>
                                    </a>
                                    
                                
                                <?php } else{ ?>
                                    <a href="" class="btn rounded-pill btn-primary">
                                        <small>Work</small>
                                    </a>
                                 <?php } ?>
                            </td>

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