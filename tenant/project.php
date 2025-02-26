<?php
$page        = 'project';
require_once 'header.php';

$current_year   = date("Y");

$project = get_by_id('project', security('id', 'GET'));

if (!empty($project)) {
    session_assignment(array(
        'edit' => $project['prod_id']
    ), false);
    $require = false;
} else {
    $require = true;
}


$properties = get_all('property');
?>
<div class="container-fluid">
 
    <form enctype="multipart/form-data" action="<?= model_url ?>project" method="POST">
        <div class="card shadow mb-4">
            <div class="card-body card-secondary">
                <br>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                        input_hybrid("Project's Name", "project_name", $project, true);
                        input_select('Project Type As:', 'project_type', $row, true, array('Flats and Apartments', 'Bungalows','Maisonettes','Townhouses', 'Bedsitters and Studio Apartments','Villas',));
                        ?>
                    <!-- </div>    
                    <div class="form-group">
                        
                            
                            <label for="property_type">What is your space? </label>
                            <select class="form-control" id="property_type" name="property_type" onchange="toggleOptions()">
                                <option value="">Select Property Type</option>
                                <option value="house">House</option>
                                <option value="bungalow">Bungalow</option>
                                <option value="maisonette">Maisonette</option>
                                <option value="apartment">Apartment</option>
                                <option value="bed_and_breakfast">Bed and Breakfast</option>
                            </select>
                    </div>
                    
                        <div class="form-group">
                            <div id="house_options" class="property-options" style="display: none; margin-top: 10px;">
                                <h3>House Features</h3>
                                <label><input type="checkbox" name="house_features[]" value="living_room"> Living Room</label><br>
                                <label><input type="checkbox" name="house_features[]" value="dining_room"> Dining Room</label><br>
                                <label><input type="checkbox" name="house_features[]" value="bedrooms"> Bedrooms</label><br>
                                <label><input type="checkbox" name="house_features[]" value="bathrooms"> Bathrooms</label><br>
                                <label><input type="checkbox" name="house_features[]" value="kitchen"> Kitchen</label><br>
                                <label><input type="checkbox" name="house_features[]" value="pantry"> Pantry</label><br>
                                <label><input type="checkbox" name="house_features[]" value="laundry"> Laundry Room</label><br>
                                <label><input type="checkbox" name="house_features[]" value="garage"> Garage</label><br>
                                <label><input type="checkbox" name="house_features[]" value="garden"> Garden</label><br>
                            </div>
                        
                    </div>
                    
                         <div class="form-group">
                             <div id="bungalow_options" class="property-options" style="display: none; margin-top: 10px;">
                                <h3>Bungalow Features</h3>
                                <label><input type="checkbox" name="bungalow_features[]" value="veranda"> Veranda</label><br>
                                <label><input type="checkbox" name="bungalow_features[]" value="bedrooms"> Bedrooms</label><br>
                                <label><input type="checkbox" name="bungalow_features[]" value="bathrooms"> Bathrooms</label><br>
                                <label><input type="checkbox" name="bungalow_features[]" value="open_plan_living"> Open-Plan Living Room</label><br>
                                <label><input type="checkbox" name="bungalow_features[]" value="dining_area"> Dining Area</label><br>
                                <label><input type="checkbox" name="bungalow_features[]" value="garden"> Garden</label><br>
                                <label><input type="checkbox" name="bungalow_features[]" value="garage"> Garage</label><br>
                                <label><input type="checkbox" name="bungalow_features[]" value="backyard"> Backyard</label><br>
                            </div>
                        
                    </div> 
                    
                    <div class="form-group">
                        <div id="maisonette_options" class="property-options" style="display: none; margin-top: 10px;">
                            <h3>Maisonette Features</h3>
                            <label><input type="checkbox" name="maisonette_features[]" value="duplex"> Duplex</label><br>
                            <label><input type="checkbox" name="maisonette_features[]" value="living_room"> Living Room</label><br>
                            <label><input type="checkbox" name="maisonette_features[]" value="dining_room"> Dining Room</label><br>
                            <label><input type="checkbox" name="maisonette_features[]" value="bedrooms"> Bedrooms</label><br>
                            <label><input type="checkbox" name="maisonette_features[]" value="bathrooms"> Bathrooms</label><br>
                            <label><input type="checkbox" name="maisonette_features[]" value="kitchen"> Kitchen</label><br>
                            <label><input type="checkbox" name="maisonette_features[]" value="balcony"> Balcony</label><br>
                            <label><input type="checkbox" name="maisonette_features[]" value="private_entrance"> Private Entrance</label><br>
                            <label><input type="checkbox" name="maisonette_features[]" value="garage"> Garage</label><br>
                            <label><input type="checkbox" name="maisonette_features[]" value="garden"> Garden</label><br>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div id="apartment_options" class="property-options" style="display: none; margin-top: 10px;">
                            <h3>Apartment Features</h3>
                            <label><input type="checkbox" name="apartment_features[]" value="living_room"> Living Room</label><br>
                            <label><input type="checkbox" name="apartment_features[]" value="bedrooms"> Bedrooms</label><br>
                            <label><input type="checkbox" name="apartment_features[]" value="bathrooms"> Bathrooms</label><br>
                            <label><input type="checkbox" name="apartment_features[]" value="kitchen"> Kitchen</label><br>
                            <label><input type="checkbox" name="apartment_features[]" value="balcony"> Balcony</label><br>
                            <label><input type="checkbox" name="apartment_features[]" value="laundry_area"> Laundry Area</label><br>
                            <label><input type="checkbox" name="apartment_features[]" value="elevator"> Elevator</label><br>
                            <label><input type="checkbox" name="apartment_features[]" value="garage"> Garage</label><br>
                            <label><input type="checkbox" name="apartment_features[]" value="security"> Security</label><br>
                            <label><input type="checkbox" name="apartment_features[]" value="garden"> Garden</label><br>
                        </div>
                    </div>
                    
                    
                <div class="form-group">
                    <div id="bed_and_breakfast_options" class="property-options" style="display: none; margin-top: 10px;">
                        <h3>Bed and Breakfast Features</h3>
                        <label><input type="checkbox" name="bed_and_breakfast_features[]" value="rooms_for_guests"> Rooms for Guests</label><br>
                        <label><input type="checkbox" name="bed_and_breakfast_features[]" value="lounge_area"> Lounge Area</label><br>
                        <label><input type="checkbox" name="bed_and_breakfast_features[]" value="kitchen"> Kitchen</label><br>
                        <label><input type="checkbox" name="bed_and_breakfast_features[]" value="breakfast_serving_area"> Breakfast Serving Area</label><br>
                        <label><input type="checkbox" name="bed_and_breakfast_features[]" value="bathrooms"> Bathrooms</label><br>
                        <label><input type="checkbox" name="bed_and_breakfast_features[]" value="wifi"> Wi-Fi</label><br>
                        <label><input type="checkbox" name="bed_and_breakfast_features[]" value="parking"> Parking</label><br>
                        <label><input type="checkbox" name="bed_and_breakfast_features[]" value="reception"> Reception</label><br>
                        <label><input type="checkbox" name="bed_and_breakfast_features[]" value="garden"> Garden</label><br>
                        <label><input type="checkbox" name="bed_and_breakfast_features[]" value="outdoor_seating"> Outdoor Seating</label><br>
                    </div>
                </div> -->

                        <?php
                        input_hybrid("Project's County", "county", $project, true);
                        input_hybrid("Project's Subcounty", "subcounty", $project, true);
                        input_hybrid("Project's Ward", "ward", $project, true);
                        input_hybrid("Project's Nearest Town", "nearest_town", $project, true);
                        input_hybrid("Project's Pin", "location_pin", $project, true);
                        input_hybrid("Project's Land Size", "land_size", $project, true);
                        
                        ?>
                        <input hidden name="created_by" value="self" />
                        <input hidden name="user_id" value="<?= $_SESSION['user_id'] ?>" />
                    </div>

                </div>
            </div>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4 text-center">
            <div class="text-center">
                <button class="btn btn-primary" type="submit" id="submit">Submit</button>
            </div>
        </div>
    </form>
