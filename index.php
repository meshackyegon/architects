<?php
include_once 'header.php';

$banners    = get_all('banner');
$properties    = get_all('property');
$rows       = get_all('featured_property');
$locations  = get_property_locations();
$cities     = get_property_cities();




?>
<!-- SLIDER AREA START (slider-11) -->
<div class="ltn__slider-area ltn__slider-11  ltn__slider-11-slide-item-count-show--- ltn__slider-11-pagination-count-show--- section-bg-1">
    <div class="ltn__slider-11-inner">
        <div class="ltn__slider-11-active">
            <!-- slide-item -->
            <?php
            foreach ($banners as $banner) {
                if (!empty($banner['property_id'])) {
                    $property    = get_single_property($banner['property_id']);
                }

            ?>
                <div class="ltn__slide-item ltn__slide-item-2 ltn__slide-item-3-normal ltn__slide-item-3 ltn__slide-item-11">
                    <div class="ltn__slide-item-inner">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 align-self-center">
                                    <div class="slide-item-info">
                                        <div class="slide-item-info-inner ltn__slide-animation">
                                            <div class="slide-video mb-50 d-none">
                                                <a class="ltn__video-icon-2 ltn__video-icon-2-border" href="https://www.youtube.com/embed/tlThdr3O5Qo" data-rel="lightcase:myCollection">
                                                    <i class="fa fa-play"></i>
                                                </a>
                                            </div>
                                            <!--<h6 class="slide-sub-title white-color--- animated"><span><i class="fas fa-home"></i></span> Real Estate Agency</h6>-->
                                            <h1 class="slide-title animated ">Discover Your  <br><span>Ideal Construction</span> at Domysuma Architects</h1>
                                            <div class="slide-brief animated">
                                                <p>
                                                    Start Your Journey Now - Book Your Dream Construction Company!
                                                </p>
                                            </div>
                                            <div class="btn-wrapper animated">
                                                <a href="properties" class="theme-btn-1 btn btn-effect-1">Start Now</a>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide-item-img">
                                        <img src="<?= file_url . $banner['banner_poster'] ?>" alt="#">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- slide-item -->
            <?php }
            ?>

        </div>
        <!-- slider-4-pagination -->
        <div class="ltn__slider-11-pagination-count">
            <span class="count"></span>
            <span class="total"></span>
        </div>
        <!-- slider-sticky-icon -->
        <div class="slider-sticky-icon-2">
            <ul>
                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
            </ul>
        </div>
        <!-- slider-4-img-slide-arrow -->
        <div class="ltn__slider-11-img-slide-arrow">
            <div class="ltn__slider-11-img-slide-arrow-inner">
                <div class="ltn__slider-11-img-slide-arrow-active">
                    <?php
                    foreach ($banners as $item) {
                        if (!empty($item['property_id'])) {
                            $property    = get_single_property($item['property_id']);
                        }

                    ?>
                        <div class="image-slide-item">
                            <img src="<?= file_url . $item['banner_poster'] ?>" alt="Flower Image">
                        </div>
                    <?php }
                    ?>

                </div>
                <!-- slider-4-slide-item-count -->
                <div class="ltn__slider-11-slide-item-count">
                    <span class="count"></span>
                    <span class="total"></span>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- SLIDER AREA END -->





