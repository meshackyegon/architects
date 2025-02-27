<?php
$page        = 'dashboard';
$header_name = 'Home';

require_once 'header.php';

// $past_sessions  = get_past_sessions();
// $next_sessions  = get_upcoming_sessions();

$connection = connect();


// Get the current month (numerical value, 1 for January, 2 for February, etc.)
$currentMonth = date('n');
$currentYear = date('Y');

// Function to calculate distribution
function calculateDistribution($rentPaid) {
    $kraAmount = $rentPaid * 0.075;
    $rentpesaAmount = $rentPaid * 0.05;
    $safaricomAmount = $rentpesaAmount * 0.025;
    $landlordAmount = $rentPaid - $kraAmount - $rentpesaAmount;
    return [
        'total' => $rentPaid,
        'kra' => $kraAmount,
        'rentpesa' => $rentpesaAmount,
        'safaricom' => $safaricomAmount,
        'landlord' => $landlordAmount
    ];
}


// Get monthly data for the current year
$sql = "SELECT MONTH(payment.payment_date_created) AS month, SUM(payment.payment_amount) AS total_payment_amount 
        FROM payment 
        JOIN property ON payment.property_id = property.property_id 
        WHERE YEAR(payment.payment_date_created) = $currentYear 
        GROUP BY MONTH(payment.payment_date_created) 
        ORDER BY month ASC";
$monthlyData = select_rows($sql);

// Get total amount received in the current year
$sql = "SELECT SUM(payment.payment_amount) AS total_year_amount 
        FROM payment 
        JOIN property ON payment.property_id = property.property_id 
        WHERE YEAR(payment.payment_date_created) = '$currentYear'";
$totalYearAmount = select_rows($sql)[0]['total_year_amount'] ?? 0;


// Get data for the current month
$sql = "SELECT SUM(payment.payment_amount) AS total_payment_amount 
        FROM payment 
        JOIN property ON payment.property_id = property.property_id 
        WHERE YEAR(payment.payment_date_created) = $currentYear 
        AND MONTH(payment.payment_date_created) = $currentMonth";
$currentMonthData = select_rows($sql);

$currentMonthTotal = $currentMonthData[0]['total_payment_amount'] ?? 0;
$distribution = calculateDistribution($currentMonthTotal);

// Get monthly user data for the current year
$sql = "
    WITH RECURSIVE months AS (
        SELECT DATE_FORMAT(CURDATE(), '%Y-%m-01') AS month_date
        UNION ALL
        SELECT DATE_FORMAT(DATE_SUB(month_date, INTERVAL 1 MONTH), '%Y-%m-01')
        FROM months
        WHERE month_date > DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 11 MONTH), '%Y-%m-01')
    )
    SELECT 
        DATE_FORMAT(m.month_date, '%Y-%m') AS `year_month`, 
        COALESCE(COUNT(user.user_id), 0) AS `total_users`
    FROM 
        months m
    LEFT JOIN 
        `user` ON DATE_FORMAT(user.user_date_created, '%Y-%m') = DATE_FORMAT(m.month_date, '%Y-%m')
    GROUP BY 
        m.month_date
    ORDER BY 
        m.month_date ASC
";
$userData = select_rows($sql);

$totalUsersLast12Months = array_sum(array_column($userData, 'total_users'));


// Array to store session counts per month
$sessionCounts = [];

// Array of month names
$monthNames = [
    1 => 'Jan',
    2 => 'Feb',
    3 => 'Mar',
    4 => 'Apr',
    5 => 'May',
    6 => 'Jun',
    7 => 'Jul',
    8 => 'Aug',
    9 => 'Sept',
    10 => 'Oct',
    11 => 'Nov',
    12 => 'Dec',
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

    // SQL query to count sessions for the current month
    $sqlQuery = "SELECT COUNT(*) AS booking_count FROM booking 
                 WHERE booking_date_created >= '$startDate' AND booking_date_created <= '$endDate'";

    // Execute the query and fetch the result
    $result = $connection->query($sqlQuery);
    $row = $result->fetch_assoc();

    // Store the session count in the array with the month name as the key
    $sessionCounts[] = (int)$row['booking_count'];
}

