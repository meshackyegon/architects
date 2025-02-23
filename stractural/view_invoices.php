<?php
$page = 'invoice';
include_once 'header.php';
$invoices = get_all('invoice');

$num_columns = 14;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => 'id'),
        array('data' => 'invoice_phone', 'title' => 'Invoice Number'),
        array('data' => 'invoice_name', 'title' => 'Customer Name'),
        array('data' => 'invoice_email', 'title' => 'Customer ID.'),
        array('data' => 'a', 'title' => 'Product Name'),
        array('data' => 'b', 'title' => ' Amount'),
        array('data' => 'v', 'title' => 'Channel(MOF)'),
        array('data' => 'cs', 'title' => 'Monthly Premium'),
        array('data' => 'aa', 'title' => 'Balance'),
        array('data' => 'aaa', 'title' => 'Payment Date'),
        array('data' => 'asa', 'title' => 'Renewal Date'),
        array('data' => 'adva', 'title' => 'Status'),
        array('data' => 'ava', 'title' => 'Action')
    );
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> invoices</h4>
   
    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th> </th>

                        <th>id</th>

                        <th>Invoice No</th>
                        <th>Customer Name</th>
                        <th>Customer ID</th>
                        <th>Product Name</th>
                        <th> Amount </th>
                        <th>Channel(MOF) </th>
                        <th>MonthlyPremium</th>
                        <th>Balance</th>
                        <th> Payment Date</th>
                        <th>Renewal Date </th>
                        <th>Status </th>
                        <th>Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($invoices as $invoice) {
                        $invoice_id = encrypt($invoice['invoice_id']);
                        $user = get_by_id('user', $invoice['user_id']);
                        $product = get_by_id('product', $invoice['product_id']);

                    ?>
                        <tr>
                            <td> </td>
                            <td><?= $cnt ?></td>
                            <td><?= $invoice['invoice_code'] ?></td>
                            <td><?= $user['user_name'] ?></td>
                            <td><?= $user['user_passport'] ?></td>
                            <td>
                                <?= $product['product_name'] ?>
                            </td>
                            <td><?= $invoice['invoice_amount'] ?></td>
                            <td>
                                <?= $invoice['invoice_channel'] ?>
                            </td>
                            <td>
                                <?= $invoice['invoice_premium'] ?>

                            </td>
                            <td>
                                <?= $invoice['invoice_balance'] ?>

                            </td>
                            <td>
                                <?= $invoice['invoice_status'] ?>

                            </td>
                            <td> <?= get_ordinal_month_year($invoice['invoice_deadline']) ?> </td>
                            <td> <?= get_ordinal_month_year($invoice['invoice_renewal']) ?> </td>


                            <td>
                                <a href="<?= admin_url ?>user?id=<?= $user_id ?>" class="btn btn-success">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <a href="<?= delete_url ?>id=<?= $user_id ?>&table=<?= encrypt('user') ?>&page=<?= encrypt('view_users') ?>&method=user" class="btn btn-danger">
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