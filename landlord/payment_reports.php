<?php
$page = 'rent_reports';
include_once 'header.php';

$houses = get_landlord_properties($profile['landlord_id']);

$unitzz = [];
foreach ($houses as $item) {
    $rows = get_by_column('property_unit', 'property_id', $item['property_id']);
    $unitzz = array_merge($unitzz, $rows);
}

if (isset($_GET['q'])) {
    $properties = "";
    if ($_POST['properties'] != "All") {
        $properties = "AND property.property_id IN ('" . implode("', '", $_POST['properties']) . "')";
    }

    $units = "";
    if ($_POST['units'] != "All") {
        $units = "AND property_unit.property_unit_id = '$_POST[units]'";
    }


    $sql = "SELECT payment.*, property.property_name, property_unit.property_unit_name ";
    $sql .= " FROM payment JOIN property ON payment.property_id = property.property_id ";
    $sql .= "  JOIN property_unit ON payment.property_unit_id = property_unit.property_unit_id ";
    $sql .= " WHERE payment.payment_paid = 'paid' AND property.added_by = '$profile[landlord_id]' " . $properties . $units;

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

$connection = connect();

// Get the current month (numerical value, 1 for January, 2 for February, etc.)
$currentMonth = date('n');
$currentYear = date('Y');

// Array to store session counts per month
$paymentCounts = [];

// Array of month names
$monthNames = [
    1 => 'January',
    2 => 'February',
    3 => 'March',
    4 => 'April',
    5 => 'May',
    6 => 'June',
    7 => 'July',
    8 => 'August',
    9 => 'September',
    10 => 'October',
    11 => 'November',
    12 => 'December',
];

// Array to store the last 12 months in full names
$last12Months = [];

// Loop through the last 12 months, starting from the current month
for ($i = 0; $i < 12; $i++) {
    // Calculate the month index, considering the year boundaries
    $monthIndex = ($currentMonth - $i) <= 0 ? ($currentMonth - $i + 12) : ($currentMonth - $i);
    // Get the month name
    $monthName = $monthNames[$monthIndex];
    // Add the month name to the array
    $last12Months[] = $monthName;
}

for ($i = 0; $i < 12; $i++) {
    // Calculate the month and year for the current iteration
    $month = $currentMonth - $i;
    $year = $currentYear;

    // Adjust the month and year if necessary to handle year boundaries
    if ($month <= 0) {
        $month += 12;
        $year--;
    }

    // Convert the month to a two-digit format (e.g., 02 for February)
    $month = sprintf('%02d', $month);

    // Get the number of days in the month
    $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    // Create the start and end dates for the current month
    $startDate = $year . '-' . $month . '-01';
    $endDate = $year . '-' . $month . '-' . $numDays;

    if (isset($_GET['q'])) {
        $properties = "";
        if ($_POST['properties'] != "All") {
            $properties = "AND payment.property_id IN ('" . implode("', '", $_POST['properties']) . "')";
        }

        $units = "";
        if ($_POST['units'] != "All") {
            $units = "AND payment.property_unit_id = '$_POST[units]'";
        }

        // SQL query to count sessions for the current month
        $sqlQuery = "SELECT COUNT(*) AS payment_count FROM payment  WHERE payment_date_created >= '$startDate' AND payment_date_created <= '$endDate' " . $properties . $units;
    } else {
        $sqlQuery = "SELECT COUNT(*) AS payment_count FROM payment WHERE payment_date_created >= '$startDate' AND payment_date_created <= '$endDate'";
    }



    // Execute the query and fetch the result
    $result = $connection->query($sqlQuery);
    $row = $result->fetch_assoc();

    // Store the session count in the array with the month name as the key
    $paymentCounts[] = (int)$row['payment_count'];
}


// Reverse the array to get the months in the correct order (from current to past)
$last12Months = array_reverse($last12Months);
$last12Months = json_encode($last12Months);

$paymentCounts = array_reverse($paymentCounts);
$paymentCounts = json_encode($paymentCounts);
?>

<head>
    <script src="<?= admin_url ?>assets/js/charts-apex.js"></script>
</head>

<div class="container-xxl flex-grow-1 container-p-y">

    <?php
    if (!empty($houses)) { ?>
        <div class="row">
            <form method="POST" action="payment_reports?q">
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

                </div>
                <button type="submit" id="submit" class="btn btn-outline-primary MyNewNew">Fetch</button>
            </form>
        </div>
    <?php
    }
    ?>


    <div class="row">
        <!-- Line Chart -->
        <div class="col-12 mb-4">
            <div class="card">
                <table class="datatables-basic table border-top" style="display: none;">
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


                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">Payments</h5>
                        <small class="text-muted">Number of payments per month</small>
                    </div>
                    <div class="d-sm-flex d-none align-items-center">
                        <h5 class="fw-bold mb-0 me-3"><?= sizeof(get_all('payment')) ?> Sessions</h5>
                        <span class="badge bg-label-secondary">
                            <i class="bx bx-down-arrow-alt bx-xs text-danger"></i>
                            <span class="align-middle"></span>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div id="lineChart"></div>
                </div>
            </div>
        </div>
        <!-- /Line Chart -->
    </div>

</div>
<!-- / Content -->



<script>
    $(document).ready(function() {
        let cardColor, headingColor, labelColor, borderColor, legendColor;

        if (isDarkStyle) {
            cardColor = config.colors_dark.cardColor;
            headingColor = config.colors_dark.headingColor;
            labelColor = config.colors_dark.textMuted;
            legendColor = config.colors_dark.bodyColor;
            borderColor = config.colors_dark.borderColor;
        } else {
            cardColor = config.colors.cardColor;
            headingColor = config.colors.headingColor;
            labelColor = config.colors.textMuted;
            legendColor = config.colors.bodyColor;
            borderColor = config.colors.borderColor;
        }

        // Color constant
        const chartColors = {
            column: {
                series1: '#826af9',
                series2: '#d2b0ff',
                bg: '#f8d3ff'
            },
            donut: {
                series1: '#fee802',
                series2: '#3fd0bd',
                series3: '#826bf8',
                series4: '#2b9bf4'
            },
            area: {
                series1: '#29dac7',
                series2: '#60f2ca',
                series3: '#a5f8cd'
            }
        };
        // Line Chart
        // --------------------------------------------------------------------
        const lineChartEl = document.querySelector('#lineChart'),
            lineChartConfig = {
                chart: {
                    height: 200,
                    type: 'line',
                    parentHeightOffset: 0,
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    data: <?php echo $paymentCounts; ?>
                }],
                markers: {
                    strokeWidth: 7,
                    strokeOpacity: 1,
                    strokeColors: [cardColor],
                    colors: [config.colors.warning]
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                colors: [config.colors.warning],
                grid: {
                    borderColor: borderColor,
                    xaxis: {
                        lines: {
                            show: true
                        }
                    },
                    padding: {
                        top: -20
                    }
                },
                tooltip: {
                    custom: function({
                        series,
                        seriesIndex,
                        dataPointIndex,
                        w
                    }) {
                        return '<div class="px-3 py-2">' + '<span>' + series[seriesIndex][dataPointIndex] + '</span>' + '</div>';
                    }
                },


                xaxis: {
                    categories: <?php echo $last12Months; ?>,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '13px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '13px'
                        }
                    }
                }
            };
        if (typeof lineChartEl !== undefined && lineChartEl !== null) {
            const lineChart = new ApexCharts(lineChartEl, lineChartConfig);
            lineChart.render();
        }

    })
</script>


<style>
    .dataTables_length,
    .dataTables_filter,
    .dataTables_info,
    .dataTables_paginate {
        display: none !important;
    }
</style>

<?php
include_once 'footer.php';
?>