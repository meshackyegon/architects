<?php
include_once 'header.php';
include_once 'pesapal/submit_order.php';
$service   = get_by_id('service', $_GET['id']);
$id         = $service['service_id'];
// $customer_obj = array("email" => 'pmanyara97@gmail.com', "name" => 'Patrick Ayub', "phone" => '0745858891');
// $ref = bin2hex(random_bytes(6));

// $amount = $_POST['amount'];
// $order = order($customer_obj,$ref,$amount);
// $order_data = json_decode($order);
// $redirect_url = $order_data->redirect_url;
$amount = $service['service_price'] / 2;
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
                                <i class="far fa-calendar-alt"></i><?= get_ordinal_month_year($service['service_name']) ?>
                            </li>

                        </ul>
                    </div>
                    <h1><?= $service['service_name'] ?></h1>
                    <label><span class="ltn__secondary-color"><i class="flaticon-pin"></i></span> <?= $service['service_location'] ?></label>
                    <h4 class="title-2">Description</h4>
                    <p>
                        <?= $service['service_description'] ?>
                    </p>
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar---">
                    <form id="bookingForm" action="model/update/order.php" method="post">
                        <?php
                        input_hybrid('Name', 'user_name', $user, true);
                        input_hybrid('email', 'user_email', $user, true, 'email');
                        input_hybrid('Phone Number', 'user_phone', $user, true);

                        ?>
                        <input hidden name="amount" value="<?= $amount ?>" />
                        <div class="widget ltn__popular-product-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border-2">Booking</h4>
                            <div class="row ltn__popular-product-widget-active">
                                <button type="submit" class="btn btn-primary" href="booking?id=<?= $_GET['id'] ?>">
                                    Book This Property
                                </button>

                            </div>
                        </div>
                    </form>
                </aside>
            </div>
        </div>
    </div>
</div>
<!-- SHOP DETAILS AREA END -->

<button href="booking?id=<?= $_GET['id'] ?>">
    <div class="book-service-btn">
        <button>Book This Property</button>
    </div>
</button>



<!-- CALL TO ACTION END -->
<style>
    .PropertyImg {
        height: 250px;
        object-fit: cover;
        width: 100%;
    }


    /* Styles for the button container */
    .book-service-btn {
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
    .book-service-btn button {
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
        .book-service-btn {
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