// Find the index of the month with the lowest session count
$lowestMonthIndex = array_keys($sessionCounts, min($sessionCounts))[0] - 1;
// Find the index of the month with the highest session count
$highestMonthIndex = array_keys($sessionCounts, max($sessionCounts))[0] + 1;

if ($lowestMonthIndex == 12) {
    $lowestMonthIndex = 0;
}

if ($highestMonthIndex == 12) {
    $highestMonthIndex = 0;
}


// Retrieve the names of the lowest and highest months
$lowestMonth = $last12Months[$lowestMonthIndex];
$highestMonth = $last12Months[$highestMonthIndex];

// cout($lowestMonthIndex);
// cout($highestMonthIndex);

// Output the results


// Reverse the array to get the months in the correct order (from current to past)
$last12Months = array_reverse($last12Months);
$last12Months = json_encode($last12Months);

$sessionCounts = array_reverse($sessionCounts);
$sessionCounts = json_encode($sessionCounts);


$last6Years = [];

// Loop through the last 6 years, starting from the current year
for ($i = 0; $i < 6; $i++) {
    // Calculate the year by subtracting the index from the current year
    $year = $currentYear - $i;
    // Add the year to the array
    $last6Years[] = $year;
}

// Reverse the array to get the years in descending order
$last6Years = array_reverse($last6Years);
$last6Years = json_encode($last6Years);

// cout($last6Years);



// Total number of users
$sql_total_users = "SELECT COUNT(*) as total_users FROM `user`";
$total_users_result = select_rows($sql_total_users);
$total_users = $total_users_result[0]['total_users'];

// Number of users added by the admin
$sql_admin_users = "SELECT COUNT(*) as admin_users FROM `user` WHERE added_by = 'admin'";
$admin_users_result = select_rows($sql_admin_users);
$admin_users = $admin_users_result[0]['admin_users'];

// Number of users who weren't added by the admin
$non_admin_users = $total_users - $admin_users;

// Calculate percentages
$admin_percentage = ($admin_users / $total_users) * 100;
$non_admin_percentage = ($non_admin_users / $total_users) * 100;

// Round percentages to whole numbers
$admin_percentage = round($admin_percentage);
$non_admin_percentage = round($non_admin_percentage);

// cout($admin_percentage);

// cout($non_admin_percentage);
$sql = "SELECT SUM(payments.amount) AS total_payment_amount 
             FROM payments where payment_status='paid'
             ";

$row = select_rows($sql)[0];
// cout($row);

?>

<head>
    <script src="assets/js/charts-apex.js"></script>
