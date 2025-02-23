<?php
include_once 'header.php';

$property   = get_single_property(security('id', 'GET'));
$id         = $property['property_id'];
$images     = get_image($id);
$features   = get_property_features($id);

?>




<!-- SHOP DETAILS AREA START -->
<div class="ltn__shop-details-area pb-10">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="ltn__shop-details-inner ltn__page-details-inner mb-60">
                    <div class="ltn__blog-meta">
                        <ul>
                            <li class="ltn__blog-category">
                                <a href="#">Featured</a>
                            </li>
                            <li class="ltn__blog-category">
                                <a class="bg-orange" href="#">Available</a>
                            </li>
                            <li class="ltn__blog-date">
                                <i class="far fa-calendar-alt"></i><?= get_ordinal_month_year($property['property_name']) ?>
                            </li>

                        </ul>
                    </div>
                    <h1><?= $property['property_name'] ?></h1>
                    <label><span class="ltn__secondary-color"><i class="flaticon-pin"></i></span> <?= $property['property_location'] ?></label>
                    <h4 class="title-2">Description</h4>
                    <p>
                        <?= $property['property_description'] ?>
                    </p>

                    <h4 class="title-2">Property Detail</h4>
                    <div class="property-detail-info-list section-bg-1 clearfix mb-60">
                        <ul>
                            <li><label>Vacancies:</label> <span><?= $property['property_vacant'] ?></span></li>
                            <li><label>Water: </label> <span>Ksh. <?= number_format($property['property_water'], 0)  ?>/month </span></li>
                            <li><label>Rent Due On:</label> <span><?= get_ordinal_day($property['property_due']) . " of every month" ?></span></li>
                        </ul>
                        <ul>
                            <li><label>Garbage:</label> <span>Ksh. <?= number_format($property['property_garbage'], 0) ?>/month</span></li>
                            <li><label>Bathrooms:</label> <span><?= $property['property_bathrooms'] ?></span></li>
                        </ul>

                    </div>

                    <h4 class="title-2">Features</h4>
                    <div class="property-detail-feature-list clearfix mb-45">
                        <ul>


                            <?php
                            if (!empty($features)) {
                                foreach ($features as $item) {
                                    $amenity = get_by_id('amenities', $item['amenities_id']);
                            ?>


                                    <li>
                                        <div class="property-detail-feature-list-item">
                                            <img src="img/favorite.png" style="width:30px" />
                                            <div>
                                                <h6><?= $amenity['amenities_name'] ?></h6>

                                            </div>
                                        </div>
                                    </li>
                            <?php
                                }
                            }
                            ?>




                        </ul>
                    </div>


                    <?php
                    $map    = $property['property_map'];
                    if ($map != "") {
                        $headers = get_headers($map, true);
                        $mystring = $headers['Location'];
                        function get_string_between($string, $start, $end)
                        {
                            $string = ' ' . $string;
                            $ini = strpos($string, $start);
                            if ($ini == 0) return '';
                            $ini += strlen($start);
                            $len = strpos($string, $end, $ini) - $ini;
                            return substr($string, $ini, $len);
                        }

                        $fullstring = $mystring;
                        $parsed = get_string_between($fullstring, '@', 'data');
                        $parsed2 = get_string_between($fullstring, '@', ',');
                        $parsed3 = get_string_between($parsed, ',', ',');
                    ?>
                        <h4 class="title-2">Location</h4>
                        <div class="property-details-google-map mb-60">
                            <iframe src="https://maps.google.com/maps?q=<?= $parsed2 ?>,<?= $parsed3 ?>&z=15&output=embed" style="width:100%;height:400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">

                            </iframe>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
            <div class="col-lg-4">
                <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar---">

                    <div class="widget ltn__popular-product-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border-2">Booking</h4>
                        <div class="row ltn__popular-product-widget-active">
                            <a class="btn btn-primary" href="booking?id=<?= $_GET['id'] ?>">
                                Book This Property
                            </a>

                        </div>
                    </div>

                    <div class="widget ltn__top-rated-product-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border-2">Top Rated Properties</h4>
                        <?php
                        $sql = "SELECT * FROM property LIMIT 3 ";
                        $rows = select_rows($sql);
                        ?>
                        <ul>
                            <?php
                            foreach ($rows as $row) { ?>

                                <li>
                                    <div class="top-rated-product-item clearfix">
                                        <div class="top-rated-product-img">
                                            <a href="single_property.php?id=<?= encrypt($row['property_id']) ?>">
                                                <img class="PropertyImg3" src="<?= file_url . $row['property_image'] ?>" alt="#">
                                            </a>
                                        </div>
                                        <div class="top-rated-product-info">

                                            <h6><a href="single_property.php?id=<?= encrypt($row['property_id']) ?>"><?= $row['property_name'] ?></a></h6>
                                            <div class="product-price">
                                                <!--<span>Ksh. 30,000.00</span>-->
                                                <!--<del>Ksh. 35,000.00</del>-->
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php

                            }

                            ?>



                        </ul>
                    </div>




                </aside>
            </div>
        </div>
    </div>
</div>
<!-- SHOP DETAILS AREA END -->

<a href="booking?id=<?= $_GET['id'] ?>">
    <div class="book-property-btn">
        <button>Book This Property</button>
    </div>
</a>



<!-- CALL TO ACTION END -->
<style>
    .PropertyImg {
        height: 250px;
        object-fit: cover;
        width: 100%;
    }


    /* Styles for the button container */
    .book-property-btn {
        display: none;
        /* Initially hidden */
        position: fixed;
        /* Fixed position */
        bottom: 20px;
        /* Distance from the bottom */
        left: 50%;
        /* Center horizontally */
        transform: translateX(-50%);
        /* Center horizontally */
        border-radius: 20px;
        /* Curved borders */
        background-color: #007bff;
        /* Button background color */
        padding: 10px 20px;
        /* Padding */
        z-index: 9999;
        /* Ensure it's above other content */
    }

    /* Styles for the button */
    .book-property-btn button {
        border: none;
        /* Remove button border */
        background-color: transparent;
        /* Transparent background */
        color: #fff;
        /* Button text color */
        font-size: 16px;
        /* Button font size */
        cursor: pointer;
        /* Cursor on hover */
        outline: none;
        /* Remove outline on focus */
    }

    /* Show the button only on mobile devices */
    @media screen and (max-width: 768px) {
        .book-property-btn {
            display: block;
            /* Show the button */
        }
    }

    .PropertyImg3 {
        width: 80px;
        height: 80px;
        border-radius: 5px;
    }
</style>

<?php include_once 'footer.php'; ?>