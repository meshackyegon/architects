<?php
$page = 'admins';
//  require_once '../path.php';
include_once 'header.php';
$admins = get_all('admin');

$num_columns = 5;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'admin_name', 'title' => 'Name'),
        array('data' => 'admin_email', 'title' => 'Email'),
       
        array('data' => '', 'title' => 'Action')
    );
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> admins</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($admins as $admin) {
                        $admin_id = encrypt($admin['admin_id']);
                       

                    ?>
                        <tr>
                            <td></td>
                            <td><?= $cnt ?></td>
                            <td> <?= $admin['admin_name'] ?> </td>
                            <td> <?= $admin['admin_email'] ?> </td>
                            
                            <td>
                                <a href="<?= admin_url ?>admin?id=<?= $admin_id ?>" class="btn btn-success">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <a href="<?= delete_url ?>id=<?= $admin_id ?>&table=<?= encrypt('admin') ?>&page=<?= encrypt('view_admins') ?>&method=simple_admin" class="btn btn-danger">
                                    <i class='bx bx-trash'></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                        $cnt++;
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