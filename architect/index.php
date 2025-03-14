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


// $bookings = get_by_column('booking', 'user_id', $profile['user_id']);

$sql = "SELECT * FROM booking WHERE user_id = '$profile[user_id]' ORDER BY booking_check_in DESC  ";
$bookings = select_rows($sql);

$sqlAMOUNT = "SELECT SUM(payment.payment_amount) AS total_payment_amount 
             FROM payment 
             JOIN user ON payment.user_id = user.user_id 
             WHERE payment.user_id = '$profile[user_id]'";

$row = select_rows($sqlAMOUNT)[0];

?>

<head>
    <script src="<?= admin_url ?>assets/js/charts-apex.js"></script>
    <!--<script src="<?= admin_url ?>assets/js/dashboards-ecommerce.js"></script>-->
</head>
<div class="container-xxl flex-grow-1 container-p-y">
    <h3>Hello, <?= $profile['architect_name'] ?>, welcome to the Domysuma Architects Panel </h3>
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
                                <h5 class="text-nowrap mb-2">Properties Lived In:</h5>
                                <small class="text-success text-nowrap fw-semibold"><?= sizeof($bookings) ?></small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4 ml-2 mr-2">
            <div class="card">
                <div class="card-body">
                    <a href="view_claims">
                        <div class="d-flex" style="align-items: center; justify-content:center;">
                            <div style="background-color: #FFF7E1;" class="OverviewCircle">
                                <img src="<?= admin_url ?>assets/img/icons/card.png" class="OverviewIcon" />
                            </div>
                            <div style="width: auto; margin-left:5px;">
                                <h5 class="text-nowrap mb-2">Invoices</h5>
                                <small class="text-success text-nowrap fw-semibold"><?= sizeof(get_all('invoice')) ?></small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>



        <div class="col-lg-4 mb-4 ml-2 mr-2">
            <div class="card">
                <div class="card-body">
                    <a href="view_writers">
                        <div class="d-flex" style="align-items: center; justify-content:center;">
                            <div style="background-color: #EFF4FF;" class="OverviewCircle">
                                <img src="<?= admin_url ?>assets/img/icons/card.png" class="OverviewIcon" />
                            </div>
                            <div style="width: auto; margin-left:5px;">
                                <h5 class="text-nowrap mb-2">Rent Paid</h5>
                                <small class="text-success text-nowrap fw-semibold">Ksh. <?= $row['total_payment_amount'] ?></small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>






    </div>
    <div class="row">

        <!-- Activity Timeline -->
        <div class="col-md-8 col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Living History</h5>

                </div>
                <div class="card-body">
                    <?php
                    if (!empty($bookings)) { ?>
                        <ul class="timeline">
                            <?php
                            foreach ($bookings as $item) {
                                $property = get_by_id('property', $item['property_id']);
                                $unit = get_by_id('property_unit', $item['property_unit_id']);
                                $from = get_ordinal_month_year($item['booking_check_in']);
                                if ($item['booking_check_out'] == NULL) {
                                    $to = 'Current Residence';
                                } else {
                                    $to = get_ordinal_month_year($item['booking_check_out']);
                                }
                            ?>
                                <li class="timeline-item timeline-item-transparent">
                                    <span class="timeline-point timeline-point-primary"></span>
                                    <div class="MyRow">
                                        <div class="property-image" style="margin-right:10px;">
                                            <img src="<?= file_url . $property['property_image']; ?>" alt="<?= $property['property_name']; ?>">
                                        </div>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h3 class="PropHeader"><b>Property:</b> <?= $property['property_name'] ?> </h3>

                                            </div>
                                            <div class="timeline-header mb-1">
                                                <h3 class="UnitHeader"><b>Unit:</b> <?= $unit['property_unit_name'] ?> </h3>
                                            </div>

                                            <p class="FromDates"><b>From:</b> <?= $from ?></p>
                                            <p class="FromDates"><b>To:</b> <?= $to ?></p>


                                        </div>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                            <li class="timeline-end-indicator">
                                <i class="bx bx-check-circle"></i>
                            </li>
                        </ul>
                    <?php

                    } else { ?>
                        <p>You have not rented any properties on RentPesa yet.</p>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!--/ Activity Timeline -->

        <div class="col-md-4 col-lg-4">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if ($profile['user_email'] == 'pmanyara97@gmail.com') { ?>
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="<?= file_url . 'mpesa.png' ?>" alt="Credit Card" width="50" class="rounded" />
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt5">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="d-block mb-1">Payments</span>
                                <h3 class="card-title text-nowrap mb-2">Ksh. 42,389</h3>
                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +2.18%</small>
                            <?php
                            } else { ?>
                                <p>No transactions have been made yet.</p>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if ($profile['user_email'] == 'pmanyara97@gmail.com') { ?>
                                <span class="d-block fw-semibold">Fuliza Debt</span>
                                <h3 class="card-title mb-2">18k</h3>
                                <span class="badge bg-label-info mb-3">+34%</span>
                                <small class="text-muted d-block">Full Repayment</small>
                                <div class="d-flex align-items-center">
                                    <div class="progress w-75 me-2" style="height: 8px">
                                        <div class="progress-bar bg-info" style="width: 78%" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>78%</span>
                                </div>
                            <?php
                            } else { ?>
                                <p>No transactions have been made yet.</p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if ($profile['user_email'] == 'pmanyara97@gmail.com') { ?>
                                <div class="d-flex justify-content-between gap-3">
                                    <div class="d-flex align-items-start flex-column justify-content-between">
                                        <div class="card-title">
                                            <h5 class="mb-0">Cleared</h5>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="mt-auto">
                                                <h3 class="mb-2">Ksh. 24.7k</h3>
                                                <small class="text-danger text-nowrap fw-semibold"><i class="bx bx-down-arrow-alt"></i> 8.2%</small>
                                            </div>
                                        </div>
                                        <span class="badge bg-label-secondary rounded-pill">2024</span>
                                    </div>
                                    <div id="expensesBarChart"></div>
                                </div>
                            <?php
                            } else { ?>
                                <p>No transactions have been made yet.</p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
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



    .property-image img {
        max-width: 100%;
        width: 100px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        height: 100px;
        object-fit: cover;
    }

    .MyRow {
        display: flex;
        justify-content: center;
    }

    .PropHeader {
        font-size: 1em;
        margin: unset;
    }

    .UnitHeader {
        font-size: 1em;
        margin: unset;
    }

    .FromDates {
        font-size: 1em;
        font-weight: 500;
        margin: unset;
    }
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




        // Conversion rate Line Chart
        // --------------------------------------------------------------------
        const expensesBarChartEl = document.querySelector('#expensesBarChart'),
            expensesBarChartConfig = {
                series: [{
                        name: '2021',
                        data: [15, 37, 14, 30, 38, 30, 20, 13, 14, 23]
                    },
                    {
                        name: '2020',
                        data: [-33, -23, -29, -21, -25, -21, -23, -19, -37, -22]
                    }
                ],
                chart: {
                    height: 150,
                    stacked: true,
                    type: 'bar',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '40%',
                        borderRadius: 5,
                        startingShape: 'rounded'
                    }
                },
                colors: ['#36b649', config.colors.warning],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                    lineCap: 'round',
                    colors: [cardColor]
                },
                legend: {
                    show: false
                },
                grid: {
                    show: false,
                    padding: {
                        top: -10
                    }
                },
                xaxis: {
                    show: false,
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    labels: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    show: false
                },
                responsive: [{
                        breakpoint: 1440,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 5,
                                    columnWidth: '60%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1300,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 5,
                                    columnWidth: '70%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1200,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 4,
                                    columnWidth: '50%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1040,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 4,
                                    columnWidth: '60%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 991,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 4,
                                    columnWidth: '40%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 420,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 5,
                                    columnWidth: '60%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 360,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 5,
                                    columnWidth: '70%'
                                }
                            }
                        }
                    }
                ],
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
        if (typeof expensesBarChartEl !== undefined && expensesBarChartEl !== null) {
            const expensesBarChart = new ApexCharts(expensesBarChartEl, expensesBarChartConfig);
            expensesBarChart.render();
        }
    })
</script>


<?php include_once 'footer.php'; ?>