<!-- SEARCH BY PLACE AREA START (testimonial-7) -->
<div class="ltn__search-by-place-area before-bg-top bg-image-top--- pt-115 pb-70" data-bg="img/bg/20.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2--- text-center---">
                    <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color">Our Properties</h6>
                    <h1 class="section-title">Find Your Dream Home</h1>
                </div>
            </div>
        </div>
        <div class="row ltn__search-by-place-slider-1-active slick-arrow-1">
            <?php
            if (!empty($properties)) {
                foreach ($properties as $property) {
                    $images1 = get_image($property['property_id']);
            ?>
                    <div class="col-lg-4">
                        <div class="ltn__search-by-place-item">
                            <div class="search-by-place-img">
                                <a href="single_property.php?id=<?= encrypt($property['property_id']) ?>"><img class="PropertyImg" src="<?= file_url . $property['property_image'] ?>" alt="#"></a>
                                
                            </div>
                            <div class="search-by-place-info">
                                <h6><a href=""><?= $property['property_location'] ?></a></h6>
                                <h4><a href="single_property.php?id=<?= encrypt($property['property_id']) ?>"><?= $property['property_name'] ?></a></h4>
                                <div class="search-by-place-btn">
                                    <a href="single_property.php?id=<?= encrypt($property['property_id']) ?>">View Property <i class="flaticon-right-arrow"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
            <!--  -->
        </div>
    </div>
</div>
<!-- SEARCH BY PLACE AREA END -->



<!-- CATEGORY AREA START -->
<div class="ltn__category-area ltn__product-gutter section-bg-1--- pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color">About Our Properties</h6>
                    <h1 class="section-title">Our Amenities</h1>
                </div>
            </div>
        </div>
        <div class="row ltn__category-slider-active--- slick-arrow-1 justify-content-center">
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__category-item ltn__category-item-5 ltn__category-item-5-2 text-center---">
                    <a href="#">
                        <span class="category-icon"><i class="flaticon-car"></i></span>
                        <span class="category-number">01</span>
                        <span class="category-title">Ample Parking</span>
                        <span class="category-brief">
                            
                        </span>
                        <span class="category-btn d-none"><i class="flaticon-right-arrow"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__category-item ltn__category-item-5 ltn__category-item-5-2 text-center---">
                    <a href="#">
                        <span class="category-icon"><i class="flaticon-swimming"></i></span>
                        <span class="category-number">02</span>
                        <span class="category-title">Swimming Pool</span>
                        <span class="category-brief">
                            
                        </span>
                        <span class="category-btn d-none"><i class="flaticon-right-arrow"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__category-item ltn__category-item-5 ltn__category-item-5-2 text-center---">
                    <a href="#">
                        <span class="category-icon"><i class="flaticon-secure-shield"></i></span>
                        <span class="category-number">03</span>
                        <span class="category-title">Security</span>
                        <span class="category-brief">
                            
                        </span>
                        <span class="category-btn d-none"><i class="flaticon-right-arrow"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__category-item ltn__category-item-5 ltn__category-item-5-2 text-center---">
                    <a href="#">
                        <span class="category-icon"><i class="flaticon-stethoscope"></i></span>
                        <span class="category-number">04</span>
                        <span class="category-title">Nearby amenities</span>
                        <span class="category-brief">
                            
                        </span>
                        <span class="category-btn d-none"><i class="flaticon-right-arrow"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__category-item ltn__category-item-5 ltn__category-item-5-2 text-center---">
                    <a href="#">
                        <span class="category-icon"><i class="flaticon-book"></i></span>
                        <span class="category-number">05</span>
                        <span class="category-title">Conveniently Located</span>
                        <span class="category-brief">
                            
                        </span>
                        <span class="category-btn d-none"><i class="flaticon-right-arrow"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__category-item ltn__category-item-5 ltn__category-item-5-2 text-center---">
                    <a href="#">
                        <span class="category-icon"><i class="flaticon-bed-1"></i></span>
                        <span class="category-number">06</span>
                        <span class="category-title">Spacious Rooms</span>
                        <span class="category-brief">
                            
                        </span>
                        <span class="category-btn d-none"><i class="flaticon-right-arrow"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__category-item ltn__category-item-5 ltn__category-item-5-2 text-center---">
                    <a href="#">
                        <span class="category-icon"><i class="flaticon-home-2"></i></span>
                        <span class="category-number">07</span>
                        <span class="category-title">Lush Surroundings</span>
                        <span class="category-brief">
                            
                        </span>
                        <span class="category-btn d-none"><i class="flaticon-right-arrow"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__category-item ltn__category-item-5 ltn__category-item-5-2 text-center---">
                    <a href="#">
                        <span class="category-icon"><i class="flaticon-slider"></i></span>
                        <span class="category-number">08</span>
                        <span class="category-title">Kid’s Playland</span>
                        <span class="category-brief">
                            
                        </span>
                        <span class="category-btn d-none"><i class="flaticon-right-arrow"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CATEGORY AREA END -->

<!-- TESTIMONIAL AREA START (testimonial-8) -->
<div class="ltn__testimonial-area section-bg-1--- bg-image-top pt-115 pb-65" data-bg="img/bg/23.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2--- text-center---">
                    <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color--- white-color">Client,s Testimonial</h6>
                    <h1 class="section-title white-color">See What,s Our Client <br>
                        Says About Us</h1>
                </div>
            </div>
        </div>
        <div class="row ltn__testimonial-slider-6-active slick-arrow-3">
            <div class="col-lg-4">
                <div class="ltn__testimonial-item ltn__testimonial-item-7 ltn__testimonial-item-8">
                    <div class="ltn__testimoni-info">

                        <p>

                            Domysuma Architects made my apartment construction a breeze! Their website was easy to navigate, and I found the perfect designs within days. The listings were accurate, and the communication with engineers was seamless. I highly recommend Domysuma architects to anyone looking for their next construction company.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ltn__testimonial-item ltn__testimonial-item-7 ltn__testimonial-item-8">
                    <div class="ltn__testimoni-info">

                        <p>I've used Domysuma architects multiple times to find construction bq, and I've never been disappointed. Their platform is user-friendly, and I appreciate the variety of listings available. The ability to schedule viewings and communicate directly with architects through Domysuma architects streamlines the construction process and saves me time.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ltn__testimonial-item ltn__testimonial-item-7 ltn__testimonial-item-8">
                    <div class="ltn__testimoni-info">

                        <p>Domysuma architects exceeded my expectations in helping me build an a new home. Not only did they have a wide range of construction types to choose from, but their customer service was exceptional. The team was responsive to my inquiries and provided helpful guidance throughout the rental process. Thanks to Domysuma architects, I'm now happily constructed my new placee</p>
                    </div>
                </div>
            </div>

            <!--  -->
        </div>
    </div>
</div>
<!-- TESTIMONIAL AREA END -->



<!-- CALL TO ACTION START (call-to-action-6) -->
<div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bg="img/1.jpg--">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg text-center---">
                    <div class="coll-to-info text-color-white">
                        <h1>Looking for a Construction Company?</h1>
                        <p>We help you make the dream of new construction a reality</p>
                    </div>
                    <div class="btn-wrapper">
                        <a class="btn btn-effect-3 btn-white" href="properties">Explore Properties <i class="icon-next"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CALL TO ACTION END -->

<style>
    .PropertyImg {
        height: 250px;
        object-fit: cover;
        width: 100%;

    }
</style>

<?php include_once 'footer.php'; ?>