<?php
include_once 'header.php';
if (!isset($_GET['ref'])) {
    header('location:index');
    exit();
}

$booking = get_single_vehicle_booking($_GET['ref']);

function get_single_vehicle_booking($ref)
{
    $sql = "SELECT * FROM booking WHERE reference = '$ref' ";
    return select_rows($sql)[0];
}
$name = $booking['user_name'];
$email = $booking['user_email'];
$phone = $booking['user_phone'];
$redirect_url = $booking['redirect_url'];
?>

<section class="gauto-booking-form section_70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="booking-form-left">
                    <div class="single-booking">
                        <h3>Booking Summary</h3>
                        <p><span class="booking-detail">Name:</span> <?php echo $booking['user_name']; ?></p>
                        <p><span class="booking-detail">Email:</span> <?php echo $booking['user_email']; ?></p>
                        <p><span class="booking-detail">Phone:</span> <?php echo $booking['user_phone']; ?></p>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="booking-right">
                    <h3>Payment</h3>
                    <div class="gauto-payment clearfix">
                        <div class="payment">
                            <h5 style="color:black; margin-bottom:10px;">Proceed to payment?</h5>
                            <p id="copy_status"></p>
                            <div class="row">
                                <button type="button" id="additional_btn" class="gauto-btn" style="color:black; display: inline-block;" onclick="window.location.href='index.php'">Cancel</button>
                                <button type="button" id="copy_btn" class="gauto-btn" style="color:black; display: inline-block;">Copy URL</button>

                                <script>
                                    document.getElementById("copy_btn").addEventListener("click", function() {
                                        var textarea = document.createElement('textarea')
                                        textarea.id = 'temp_element'
                                        textarea.style.height = 0
                                        document.body.appendChild(textarea)
                                        textarea.value = '<?php echo $booking['redirect_url']; ?>'
                                        var selector = document.querySelector('#temp_element')
                                        selector.select()
                                        document.execCommand('copy')
                                        document.body.removeChild(document.getElementById('temp_element'))

                                        document.getElementById("copy_status").textContent = "Copied!";
                                    });
                                </script>

                                <button type="button" id="additional_btn1" class="gauto-btn" style="color:black; display: inline-block;" onclick="window.location.href='<?php echo $booking['redirect_url']; ?>'">PAY</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once 'footer.php'; ?>