</div>
<!-- End of Main Content -->


<style>
    .form-group {
        margin-top: 10px;
    }


    .HeaderTxt {
        margin: 1.2em 0em;
        font-size: 1.5em;
        font-weight: 700;
        text-align: center;
    }

    .MyDiver {
        margin-top: 50px;
        margin-bottom: 25px;
    }
</style>


<script>

    function toggleOptions() {
        var propertyType = document.getElementById("property_type").value;
        var houseOptions = document.getElementById("house_options");
        var bungalowOptions = document.getElementById("bungalow_options");
        var maisonetteOptions = document.getElementById("maisonette_options");
        var apartmentOptions = document.getElementById("apartment_options");
        var bedAndBreakfastOptions = document.getElementById("bed_and_breakfast_options");

        // Hide all options by default
        houseOptions.style.display = "none";
        bungalowOptions.style.display = "none";
        maisonetteOptions.style.display = "none";
        apartmentOptions.style.display = "none";
        bedAndBreakfastOptions.style.display = "none";

        // Show relevant checkboxes based on selection
        if (propertyType === "house") {
            houseOptions.style.display = "block";
        } else if (propertyType === "bungalow") {
            bungalowOptions.style.display = "block";
        } else if (propertyType === "maisonette") {
            maisonetteOptions.style.display = "block";
        } else if (propertyType === "apartment") {
            apartmentOptions.style.display = "block";
        }else if (propertyType === "bed_and_breakfast") {
            bedAndBreakfastOptions.style.display = "block";
        }
    }
</script>


<?php include_once 'footer.php'; ?>