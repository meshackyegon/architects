<?php
$page = 'payment';
include_once 'header.php';

// $payments = get_by_column('payment', 'user_id', $profile['user_id']);

$sql = "SELECT * FROM payment WHERE user_id = '$profile[user_id]' ORDER BY payment_date_created DESC  ";
$payments = select_rows($sql);

$num_columns = 7;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => '#'),
        array('data' => 'property_name', 'title' => 'Property'),
        array('data' => 'property_other', 'title' => 'Unit'),
        array('data' => 'property_image', 'title' => 'How Much Unit Costs'),
        array('data' => 'property_image2', 'title' => 'How Much Was Withdrawn'),
        array('data' => 'property_price', 'title' => 'View Invoice'),
    );
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Your</span> Standing Order Payments</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>No.</th>
                        <th>Property</th>
                        <th>Unit</th>
                        <th>How Much Unit Costs</th>
                        <th>How Much Was Withdrawn</th>
                        <th>View Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($payments as $payment) {
                        $property = get_by_id('property', $payment['property_id']);
                        $property_id = encrypt($property['property_id']);
                        if ($property['has_unit'] == 'yes') {
                            $unit = get_by_id('property_unit', $payment['property_unit_id']);
                            $name = $unit['property_unit_name'];
                            $amount = $unit['property_unit_price'];
                            $link = 'invoice?id='. $property_id . '&unit='.encrypt($unit['property_unit_id']);
                        } else {
                            $name = $property['property_name'];
                            $amount = $property['property_price'];
                            $link = 'invoice?id='. $property_id;
                        }
                    ?>
                        <tr>
                            <td> </td>
                            <td><?= $cnt ?></td>
                            <td><?= $property['property_name'] ?></td>
                            <td>
                                <?= $name ?>
                            </td>
                            <td>
                                <?= $amount ?>
                            </td>
                            <td><?= $payment['payment_amount'] ?></td>
                             <td>
                                    <a href="<?= $link ?>" class="btn btn-info">
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