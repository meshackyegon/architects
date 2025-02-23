<?php
$page = 'rent_reports';
include_once 'header.php';

$lords = get_all('landlord');
$tenants = get_all('user');
$houses = get_all('property');

$unitzz = [];
foreach ($houses as $item) {
    $rows = get_by_column('property_unit', 'property_id', $item['property_id']);
    $unitzz = array_merge($unitzz, $rows);
}

if (isset($_GET['q'])) {

    // cout($_POST);

    $properties = "";
    if ($_POST['properties'] != "All") {
        $properties = "AND property.property_id IN ('" . implode("', '", $_POST['properties']) . "')";
    }

    $units = "";
    if ($_POST['units'] != "All") {
        $units = "AND property_unit.property_unit_id = '$_POST[units]'";
    }

    $landlords = "";
    if ($_POST['landlords'] != "All") {
        $landlords = "AND property.added_by = '$_POST[landlords]' ";
    }


    $users = "";
    if ($_POST['users'] != "All") {
        $users = "AND payment.user_id = '$_POST[users]' ";
    }

    $from = "";
    if ($_POST['from'] != "") {
        $from = "AND payment.payment_date_created > '$_POST[from]' ";
    }

    $to = "";
    if ($_POST['to'] != "") {
        $to = "AND payment.payment_date_created < '$_POST[to]' ";
    }

    $sql = "SELECT payment.*, property.property_name, property_unit.property_unit_name ";
    $sql .= " FROM payment JOIN property ON payment.property_id = property.property_id ";
    $sql .= "  JOIN property_unit ON payment.property_unit_id = property_unit.property_unit_id ";
    $sql .= " WHERE payment.payment_paid = 'paid' " . $properties . $units . $landlords . $users . $from . $to;

    // cout($sql);
    $results = select_rows($sql);

    if (!empty($results)) {
        $num_columns = 8;

        $column_indexes = range(0, $num_columns - 1);

        // Create an array of column definition objects
        $column_defs = array();
        for ($i = 0; $i < $num_columns; $i++) {
            $column_defs = array(
                array('data' => '', 'title' => 'id'),
                array('data' => 'col_' . $i, 'title' => '#'),
                array('data' => 'property_image', 'title' => 'Tenant'),
                array('data' => 'property_image2', 'title' => 'Property'),
                array('data' => 'property_price', 'title' => 'Units'),
                array('data' => 'property_name', 'title' => 'Amount'),
                array('data' => 'property_other', 'title' => 'Transaction Date'),
                array('data' => '', 'title' => 'Action')
            );
        }
    }
}

?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> Reports</h4>

    <!-- DataTable with Buttons -->
    <div class="card">

        <?php
        if (!empty($houses)) { ?>
            <div class="card-body">
                <form method="POST" action="rent_reports?q">


                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-12 mb-4">
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

                        <div class="col-md-6 col-sm-12 col-12 mb-4">
                            <label for="units" class="form-label">Property Unit</label>
                            <select name="units" id="units" class="form-select form-select-lg" data-allow-clear="true">
                                <option value="All">All</option>
                                <?php
                                foreach ($unitzz as $unit) { ?>
                                    <option data-property-id="<?= $unit['property_id'] ?>" value="<?= $unit['property_unit_id'] ?>"><?= $unit['property_unit_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>


                        <div class="col-md-6 col-sm-12 col-12 mb-4">
                            <label for="landlords" class="form-label">Landlord:</label>
                            <select name="landlords" id="landlords" class="select2 form-select form-select-lg" data-allow-clear="true">
                                <option value="All">All</option>
                                <?php
                                foreach ($lords as $landlord) { ?>
                                    <option value="<?= $landlord['landlord_id'] ?>"><?= $landlord['landlord_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-6 col-sm-12 col-12 mb-4">
                            <label for="users" class="form-label">Tenants</label>
                            <select name="users" id="users" class="select2 form-select form-select-lg" data-allow-clear="true">
                                <option value="All">All</option>
                                <?php
                                foreach ($tenants as $user) { ?>
                                    <option value="<?= $user['user_id'] ?>"><?= $user['user_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 col-sm-12 col-12 mb-4">
                            <?php
                            input_hybrid("From", "from", $row, false, 'date');
                            ?>
                        </div>

                        <div class="col-md-6 col-sm-12 col-12 mb-4">
                            <?php
                            input_hybrid("to", "to", $row, false, 'date');
                            ?>
                        </div>
                    </div>


                    <button type="submit" id="submit" class="btn btn-outline-primary MyNewNew">Fetch</button>
                </form>
            </div>
        <?php
        }
        ?>


        <?php

        if (isset($_GET['q'])) { ?>
            <div class="card-datatable table-responsive">
                <table class="datatables-basic table border-top">
                    <thead>
                        <tr>
                            <th></th>

                            <th>No.</th>
                            <th>Tenant</th>
                            <th>Property</th>

                            <th>Unit</th>
                            <th>Amount</th>
                            <th>Transaction Date</th>

                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $cnt = 1;
                        foreach ($results as $payment) {
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
                                <td><?= ($payment['payment_date_created']) ?></td>
                            </tr>

                        <?php $cnt++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        <?php
        }
        ?>
    </div>



</div>
<!-- / Content -->

<script>
    $(document).ready(function() {
        $('#properties').change(function() {
            var selectedPropertyId = $(this).val();
            console.log(selectedPropertyId)
            $('#units option').hide(); // Hide all options
            $('#units option[data-property-id="' + selectedPropertyId + '"]').show(); // Show options matching selected property
        });
    });
</script>

<style>
    input{
        height:40px !important;
    }
</style>

<?php
include_once 'footer.php';
?>