</head>
<div class="container-xxl flex-grow-1 container-p-y">
    <h2>ADMINISTRATIVE DASHBOARD</h2>
    <div class="row">
        <div class="col-lg-3 mb-3 ml-2 mr-2">
            <div class="card">
                <div class="card-body">
                    <a href="view_projects">
                        <div class="d-flex" style="align-items: center; justify-content:center;">
                            <div style="background-color: #EFF4FF;" class="OverviewCircle">
                                <img src="assets/img/icons/card.png" class="OverviewIcon" />
                            </div>
                            <div style="width: auto; margin-left:5px;">
                                <h5 class="text-nowrap mb-2">Projects</h5>
                                <small class="text-success text-nowrap fw-semibold"><?= sizeof(get_all('project')) ?></small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <div class="col-lg-3 mb-3 ml-2 mr-2">
            <div class="card">
                <div class="card-body">
                    <a href="view_users">
                        <div class="d-flex" style="align-items: center; justify-content:center;">
                            <div style="background-color: #EFF4FF;" class="OverviewCircle">
                                <img src="assets/img/icons/card.png" class="OverviewIcon" />
                            </div>
                            <div style="width: auto; margin-left:5px;">
                                <h5 class="text-nowrap mb-2">Clients</h5>
                                <small class="text-success text-nowrap fw-semibold"><?= sizeof(get_all('user')) ?></small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <div class="col-lg-3 mb-3 ml-2 mr-2">
            <div class="card">
                <div class="card-body">
                    <a href="#">
                        <div class="d-flex" style="align-items: center; justify-content:center;">
                            <div style="background-color: #EFF4FF;" class="OverviewCircle">
                                <img src="assets/img/icons/card.png" class="OverviewIcon" />
                            </div>
                            <div style="width: auto; margin-left:5px;">
                                <h5 class="text-nowrap mb-2">Payments Paid (<?= $currentYear ?>)</h5>
                                <small class="text-success text-nowrap fw-semibold">Ksh. <?= number_format($row['total_payment_amount'], 2) ?></small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-3 ml-2 mr-2">
            <div class="card">
                <div class="card-body">
                    <a href="#">
                        <div class="d-flex" style="align-items: center; justify-content:center;">
                            <div style="background-color: #EFF4FF;" class="OverviewCircle">
                                <img src="assets/img/icons/card.png" class="OverviewIcon" />
                            </div>
                            <div style="width: auto; margin-left:5px;">
                                <h5 class="text-nowrap mb-2">Payments Paid (<?= $currentYear ?>)</h5>
                                <small class="text-success text-nowrap fw-semibold">Ksh. <?= number_format($row['total_payment_amount'], 2) ?></small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        







    </div>
    <div class="row">
        <div class="col-lg-3 mb-3 ml-2 mr-2">
            <div class="card">
                <div class="card-body">
                    <a href="view_architects">
                        <div class="d-flex" style="align-items: center; justify-content:center;">
                            <div style="background-color: #EFF4FF;" class="OverviewCircle">
                                <img src="assets/img/icons/card.png" class="OverviewIcon" />
                            </div>
                            <div style="width: auto; margin-left:5px;">
                                <h5 class="text-nowrap mb-2">Architects Enginners</h5>
                                <small class="text-success text-nowrap fw-semibold"><?= sizeof(get_all('architect')) ?></small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <div class="col-lg-3 mb-3 ml-2 mr-2">
            <div class="card">
                <div class="card-body">
                    <a href="view_stracturals">
                        <div class="d-flex" style="align-items: center; justify-content:center;">
                            <div style="background-color: #EFF4FF;" class="OverviewCircle">
                                <img src="assets/img/icons/card.png" class="OverviewIcon" />
                            </div>
                            <div style="width: auto; margin-left:5px;">
                                <h5 class="text-nowrap mb-2">Structurals Engineers</h5>
                                <small class="text-success text-nowrap fw-semibold"><?= sizeof(get_all('structural')) ?></small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <div class="col-lg-3 mb-3 ml-2 mr-2">
            <div class="card">
                <div class="card-body">
                    <a href="view_electricals">
                        <div class="d-flex" style="align-items: center; justify-content:center;">
                            <div style="background-color: #EFF4FF;" class="OverviewCircle">
                                <img src="assets/img/icons/card.png" class="OverviewIcon" />
                            </div>
                            <div style="width: auto; margin-left:5px;">
                                <h5 class="text-nowrap mb-2">Electricals Enginners</h5>
                                <small class="text-success text-nowrap fw-semibold"><?= sizeof(get_all('electrical')) ?></small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-3 ml-2 mr-2">
            <div class="card">
                <div class="card-body">
                    <a href="view_mechanicals">
                        <div class="d-flex" style="align-items: center; justify-content:center;">
                            <div style="background-color: #EFF4FF;" class="OverviewCircle">
                                <img src="assets/img/icons/card.png" class="OverviewIcon" />
                            </div>
                            <div style="width: auto; margin-left:5px;">
                                <h5 class="text-nowrap mb-2">Mechanical Engineers</h5>
                                <small class="text-success text-nowrap fw-semibold"><?= sizeof(get_all('mechanical')) ?></small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        







    </div>
            <div class="row">
            <!-- Total Income -->
            <div class="col-md-12 col-lg-12 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-8">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Total Income</h5>
                                <small class="card-subtitle">Yearly report overview</small>
                            </div>
                            
                                <div class="card-body">
                                    <div id="totalIncomeChart"></div>
                                </div>
                            
                        </div>
                        <div class="col-md-4">
                                <div class="card-header d-flex justify-content-between">
                                    <div>
                                        <h5 class="card-title mb-0" id="reportTitle">Report for <?= date('F Y') ?></h5>
                                        <small class="card-subtitle" id="monthlyAvg">Monthly Amount: Ksh. <?= number_format($currentMonthTotal, 2) ?></small>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="monthSelector" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-calendar"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="monthSelector">
                                            <?php
                                            foreach ($monthlyData as $data) {
                                                $monthName = date('F', mktime(0, 0, 0, $data['month'], 10));
                                                echo "<a class='dropdown-item' href='javascript:void(0);' onclick='updateReportCard({$data['month']}, {$data['total_payment_amount']}, \"$monthName\")'>$monthName</a>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="report-list">
                                        <div class="report-list-item rounded-2 mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="report-list-icon shadow-sm me-2">
                                                    <img src="<?= file_url . 'kra.png' ?>" width="100" height="50" alt="KRA" />
                                                </div>
                                                <div class="d-flex justify-content-between align-items-end w-100 flex-wrap gap-2">
                                                    <div class="d-flex flex-column">
                                                        <span>KRA (7.5%)</span>
                                                        <h5 class="mb-0" id="kraAmount">Ksh. <?= number_format($distribution['kra'], 2) ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-list-item rounded-2 mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="report-list-icon shadow-sm me-2">
                                                    <img src="<?= file_url . 'domysuma-logo.svg' ?>" width="100" height="50" alt="Rentpesa" />
                                                </div>
                                                <div class="d-flex justify-content-between align-items-end w-100 flex-wrap gap-2">
                                                    <div class="d-flex flex-column">
                                                        <span>Domysuma (5%)</span>
                                                        <h5 class="mb-0" id="rentpesaAmount">Ksh. <?= number_format($distribution['rentpesa'], 2) ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-list-item rounded-2 mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="report-list-icon shadow-sm me-2">
                                                    <img src="<?= file_url . 'safaricom.png' ?>" width="100" height="50" alt="Safaricom" />
                                                </div>
                                                <div class="d-flex justify-content-between align-items-end w-100 flex-wrap gap-2">
                                                    <div class="d-flex flex-column">
                                                        <span>Safaricom (2.5% of Domysuma)</span>
                                                        <h5 class="mb-0" id="safaricomAmount">Ksh. <?= number_format($distribution['safaricom'], 2) ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-list-item rounded-2">
                                            <div class="d-flex align-items-start">
                                                <div class="report-list-icon shadow-sm me-2">
                                                    <img src="<?= file_url . 'building.jpg' ?>" width="100" height="50" alt="Landlord" />
                                                </div>
                                                <div class="d-flex justify-content-between align-items-end w-100 flex-wrap gap-2">
                                                    <div class="d-flex flex-column">
                                                        <span>Architects</span>
                                                        <h5 class="mb-0" id="landlordAmount">Ksh. <?= number_format($distribution['landlord'], 2) ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          
                        </div>
                    </div>
                </div>
                <!--/ Total Income -->
            </div>
            
        </div>



    <div class="row">
        <!-- Line Chart -->
        <div class="col-md-8 col-lg-8 col-sm-12 col-12  mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">Clientss</h5>
                        <small class="text-muted">Number of customers signed up in past the 1 year</small>
                    </div>
                    <div class="d-sm-flex d-none align-items-center">
                        <h5 class="fw-bold mb-0 me-3"><?= $totalUsersLast12Months ?> Registered users</h5>

                    </div>
                </div>
                <div class="card-body MyChartBox">
                    <div id="customerRatingsChart" class="MyChart"></div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-4 col-sm-12 col-12  mb-4">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Quick Actions</h5>

                </div>
                <div class="card-body">
                    <!-- <a href="landlord" class="btn rounded-pill btn-outline-info" style="width:100%;margin-bottom: 10px;">Add Landlord</a> -->
                    <a href="user" class="btn rounded-pill btn-outline-info" style="width:100%;margin-bottom: 10px;">Add Clientst</a>
                    <!-- <a href="property" class="btn rounded-pill btn-outline-info" style="width:100%;margin-bottom: 10px;">Add Property</a> -->
                    <a href="rent_reports" class="btn rounded-pill btn-outline-info" style="width:100%;margin-bottom: 10px;">View Reports</a>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12 col-12  mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <small class="text-muted">Commission Collected Over the last 6 Years </small>
                    </div>

                </div>
                <div class="card-body MyBarChart MyChartBox">
                    <canvas id="barChart" class="chartjs MyChart" data-height="400"></canvas>
                </div>
            </div>
        </div>

    </div>


</div>
<!-- / Content -->

<!-- Page JS -->

<style>
    .MyChartBox {
        /* height: 200px !important; */
    }

    .MyBarChart .MyChart {
        height: 300px !important;
    }

    .OverviewCircle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        padding: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .OverviewIcon {
        width: 30px;
        height: 30px;
    }

    .AddText {}
</style>


<script>
    $(document).ready(function() {

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

        let cardColor, headingColor, labelColor, borderColor, legendColor;


        cardColor = "#fff";
        headingColor = '#566a7f';
        labelColor = config.colors.textMuted;
        legendColor = config.colors.bodyColor;
        borderColor = '#eceef1';







        const purpleColor = '#836AF9',
            yellowColor = '#ffe800',
            cyanColor = '#28dac6',
            orangeColor = '#FF8132',
            orangeLightColor = '#FDAC34',
            oceanBlueColor = '#299AFF',
            greyColor = '#4F5D70',
            greyLightColor = '#EDF1F4',
            blueColor = '#2B9AFF',
            blueLightColor = '#84D0FF';

        // Bar Chart Configuration
// Bar Chart Configuration
const barChart = document.getElementById('barChart');
if (barChart) {
    const barChartVar = new Chart(barChart, {
        type: 'bar',
        data: {
            labels: <?= $last6Years ?>,
            datasets: [
                {
                    label: 'Landlord',
                    data: [220000, 116000, 152000, 200000, 180000, 156000],
                    backgroundColor: '#4e73df',
                    borderColor: 'transparent',
                    maxBarThickness: 12,
                    barPercentage: 0.7,
                    categoryPercentage: 0.9,
                    borderRadius: {
                        topRight: 10,
                        topLeft: 10
                    }
                },
                {
                    label: 'KRA',
                    data: [20630, 10880, 14250, 18750, 16880, 14630],
                    backgroundColor: '#1cc88a',
                    borderColor: 'transparent',
                    maxBarThickness: 12,
                    barPercentage: 0.7,
                    categoryPercentage: 0.9,
                    borderRadius: {
                        topRight: 10,
                        topLeft: 10
                    }
                },
                {
                    label: 'RentPesa',
                    data: [13750, 7250, 9500, 12500, 11250, 9750],
                    backgroundColor: '#36b9cc',
                    borderColor: 'transparent',
                    maxBarThickness: 12,
                    barPercentage: 0.7,
                    categoryPercentage: 0.9,
                    borderRadius: {
                        topRight: 10,
                        topLeft: 10
                    }
                },
                {
                    label: 'Safaricom',
                    data: [340, 180, 240, 310, 280, 240],
                    backgroundColor: '#f6c23e',
                    borderColor: 'transparent',
                    maxBarThickness: 12,
                    barPercentage: 0.7,
                    categoryPercentage: 0.9,
                    borderRadius: {
                        topRight: 10,
                        topLeft: 10
                    }
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 500
            },
            plugins: {
                tooltip: {
                    rtl: true,
                    backgroundColor: "#fff",
                    titleColor: '#566a7f',
                    bodyColor: '#697a8d',
                    borderWidth: 1,
                    borderColor: '#eceef1',
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'KES',
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                }).format(context.parsed.y);
                            }
                            return label;
                        }
                    }
                },
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                x: {
                    grid: {
                        color: '#eceef1',
                        drawBorder: false,
                        borderColor: '#eceef1'
                    },
                    ticks: {
                        color: '#a1acb8'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#eceef1',
                        drawBorder: false,
                        borderColor: '#eceef1'
                    },
                    ticks: {
                        color: '#a1acb8',
                        callback: function(value, index, values) {
                            if (value >= 1000) {
                                return (value / 1000) + 'k';
                            }
                            return value;
                        }
                    }
                }
            }
        }
    });

    // Apply rounded corners to the chart canvas
    barChartVar.canvas.parentNode.style.borderRadius = '15px';
}

