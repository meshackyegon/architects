<?php
$page = 'payment';
include_once 'header.php';

$houses = get_landlord_properties($profile['landlord_id']);

if (isset($_GET['q'])) {
    $properties = "";
    if ($_POST['properties'] != "All") {
        $properties = "AND property.property_id IN ('" . implode("', '", $_POST['properties']) . "')";
    }

    $sql = "SELECT payment.*, property.property_name, property_unit.property_unit_name ";
    $sql .= " FROM payment JOIN property ON payment.property_id = property.property_id ";
    $sql .= "  JOIN property_unit ON payment.property_unit_id = property_unit.property_unit_id ";
    $sql .= " WHERE payment.payment_paid = 'paid' AND property.added_by = '$profile[landlord_id]' " . $properties;
} else {
    $sql = "SELECT payment.*, property.property_name, property_unit.property_unit_name ";
    $sql .= " FROM payment JOIN property ON payment.property_id = property.property_id ";
    $sql .= "  JOIN property_unit ON payment.property_unit_id = property_unit.property_unit_id ";
    $sql .= " WHERE payment.payment_paid = 'paid' AND property.added_by = '$profile[landlord_id]' ";
}

$payments = select_rows($sql);

$num_columns = 8;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => '#'),
        array('data' => 'property_others', 'title' => 'Tenant Name'),
        array('data' => 'property_name', 'title' => 'Property'),
        array('data' => 'property_other', 'title' => 'Unit'),
        array('data' => 'property_image', 'title' => 'How Much Unit Costs'),
        array('data' => 'property_image2', 'title' => 'How Much Tenant Paid'),
        array('data' => 'property_price', 'title' => 'Paid On')
    );
}
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">M-Pesa</span> Standing Order Payments</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-body">
            <?php
            if (!empty($houses)) { ?>
                <div class="card-body">
                    <form method="POST" action="rent_reports?q">
                        <div class="row">
                            <div class="divider MyDiver">
                                <div class="divider-text">Properties</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="property"><?= ucfirst('Properties ') ?> : <?= !empty($property) ? $rules : '' ?> </label>
                                        <select id="exampleFormControlSelect" multiple data-placeholder="Select properties. You may choose more than 1." class="select2 form-control" name="properties[]">

                                            <?php foreach ($houses as $b) {
                                                $property_id = $b['property_id'];
                                            ?>
                                                <option value="<?= $property_id ?>"><?= ucwords($b['property_name']) ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="submit" class="btn btn-outline-primary MyNewNew">Fetch</button>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>

        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>No.</th>
                        <th>Tenant</th>
                        <th>Property</th>
                        <th>Unit</th>
                        <th>How Much Unit Costs</th>
                        <th>How Much Tenant Paid</th>
                        <th>Paid On</th>
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
                        } else {
                            $name = $property['property_name'];
                            $amount = $property['property_price'];
                        }
                    ?>
                        <tr>
                            <td> </td>
                            <td><?= $cnt ?></td>
                            <td><?= get_by_id('user', $payment['user_id'])['user_name'] ?></td>
                            <td><?= $property['property_name'] ?></td>
                            <td>
                                <?= $name ?>
                            </td>
                            <td>
                                <?= $amount ?>
                            </td>
                            <td><?= $payment['payment_amount'] ?></td>
                            <td><?= get_ordinal_month_year($payment['payment_date_created']) ?></td>
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