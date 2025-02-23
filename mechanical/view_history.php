<?php
$page        = 'history';
$header_name = 'Home';

require_once 'header.php';

$sql = "SELECT * FROM booking WHERE user_id = '$profile[user_id]' ORDER BY booking_check_in ASC  ";
$bookings = select_rows($sql);

?>

<head>
    <script src="<?= admin_url ?>assets/js/charts-apex.js"></script>
</head>
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">

        <!-- Activity Timeline -->
        <div class="col-md-12 col-lg-12 order-4 order-lg-3">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Living History</h5>

                </div>
                <div class="card-body">
                    <!-- Activity Timeline -->
                    <ul class="timeline">
                        <?php
                        
                        foreach ($bookings as $item) {
                            $property = get_by_id('property', $item['property_id']);
                            $unit = get_by_id('property_unit', $item['property_unit_id']);
                            $from = get_ordinal_month_year($item['booking_check_in']);
                            if($item['booking_check_out'] == NULL){
                                $to = 'Current Residence';
                            }else{
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
                    <!-- /Activity Timeline -->
                </div>
            </div>
        </div>
        <!--/ Activity Timeline -->
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

    .PropHeader{
            font-size: 1em;    margin: unset;
    }

    .UnitHeader{
            font-size: 1em;    margin: unset;
    }

    .FromDates{
            font-size: 1em;
                font-weight: 500;
    margin: unset;
    }
</style>

<?php include_once 'footer.php'; ?>