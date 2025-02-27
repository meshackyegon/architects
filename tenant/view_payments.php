<?php
$page = 'payment';
include_once 'header.php';

// $payments = get_by_column('payment', 'user_id', $profile['user_id']);

$sql = "SELECT * FROM payments WHERE user_id = '$profile[user_id]' ORDER BY transaction_date DESC  ";
$payments = select_rows($sql);
// cout($payments);
$num_columns = 7;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => '#'),
        array('data' => 'project_name', 'title' => 'Project'),
        array('data' => 'project_type', 'title' => 'Type'),
        array('data' => 'amount', 'title' => 'Amount'),
        array('data' => 'transaction_date', 'title' => 'Date'),
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
                        <th>Project</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>View Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($payments as $payment) {
                        $property = get_by_id('project', $payment['project_id']);
                        // cout($property);
                        $property_id = encrypt($property['project_id']);
                        // if ($property['has_unit'] == 'yes') {
                        //     $unit = get_by_id('property_unit', $payment['property_unit_id']);
                        //     $name = $unit['property_unit_name'];
                        //     $amount = $unit['property_unit_price'];
                        //     $link = 'invoice?id='. $property_id . '&unit='.encrypt($unit['property_unit_id']);
                        // } else {
                            $name = $property['project_name'];
                            $amount = $payment['amount'];
                            $link = 'invoice?id='. $property_id;
                        // }
                    ?>
                        <tr>
                            <td> </td>
                            <td><?= $cnt ?></td>
                            <td><?= $property['project_name'] ?></td>
                            <td>
                                <?= $name ?>
                            </td>
                            <td>
                                <?= $amount ?>
                            </td>
                            <td><?= $payment['transaction_date'] ?></td>
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