const customerRatingsChartEl = document.querySelector('#customerRatingsChart');

// Prepare data from PHP (assume PHP has provided the necessary JSON-encoded data)
const months = <?= json_encode(array_column($userData, 'year_month')) ?>;  // ['2023-09', '2023-10', ...]
const userCounts = <?= json_encode(array_column($userData, 'total_users')) ?>;  // [5, 10, 0, 12, ...]

const customerRatingsChartOptions = {
    chart: {
        height: 200,
        toolbar: { show: false },
        zoom: { enabled: false },
        type: 'line',
        dropShadow: {
            enabled: true,
            enabledOnSeries: [1],
            top: 13,
            left: 4,
            blur: 3,
            color: '#696cff', // Drop shadow color
            opacity: 0.09
        }
    },
    series: [{
        name: 'User Registrations',
        data: userCounts // User counts per month
    }],
    stroke: {
        curve: 'smooth',
        dashArray: [8, 0],
         width: [4],  // Increase stroke width to make the line thicker
        colors: ['#1f2937']  // Darker color for the line (e.g., dark gray)
    },
    legend: { show: false },
    colors: ['#eceef1', '#1f2937'],  // Make the line a dark color (Hex or RGB)
    grid: {
        show: false,
        borderColor: '#eceef1',
        padding: { top: -20, bottom: -10, left: 0 }
    },
    markers: {
        size: 6,
        colors: 'transparent',
        strokeColors: 'transparent',
        strokeWidth: 5,
        hover: { size: 6 }
    },
    xaxis: {
        labels: {
            style: { colors: '#a1acb8', fontSize: '13px' }
        },
        axisTicks: { show: false },
        categories: months.map(month => new Date(month + '-01').toLocaleString('default', { month: 'short', year: 'numeric' })), // Convert 'YYYY-MM' to 'MMM YYYY'
        axisBorder: { show: false }
    },
    yaxis: {
        min: 0,
        max: Math.max(...userCounts) + 10,  // Set max based on the highest number of registrations + buffer
        tickAmount: 4,
        grid: { color: '#eceef1', drawBorder: false, borderColor: '#eceef1' },
        labels: { style: { colors: '#a1acb8' } }
    }
};

