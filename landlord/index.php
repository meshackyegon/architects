<?php
$page = 'dashboard';
$header_name = 'Home';
require_once 'header.php';
$connection = connect();

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
        WHERE property.added_by = '$profile[landlord_id]' AND YEAR(payment.payment_date_created) = $currentYear 
        GROUP BY MONTH(payment.payment_date_created) 
        ORDER BY month ASC";
$monthlyData = select_rows($sql);

// Get total amount received in the current year
$sql = "SELECT SUM(payment.payment_amount) AS total_year_amount 
        FROM payment 
        JOIN property ON payment.property_id = property.property_id 
        WHERE property.added_by = '$profile[landlord_id]' 
        AND YEAR(payment.payment_date_created) = '$currentYear'";
$totalYearAmount = select_rows($sql)[0]['total_year_amount'] ?? 0;


// Get data for the current month
$sql = "SELECT SUM(payment.payment_amount) AS total_payment_amount 
        FROM payment 
        JOIN property ON payment.property_id = property.property_id 
        WHERE property.added_by = '$profile[landlord_id]' 
        AND YEAR(payment.payment_date_created) = $currentYear 
        AND MONTH(payment.payment_date_created) = $currentMonth";
$currentMonthData = select_rows($sql);

$currentMonthTotal = $currentMonthData[0]['total_payment_amount'] ?? 0;
$distribution = calculateDistribution($currentMonthTotal);

// Get all payments for the datatables
$sql = "SELECT payment.*, property.property_name, property_unit.property_unit_name 
        FROM payment 
        JOIN property ON payment.property_id = property.property_id 
        JOIN property_unit ON payment.property_unit_id = property_unit.property_unit_id 
        WHERE payment.payment_paid = 'paid' AND property.added_by = '$profile[landlord_id]'";
$payments = select_rows($sql);

?>

<head>
    <script src="<?= admin_url ?>assets/js/dashboards-crm.js"></script>
</head>

<div class="container-xxl flex-grow-1 container-p-y">
    <h3>Hello, <?= $profile['landlord_name'] ?>, welcome to the RentPesa Landlord Panel </h3>
    <?php
    if ($profile['landlord_status'] == 'active') { ?>
        <div class="row">
            <div class="col-lg-4 mb-4 ml-2 mr-2">
                <div class="card">
                    <div class="card-body">
                        <a href="view_properties">
                            <div class="d-flex" style="align-items: center; justify-content:center;">
                                <div style="background-color: #EFF4FF;" class="OverviewCircle">
                                    <img src="<?= admin_url ?>assets/img/icons/card.png" class="OverviewIcon" />
                                </div>
                                <div style="width: auto; margin-left:5px;">
                                    <h5 class="text-nowrap mb-2">Properties</h5>
                                    <small class="text-success text-nowrap fw-semibold"><?= sizeof(get_landlord_properties($profile['landlord_id'])) ?></small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4 ml-2 mr-2">
                <div class="card">
                    <div class="card-body">
                        <a href="view_users">
                            <div class="d-flex" style="align-items: center; justify-content:center;">
                                <div style="background-color: #EFF4FF;" class="OverviewCircle">
                                    <img src="<?= admin_url ?>assets/img/icons/card.png" class="OverviewIcon" />
                                </div>
                                <div style="width: auto; margin-left:5px;">
                                    <h5 class="text-nowrap mb-2">Tenants</h5>
                                    <small class="text-success text-nowrap fw-semibold"><?= sizeof(get_landlord_tenants($profile['landlord_id'])) ?></small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4 ml-2 mr-2">
                <div class="card">
                    <div class="card-body">
                        <a href="#">
                            <div class="d-flex" style="align-items: center; justify-content:center;">
                                <div style="background-color: #EFF4FF;" class="OverviewCircle">
                                    <img src="<?= admin_url ?>assets/img/icons/card.png" class="OverviewIcon" />
                                </div>
                                <div style="width: auto; margin-left:5px;">
                                    <h5 class="text-nowrap mb-2">Rent Paid (<?= $currentYear ?>)</h5>
                                    <small class="text-success text-nowrap fw-semibold">Ksh. <?= number_format($totalYearAmount, 2) ?></small>
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
                                                    <img src="<?= file_url . 'kra.png' ?>" width="100" height="70" alt="KRA" />
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
                                                    <img src="<?= file_url . 'rentpesa.png' ?>" width="100" height="70" alt="Rentpesa" />
                                                </div>
                                                <div class="d-flex justify-content-between align-items-end w-100 flex-wrap gap-2">
                                                    <div class="d-flex flex-column">
                                                        <span>Rentpesa (5%)</span>
                                                        <h5 class="mb-0" id="rentpesaAmount">Ksh. <?= number_format($distribution['rentpesa'], 2) ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-list-item rounded-2">
                                            <div class="d-flex align-items-start">
                                                <div class="report-list-icon shadow-sm me-2">
                                                    <img src="<?= file_url . $profile['landlord_image'] ?>" width="100" height="70" alt="Landlord" />
                                                </div>
                                                <div class="d-flex justify-content-between align-items-end w-100 flex-wrap gap-2">
                                                    <div class="d-flex flex-column">
                                                        <span>You</span>
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

    <?php
    } else { ?>
        <div class="row">
            <div class="col-12 ml-2 mr-2">
                <div class="card">
                    <div class="card-body">
                        <p>Kindly wait for your account to be approved.</p>
                    </div>
                </div>
            </div>
        </div>
    <?php

    }
    ?>

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
</style>


<style>
    .dataTables_length,
    .dataTables_filter,
    .dataTables_info,
    .dataTables_paginate {
        display: none !important;
    }
</style>
<script>
function updateReportCard(month, totalAmount, monthName) {
    const distribution = calculateDistribution(totalAmount);
    document.getElementById('kraAmount').textContent = `Ksh. ${distribution.kra.toFixed(2)}`;
    document.getElementById('rentpesaAmount').textContent = `Ksh. ${distribution.rentpesa.toFixed(2)}`;
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