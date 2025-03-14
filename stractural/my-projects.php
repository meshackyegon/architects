<?php
$page = 'my-projects';
include_once 'header.php';
$sql = "SELECT * FROM project_assignment pa join project p on pa.project_id=p.project_id join structural st on pa.junior_structural_id=st.structural_id WHERE pa.junior_structural_id='$_SESSION[structural_id]' OR pa.senior_structural_id='$_SESSION[structural_id]'";
$projects=select_rows($sql);
$sqll = "SELECT * FROM project p join structdrawing std on p.project_id=std.project_id";
$projectss=select_rows($sqll);

// cout(sizeof($projectss));
$num_columns = 9;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => '#'),
        array('data' => 'project_name', 'title' => 'Project'),
        array('data' => 'project_type', 'title' => 'Type'),
        array('data' => 'county', 'title' => 'County'),
        array('data' => 'land_size', 'title' => 'Land Size'),
        array('data' => 'architect_name', 'title' => 'JR Structural'),
        array('data' => 'approval_status', 'title' => 'Approval Status'),
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
                        <th>County</th>
                        <th>Land Size</th>
                        <th>JR Structural</th>
                        <th>Approval Status</th>
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
                            <td><?=  $project['county'] ?></td>
                            <td><?=  $project['land_size'] ?></td>
                            <td><?=  $project['structural_name'] ?>(<?=  $project['structural_email'] ?>)</td>
                            <td><?=  $project['approval_status'] ?></td>
                            
                            <td>
                                <?php if($_SESSION['structural_role']==='senior'){?>
                                    <a href="<?= base_url ?>model/update/update?id=<?= $project_id ?>&table=<?= encrypt('project_assignment') ?>&page=<?= encrypt('my-projects') ?>" class="btn rounded-pill btn-label-dark">
                                        <small>Approve</small>
                                    </a>
                                
                                <?php } else{ ?>
                                    <?php if(sizeof($projectss)<1){?>
                                    <a href="struct-drawing?id=<?= $project_id ?>" class="btn rounded-pill btn-primary">
                                        <small>Work</small>
                                    </a>
                                    <?php } else{ ?>
                                    <a href="view_drawings?id=<?= $project_id ?>" class="btn rounded-pill btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                     <a href="" class="btn rounded-pill btn-info">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <?php }  ?>

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