if (typeof customerRatingsChartEl !== 'undefined' && customerRatingsChartEl !== null) {
    const customerRatingsChart = new ApexCharts(customerRatingsChartEl, customerRatingsChartOptions);
    customerRatingsChart.render();
}






        // Radial Bar Chart
        // --------------------------------------------------------------------
        const radialBarChartEl = document.querySelector('#radialBarChart'),
            radialBarChartConfig = {
                chart: {
                    height: 380,
                    type: 'radialBar'
                },
                colors: ['#fee802', '#3fd0bd', '#2b9bf4'],
                plotOptions: {
                    radialBar: {
                        size: 185,
                        hollow: {
                            size: '40%'
                        },
                        track: {
                            margin: 10,
                            background: '#8897aa1a'
                        },
                        dataLabels: {
                            name: {
                                fontSize: '2rem',
                                fontFamily: 'Public Sans'
                            },
                            value: {
                                fontSize: '1.2rem',
                                color: '#697a8d',
                                fontFamily: 'Public Sans'
                            },
                            total: {
                                show: true,
                                fontWeight: 400,
                                fontSize: '1.3rem',
                                color: '#566a7f',
                                label: 'Payments',
                                formatter: function(w) {
                                    return '65%';
                                }
                            }
                        }
                    }
                },
                grid: {
                    borderColor: '#eceef1',
                    padding: {
                        top: -25,
                        bottom: -20
                    }
                },
                legend: {
                    show: true,
                    position: 'bottom',
                    labels: {
                        colors: '#697a8d',
                        useSeriesColors: false
                    }
                },
                stroke: {
                    lineCap: 'round'
                },
                series: [65, 22, 13],
                labels: ['Fully Paid', 'Partially Paid', 'Pending']
            };
        if (typeof radialBarChartEl !== undefined && radialBarChartEl !== null) {
            const radialChart = new ApexCharts(radialBarChartEl, radialBarChartConfig);
            radialChart.render();
        }




        // Sale Stats - Radial Bar Chart
        // --------------------------------------------------------------------
        const salesStatsEl = document.querySelector('#salesStats'),
            salesStatsOptions = {
                chart: {
                    height: 300,
                    type: 'radialBar'
                },
                series: [<?= $admin_percentage ?>],
                labels: ['Landlord Sign Up'],
                plotOptions: {
                    radialBar: {
                        startAngle: 0,
                        endAngle: 360,
                        strokeWidth: '70',
                        hollow: {
                            margin: 50,
                            size: '<?= $admin_percentage ?>%',
                            image: assetsPath + 'img/icons/misc/arrow-star.png',
                            imageWidth: 65,
                            imageHeight: 55,
                            imageOffsetY: -35,
                            imageClipped: false
                        },
                        track: {
                            strokeWidth: '50%',
                            background: '#269491'
                        },
                        dataLabels: {
                            show: true,
                            name: {
                                offsetY: 60,
                                show: true,
                                color: '#269491',
                                fontSize: '15px'
                            },
                            value: {
                                formatter: function(val) {
                                    return parseInt(val) + '%';
                                },
                                offsetY: 20,
                                color: '#269491',
                                fontSize: '32px',
                                show: true
                            }
                        }
                    }
                },
                fill: {
                    type: 'solid',
                    colors: '#71dd37'
                },
                stroke: {
                    lineCap: 'round'
                },
                states: {
                    hover: {
                        filter: {
                            type: 'none'
                        }
                    },
                    active: {
                        filter: {
                            type: 'none'
                        }
                    }
                }
            };
        if (typeof salesStatsEl !== undefined && salesStatsEl !== null) {
            const salesStats = new ApexCharts(salesStatsEl, salesStatsOptions);
            salesStats.render();
        }

    })
