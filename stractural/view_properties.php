<?php
$page = 'property';
include_once 'header.php';

$sql = "SELECT * FROM booking WHERE user_id = '$profile[user_id]'    ";
$row = select_rows($sql)[0];


$properties = get_by_column('property', 'property_id', $row['property_id']);

$num_columns = 7;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => '#'),
        array('data' => 'property_name', 'title' => 'Title'),
        array('data' => 'property_other', 'title' => 'Rent Due On:'),
        array('data' => 'property_image', 'title' => 'First Image'),
        array('data' => 'property_image2', 'title' => 'Second Image'),
        array('data' => 'property_price', 'title' => 'Standing Orders')
    );
}
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
                        <th>Title</th>
                        <th>Rent Due On:</th>
                        <th>First Image</th>
                        <th>Second Image</th>
                        <th>Standing Orders</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($properties as $property) {
                        $property_id = encrypt($property['property_id']);
                        $image_type = !empty(get_image($property['property_id'])) ? 'Edit/View' : 'Add';

                    ?>
                        <tr>
                            <td> </td>
                            <td><?= $cnt ?></td>
                            <td><?= $property['property_name'] ?></td>
                            <td>
                                <?= get_ordinal_day($property['property_due']) . " of every month" ?>
                            </td>
                            <td>
                                <img alt="property image <?= $property['property_name'] ?>" src="<?= file_url . $property['property_image'] ?>" style="width:150px; height:auto; border-radius:5px;" title="<?= $property['property_name'] ?>">
                            </td>
                            <td>
                                <img alt="property image <?= $property['property_name'] ?>" src="<?= file_url . $property['property_image2'] ?>" style="width:150px; height:auto; border-radius:5px;" title="<?= $property['property_name'] ?>">
                            </td>

                            <td>
                                    <a href="view_payments" class="btn btn-info">
                                        <small>View</small>
                                    </a>
               
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