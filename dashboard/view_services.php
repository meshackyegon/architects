<?php
$page = 'service';
include_once 'header.php';
$services = get_all('service');

$num_columns = 7;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => '#'),
        array('data' => 'service_image', 'title' => 'First Image'),
        array('data' => 'service_name', 'title' => 'Title'),
        array('data' => 'service_price', 'title' => 'Price'),
        array('data' => '', 'title' => 'Action'),
        array('data' => 'service_date_created', 'title' => 'Created On')
    );
}

$add = 'service.php';
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> services</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>

                        <th>No.</th>
                        <th>First Image</th>

                        <th>Title</th>
                        <th>Price</th>

                        <th>Action</th>
                        <th>Created On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($services as $service) {
                        $service_id = encrypt($service['service_id']);
                       
                    ?>
                        <tr>
                            <td> </td>
                            <td><?= $cnt ?></td>
                            <td>
                                <img alt="service image <?= $service['service_name'] ?>" src="<?= file_url . $service['service_image'] ?>" style="width:150px; height:auto; border-radius:5px;" title="<?= $service['service_name'] ?>">
                            </td>
                            
                            <td><?= $service['service_name'] ?></td>
                           
                            <td><?= $service['service_price'] ?></td>


                          

                            <td>
                                <a href="<?= admin_url ?>service_details?id=<?= $service_id ?>" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="../model/delete?id=<?= $service_id ?>&table=<?= encrypt('service') ?>&page=<?= encrypt('view_services') ?>&method=service" class="btn btn-danger mt-1">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>

                            <td><?= get_ordinal_month_year($service['service_date_created']) ?></td>
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


<?php include_once 'footer.php'; ?>