</script>


<script>
function updateReportCard(month, totalAmount, monthName) {
    const distribution = calculateDistribution(totalAmount);
    document.getElementById('kraAmount').textContent = `Ksh. ${distribution.kra.toFixed(2)}`;
    document.getElementById('rentpesaAmount').textContent = `Ksh. ${distribution.rentpesa.toFixed(2)}`;
    document.getElementById('safaricomAmount').textContent = `Ksh. ${distribution.safaricom.toFixed(2)}`;
    document.getElementById('landlordAmount').textContent = `Ksh. ${distribution.landlord.toFixed(2)}`;
    document.getElementById('reportTitle').textContent = `Report for ${monthName} <?= $currentYear ?>`;
    document.getElementById('monthlyAvg').textContent = `Monthly Amount: Ksh. ${totalAmount.toFixed(2)}`;
}

function calculateDistribution(rentPaid) {
    const kraAmount = rentPaid * 0.075;
    const rentpesaAmount = rentPaid * 0.05;
    const safaricomAmount = rentpesaAmount * 0.025;
    const landlordAmount = rentPaid - kraAmount - rentpesaAmount;
    return {
        total: rentPaid,
        kra: kraAmount,
        rentpesa: rentpesaAmount,
        safaricom: safaricomAmount,
        landlord: landlordAmount
    };
}

   $(document).ready(function() {
    // Assume monthlyData is available and contains the results from your SQL query
    // monthlyData should be an array of objects, each with 'month' and 'total_payment_amount' properties
const monthlyData = <?php echo json_encode($monthlyData); ?>;

    // Helper function to get month name
    function getMonthName(monthNumber) {
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        return months[monthNumber - 1];
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

        let cardColor, headingColor, labelColor, borderColor, legendColor;


        cardColor = "#fff";
        headingColor = '#566a7f';
        labelColor = config.colors.textMuted;
        legendColor = config.colors.bodyColor;
        borderColor = '#eceef1';







        const purpleColor = '#836AF9',
            yellowColor = '#ffe800',
            cyanColor = '#28dac6',
            orangeColor = '#FF8132',
            orangeLightColor = '#FDAC34',
            oceanBlueColor = '#299AFF',
            greyColor = '#4F5D70',
            greyLightColor = '#EDF1F4',
            blueColor = '#2B9AFF',
            blueLightColor = '#84D0FF';



    // Prepare data for the chart
    const chartData = Array(12).fill(0); // Initialize with zeros for all 12 months
    const categories = [];

    monthlyData.forEach(data => {
        const monthIndex = parseInt(data.month) - 1; // SQL months are 1-indexed, array is 0-indexed
        chartData[monthIndex] = parseFloat(data.total_payment_amount);
        categories[monthIndex] = getMonthName(parseInt(data.month));
    });

    // Fill in any missing month names
    for (let i = 0; i < 12; i++) {
        if (!categories[i]) {
            categories[i] = getMonthName(i + 1);
        }
    }

    // Chart configuration
    const totalIncomeConfig = {
        chart: {
            height: 250,
            type: 'area',
            toolbar: false,
            dropShadow: {
                enabled: true,
                top: 14,
                left: 2,
                blur: 3,
                color: config.colors.primary,
                opacity: 0.15
            }
        },
        series: [{
            name: 'Total Income',
            data: chartData
        }],
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 3,
            curve: 'straight'
        },
        colors: [config.colors.primary],
        fill: {
            type: 'gradient',
            gradient: {
                shade: '#007fff',
                shadeIntensity: 0.8,
                opacityFrom: 0.7,
                opacityTo: 0.25,
                stops: [0, 95, 100]
            }
        },
        grid: {
            show: true,
            borderColor: borderColor,
            padding: {
                top: -15,
                bottom: -10,
                left: 0,
                right: 0
            }
        },
        xaxis: {
            categories: categories,
            labels: {
                offsetX: 0,
                style: {
                    colors: labelColor,
                    fontSize: '13px'
                }
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            lines: {
                show: false
            }
        },
        yaxis: {
            labels: {
                offsetX: -15,
                formatter: function(val) {
                    return 'Ksh. ' + parseInt(val / 1000) + 'k';
                },
                style: {
                    fontSize: '13px',
                    colors: labelColor
                }
            },
            min: 0,
            max: Math.max(...chartData) * 1.1, // Set max to 110% of the highest value
            tickAmount: 5
        }
    };

    const totalIncomeEl = document.querySelector('#totalIncomeChart');
    if (typeof totalIncomeEl !== undefined && totalIncomeEl !== null) {
        const totalIncome = new ApexCharts(totalIncomeEl, totalIncomeConfig);
        totalIncome.render();
    }
});
</script>

<?php include_once 'footer.php'; ?>