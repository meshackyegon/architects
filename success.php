<?php
include_once 'header.php';

$property   = get_single_property(security('id', 'GET'));
$id         = $property['property_id'];
// cout($property);

$property_units    = get_by_column('property_unit', 'property_id', $id);
// cout($property_units);
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<div class="ltn__checkout-area mb-105">
    <div class="container">
        <div class="row">

            <div class="success-message">
                <h2>Booking Successful!</h2>
                <p>Thank you for booking with us.</p>
                <p>We have received your details, and a member of the RentPesa team will contact you shortly to confirm your booking and provide further instructions.</p>
            </div>
        </div>
    </div>
</div>





<script>
    $(document).ready(function() {

        $('#motor_car').click(function() {
            $('#myModal2').modal('show');
        });


        $('.myClose').click(function() {
            $('#myModal').modal('hide');
        });

        $('.myClose2').click(function() {
            $('#myModal2').modal('hide');
        });



    })
</script>

<script>
    function checkAvailabilityEmailid() {
        jQuery.ajax({
            url: "check_available.php",
            data: 'email=' + $("#email").val(),
            type: "POST",
            success: function(data) {
                console.log(data);
                $("#emailid-availability").html(data);
            },
            error: function() {}
        });
    }
</script>

<style>
    .success-message {
        background-color: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .success-message h2 {
        margin-top: 0;
    }

    .success-message p {
        margin: 10px 0;
    }
</style>

<?php include_once 'footer.php'; ?>