<?php
$page = 'booking';
include_once 'header.php';
// $landlords = get_all('landlord');

$num_columns = 10;

$column_indexes = range(0, $num_columns - 1);
$sql="SELECT * FROM project pr JOIN  payments p ON  pr.project_id=p.project_id JOIN user u on pr.user_id=u.user_id WHERE p.payment_status='paid' AND p.visit ='not visited' ";
$results=select_rows($sql);
// cout($results);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => '#'),
        array('data' => 'Project', 'title' => 'Project'),
        array('data' => 'Type', 'title' => 'Type'),
        array('data' => 'Name', 'title' => 'Name'),
        array('data' => 'Date', 'title' => 'Date'),
        array('data' => 'Amount', 'title' => 'Amount'),
        array('data' => 'Location', 'title' => 'Location'),
        array('data' => 'Action', 'title' => 'Action'),
        array('data' => 'Created On', 'title' => 'Created On')
    );
}

// $add = 'landlord.php';
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> Bookings</h4>

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
                        <th>Client</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Location</th>
                        <th>Action</th>
                        <th>Created On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($results as $result) {
                        $payment_id = encrypt($result['payment_id']);
                    ?>
                        <tr>
                            <td> </td>
                            <td><?= $cnt ?></td>
                            <td><?= $result['project_name'] ?></td>
                            <td><?= $result['project_type'] ?></td>
                            <td><?= $result['user_name'] ?></td>
                            <td><?= $result['visit_date'] ?></td>
                            <td><?= $result['amount'] ?></td>
                            <td><?= $result['location_pin'] ?></td>
                            
                            <td>
                                <?php
								if ($result['visit'] == 'not visited') { ?>
									<a href="<?= base_url ?>model/update/visit?id=<?= $payment_id ?>&table=<?= encrypt('payments') ?>&page=<?= encrypt('view_bookings') ?>" class="btn rounded-pill btn-label-dark">
										Visit
									</a>
								<?php
								} else { ?>
									 visited									
								<?php
								}
								?>

                            </td>

                            <!-- <td>
                                <a href="landlord_details?id=<?= $payment_id ?>" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url ?>model/delete?id=<?= $payment_id ?>&table=<?= encrypt('payments') ?>&page=<?= encrypt('booking') ?>&method=simple_admin" class="btn btn-danger mt-1">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td> -->
                            <td><?= get_ordinal_month_year($result['transaction_date']) ?></td>
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