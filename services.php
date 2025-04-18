<?php
include_once 'header.php';

$services    = get_all('service');
?>

<!-- PRODUCT DETAILS AREA START -->
<div class="ltn__product-area ltn__product-gutter mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="ltn__shop-options">
                    <ul class="justify-content-start">
                        <li>
                            <div class="ltn__grid-list-tab-menu ">
                                <div class="nav">
                                    <a class="active show" data-toggle="tab" href="#liton_product_grid"><i class="fas fa-th-large"></i></a>
                                    <a data-toggle="tab" href="#liton_product_list"><i class="fas fa-list"></i></a>
                                </div>
                            </div>
                        </li>
                        <li class="d-none">
                            <div class="showing-product-number text-right">
                                <span>Showing 1–12 of 18 results</span>
                            </div>
                        </li>
                        <li>
                            <div class="short-by text-center">
                                <select class="nice-select">
                                    <option>Default Sorting</option>
                                    <option>Sort by popularity</option>
                                    <option>Sort by new arrivals</option>
                                    <option>Sort by price: low to high</option>
                                    <option>Sort by price: high to low</option>
                                </select>
                            </div>
                        </li>
                        <li>
                            <div class="short-by text-center">
                                <select class="nice-select">
                                    <option>Per Page: 12</option>
                                    <option>Per Page: 20</option>
                                    <option>Per Page: 30</option>
                                    <option>Per Page: 50</option>
                                    <option>Per Page: 100</option>
                                </select>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="liton_product_grid">
                        <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Search Widget -->
                                    <div class="ltn__search-widget mb-30">
                                        <form action="#">
                                            <input type="text" name="search" placeholder="Search your keyword...">
                                            <button type="submit"><i class="fas fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <?php
                                if (!empty($services)) {
                                    foreach ($services as $service) {
                                ?>
                                        <div class="col-xl-6 col-sm-6 col-12">
                                            <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5 text-center---">
                                                <div class="product-img">
                                                    <a href="single_service.php?id=<?= $service['service_id'] ?>">
                                                        <img class="PropertyImg" src="<?= file_url . $service['service_image'] ?>" alt="#">
                                                    </a>

                                                </div>
                                                <div class="product-info">
                                                    <div class="product-badge">
                                                        <ul>
                                                            <li class="sale-badg">For Rent</li>
                                                        </ul>
                                                    </div>
                                                    <h2 class="product-title"><a href="single_service.php?id=<?= $service['service_id'] ?>"><?= $service['service_name'] ?></a></h2>

                                                    <div class="product-hover-action">
                                                        <ul>
                                                            <li>
                                                                <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                    <i class="flaticon-expand"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                    <i class="flaticon-heart-1"></i></a>
                                                            </li>
                                                            <li>
                                                                <a href="single_service.php?id=<?= $service['service_id'] ?>" title="Product Details">
                                                                    <i class="flaticon-add"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-info-bottom">
                                                    <div class="product-price">
                                                        <span>Ksh. 20000<label>/Month</label></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="liton_product_list">
                        <div class="ltn__product-tab-content-inner ltn__product-list-view">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Search Widget -->
                                    <div class="ltn__search-widget mb-30">
                                        <form action="#">
                                            <input type="text" name="search" placeholder="Search your keyword...">
                                            <button type="submit"><i class="fas fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <?php
                                if (!empty($services)) {
                                    foreach ($services as $service) {
                                ?>
                                        <!-- ltn__product-item -->
                                        <div class="col-lg-12">
                                            <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5">
                                                <div class="product-img">
                                                    <a href="single_service.php?id=<?= $service['service_id'] ?>">
                                                        <img class="PropertyImg2" src="<?= file_url . $service['service_image'] ?>" alt="#">
                                                    </a>
                                                </div>
                                                <div class="product-info">
                                                    <div class="product-badge-price">
                                                        <div class="product-badge">
                                                            <ul>
                                                                <li class="sale-badg">For Rent</li>
                                                            </ul>
                                                        </div>
                                                        <div class="product-price">
                                                            <span>$34,900<label>/Month</label></span>
                                                        </div>
                                                    </div>
                                                    <h2 class="product-title"><a href="single_service.php?id=<?= $service['service_id'] ?>"><?= $service['service_name'] ?></a></h2>

                                                </div>
                                                <div class="product-info-bottom">

                                                    <div class="product-hover-action">
                                                        <ul>
                                                            <li>
                                                                <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                    <i class="flaticon-expand"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                    <i class="flaticon-heart-1"></i></a>
                                                            </li>
                                                            <li>
                                                                <a href="single_service.php?id=<?= $service['service_id'] ?>" title="Product Details">
                                                                    <i class="flaticon-add"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ltn__pagination-area text-center">
                    <div class="ltn__pagination">
                        <ul>
                            <li><a href="#"><i class="fas fa-angle-double-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">10</a></li>
                            <li><a href="#"><i class="fas fa-angle-double-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">
                    <h3 class="mb-10">Advance Information</h3>
                    <label class="mb-30"><small>About 9,620 results (0.62 seconds) </small></label>
                    <!-- Advance Information widget -->
                    <div class="widget ltn__menu-widget">
                        <h4 class="ltn__widget-title">Property Type</h4>
                        <ul>
                            <li>
                                <label class="checkbox-item">House
                                    <input type="checkbox" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">3,924</span>
                            </li>
                            <li>
                                <label class="checkbox-item">Single Family
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">3,610</span>
                            </li>
                            <li>
                                <label class="checkbox-item">Apartment
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">2,912</span>
                            </li>
                            <li>
                                <label class="checkbox-item">Office Villa
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">2,687</span>
                            </li>
                            <li>
                                <label class="checkbox-item">Luxary Home
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">1,853</span>
                            </li>
                            <li>
                                <label class="checkbox-item">Studio
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">893</span>
                            </li>
                        </ul>
                        <hr>
                        <h4 class="ltn__widget-title">Amenities</h4>
                        <ul>
                            <li>
                                <label class="checkbox-item">Dishwasher
                                    <input type="checkbox" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">3,924</span>
                            </li>
                            <li>
                                <label class="checkbox-item">Floor Coverings
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">3,610</span>
                            </li>
                            <li>
                                <label class="checkbox-item">Internet
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">2,912</span>
                            </li>
                            <li>
                                <label class="checkbox-item">Build Wardrobes
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">2,687</span>
                            </li>
                            <li>
                                <label class="checkbox-item">Supermarket
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">1,853</span>
                            </li>
                            <li>
                                <label class="checkbox-item">Kids Zone
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">893</span>
                            </li>
                        </ul>
                        <hr>
                        <h4 class="ltn__widget-title">Price Range</h4>
                        <ul>
                            <li>
                                <label class="checkbox-item">Low Budget
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">Ksh. 5,000 - Ksh. 10,000</span>
                            </li>
                            <li>
                                <label class="checkbox-item">Medium
                                    <input type="checkbox" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">Ksh. 10,000 - Ksh. 30,000</span>
                            </li>
                            <li>
                                <label class="checkbox-item">High Budget
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">Ksh. 30,000 Up</span>
                            </li>
                        </ul>
                        <hr>
                        <!-- Price Filter Widget -->
                        <div class="widget--- ltn__price-filter-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border---">Filter by price</h4>
                            <div class="price_filter">
                                <div class="price_slider_amount">
                                    <input type="submit" value="Your range:" />
                                    <input type="text" class="amount" name="price" placeholder="Add Your Price" />
                                </div>
                                <div class="slider-range"></div>
                            </div>
                        </div>
                        <hr>
                        <h4 class="ltn__widget-title">Bed/bath</h4>
                        <ul>
                            <li>
                                <label class="checkbox-item">Single
                                    <input type="checkbox" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">3,924</span>
                            </li>
                            <li>
                                <label class="checkbox-item">Double
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">3,610</span>
                            </li>
                            <li>
                                <label class="checkbox-item">Up To 3
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">2,912</span>
                            </li>
                            <li>
                                <label class="checkbox-item">Up To 5
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">2,687</span>
                            </li>
                        </ul>
                        <hr>
                        <h4 class="ltn__widget-title">Catagory</h4>
                        <ul>
                            <li>
                                <label class="checkbox-item">Buying
                                    <input type="checkbox" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">3,924</span>
                            </li>
                            <li>
                                <label class="checkbox-item">Renting
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">3,610</span>
                            </li>
                            <li>
                                <label class="checkbox-item">Selling
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="categorey-no">2,912</span>
                            </li>
                        </ul>
                    </div>
                    <!-- Category Widget -->
                    <div class="widget ltn__menu-widget d-none">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Product categories</h4>
                        <ul>
                            <li><a href="#">Body <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            <li><a href="#">Interior <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            <li><a href="#">Lights <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            <li><a href="#">Parts <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            <li><a href="#">Tires <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            <li><a href="#">Uncategorized <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            <li><a href="#">Wheel <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                        </ul>
                    </div>
                    <!-- Price Filter Widget -->
                    <div class="widget ltn__price-filter-widget d-none">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Filter by price</h4>
                        <div class="price_filter">
                            <div class="price_slider_amount">
                                <input type="submit" value="Your range:" />
                                <input type="text" class="amount" name="price" placeholder="Add Your Price" />
                            </div>
                            <div class="slider-range"></div>
                        </div>
                    </div>
                    <!-- Top Rated Product Widget -->
                    <div class="widget ltn__top-rated-product-widget d-none">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Top Rated Product</h4>
                        <ul>
                            <li>
                                <div class="top-rated-product-item clearfix">
                                    <div class="top-rated-product-img">
                                        <a href="single_service.php?id=<?= $service['service_id'] ?>"><img src="img/product/1.png" alt="#"></a>
                                    </div>
                                    <div class="top-rated-product-info">
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <h6><a href="single_service.php?id=<?= $service['service_id'] ?>">Mixel Solid Seat Cover</a></h6>
                                        <div class="product-price">
                                            <span>$49.00</span>
                                            <del>$65.00</del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="top-rated-product-item clearfix">
                                    <div class="top-rated-product-img">
                                        <a href="single_service.php?id=<?= $service['service_id'] ?>"><img src="img/product/2.png" alt="#"></a>
                                    </div>
                                    <div class="top-rated-product-info">
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <h6><a href="single_service.php?id=<?= $service['service_id'] ?>">3 Rooms Manhattan</a></h6>
                                        <div class="product-price">
                                            <span>$49.00</span>
                                            <del>$65.00</del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="top-rated-product-item clearfix">
                                    <div class="top-rated-product-img">
                                        <a href="single_service.php?id=<?= $service['service_id'] ?>"><img src="img/product/3.png" alt="#"></a>
                                    </div>
                                    <div class="top-rated-product-info">
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <h6><a href="single_service.php?id=<?= $service['service_id'] ?>">Coil Spring Conversion</a></h6>
                                        <div class="product-price">
                                            <span>$49.00</span>
                                            <del>$65.00</del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Search Widget -->
                    <div class="widget ltn__search-widget d-none">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Search Objects</h4>
                        <form action="#">
                            <input type="text" name="search" placeholder="Search your keyword...">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <!-- Tagcloud Widget -->
                    <div class="widget ltn__tagcloud-widget d-none">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Popular Tags</h4>
                        <ul>
                            <li><a href="#">Popular</a></li>
                            <li><a href="#">desgin</a></li>
                            <li><a href="#">ux</a></li>
                            <li><a href="#">usability</a></li>
                            <li><a href="#">develop</a></li>
                            <li><a href="#">icon</a></li>
                            <li><a href="#">Car</a></li>
                            <li><a href="#">Service</a></li>
                            <li><a href="#">Repairs</a></li>
                            <li><a href="#">Auto Parts</a></li>
                            <li><a href="#">Oil</a></li>
                            <li><a href="#">Dealer</a></li>
                            <li><a href="#">Oil Change</a></li>
                            <li><a href="#">Body Color</a></li>
                        </ul>
                    </div>
                    <!-- Size Widget -->
                    <div class="widget ltn__tagcloud-widget ltn__size-widget d-none">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Product Size</h4>
                        <ul>
                            <li><a href="#">S</a></li>
                            <li><a href="#">M</a></li>
                            <li><a href="#">L</a></li>
                            <li><a href="#">XL</a></li>
                            <li><a href="#">XXL</a></li>
                        </ul>
                    </div>
                    <!-- Color Widget -->
                    <div class="widget ltn__color-widget d-none">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Product Color</h4>
                        <ul>
                            <li class="black"><a href="#"></a></li>
                            <li class="white"><a href="#"></a></li>
                            <li class="red"><a href="#"></a></li>
                            <li class="silver"><a href="#"></a></li>
                            <li class="gray"><a href="#"></a></li>
                            <li class="maroon"><a href="#"></a></li>
                            <li class="yellow"><a href="#"></a></li>
                            <li class="olive"><a href="#"></a></li>
                            <li class="lime"><a href="#"></a></li>
                            <li class="green"><a href="#"></a></li>
                            <li class="aqua"><a href="#"></a></li>
                            <li class="teal"><a href="#"></a></li>
                            <li class="blue"><a href="#"></a></li>
                            <li class="navy"><a href="#"></a></li>
                            <li class="fuchsia"><a href="#"></a></li>
                            <li class="purple"><a href="#"></a></li>
                            <li class="pink"><a href="#"></a></li>
                            <li class="nude"><a href="#"></a></li>
                            <li class="orange"><a href="#"></a></li>

                            <li><a href="#" class="orange"></a></li>
                            <li><a href="#" class="orange"></a></li>
                        </ul>
                    </div>
                    <!-- Banner Widget -->
                    <div class="widget ltn__banner-widget d-none">
                        <a href="shop.html"><img src="img/banner/banner-2.jpg" alt="#"></a>
                    </div>

                </aside>
            </div>
        </div>
    </div>
</div>
<!-- PRODUCT DETAILS AREA END -->

<style>
    .PropertyImg {
        height: 250px;
        object-fit: cover;
        width: 100%;
    }

    .PropertyImg2 {
        height: 250px;
        object-fit: cover;
        width: 350px;
    }
</style>

<?php include_once 'footer.php'; ?>