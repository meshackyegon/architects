<?php
$page = 'landlord';
include_once 'header.php';
$landlords = get_all('landlord');

$num_columns = 9;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => '#'),
        array('data' => 'Name', 'title' => 'Name'),
        array('data' => 'Email', 'title' => 'Email'),
        array('data' => 'Phone', 'title' => 'Phone'),
        array('data' => 'Properties', 'title' => 'Properties'),
        array('data' => 'Status', 'title' => 'Status'),
        array('data' => 'Action', 'title' => 'Action'),
        array('data' => 'Created On', 'title' => 'Created On')
    );
}

$add = 'landlord.php';
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> properties</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Properties</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Created On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($landlords as $landlord) {
                        $landlord_id = encrypt($landlord['landlord_id']);
                    ?>
                        <tr>
                            <td> </td>
                            <td><?= $cnt ?></td>
                            <td><?= $landlord['landlord_name'] ?></td>
                            <td><?= $landlord['landlord_email'] ?></td>
                            <td><?= $landlord['landlord_phone'] ?></td>
                            <td>
                                <a href="#" class="btn btn-info">
                                    <small>Assign</small>
                                </a>
                            </td>
                            
                            <td>
                                <?php
								if ($landlord['landlord_status'] == 'active') { ?>
									<a href="<?= base_url ?>model/update/status?id=<?= $landlord_id ?>&table=<?= encrypt('landlord') ?>&page=<?= encrypt('view_landlords') ?>" class="btn rounded-pill btn-label-dark">
										Deactivate
									</a>
								<?php
								} else { ?>
									<a href="<?= base_url ?>model/update/status?id=<?= $landlord_id ?>&table=<?= encrypt('landlord') ?>&page=<?= encrypt('view_landlords') ?>" class="btn rounded-pill btn-outline-primary">
										Activate
									</a>
								<?php
								}
								?>

                            </td>

                            <td>
                                <a href="landlord_details?id=<?= $landlord_id ?>" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url ?>model/delete?id=<?= $landlord_id ?>&table=<?= encrypt('landlord') ?>&page=<?= encrypt('view_landlords') ?>&method=simple_admin" class="btn btn-danger mt-1">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <td><?= get_ordinal_month_year($landlord['landlord_date_created']) ?></td>
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