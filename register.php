<?php
include_once 'header.php';
if(isset($_GET['from'])){
    $action = 'register&from='.$_GET['from'];
}else{
    $action = 'register&from=index';
}
?>

<!-- LOGIN AREA START -->
<div class="ltn__login-area pb-65">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Create A User Account</h1>
                    <p>If you'd like to sign up as a Architectural Engineer,<a style="font-weight: 900;color: #007fff;" href="architect_register">Click Me.</a> </p>
                    <p>If you'd like to sign up as a Electrical Engineer,<a style="font-weight: 900;color: #007fff;" href="electrical_register">Click Me.</a> </p>
                    <p>If you'd like to sign up as a Mechanical Engineer,<a style="font-weight: 900;color: #007fff;" href="mechanical_register">Click Me.</a> </p>
                    <p>If you'd like to sign up as a Structural Engineer,<a style="font-weight: 900;color: #007fff;" href="structural_register">Click Me.</a> </p>
                </div>
            </div>
        </div>
        <div class="row">
           <div class="ltn__login-area pb-65">
                    <div class="container">

                        <div class="row">
                          
                            <div class="col-lg-12">
                                <div class="account-create text-center">
                                    <p>Required fields are marked **</p>
                                    <form action="<?= model_url . $action ?>" method="POST">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                     <label for="user_name" class="form-label">Name</label>
                                                    <input class="form-control" type="text" name="user_name" required placeholder="Enter Your name">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                
                                                <div class="form-group">
                                                     <label for="email" class="form-label">E-mail</label>
                                                    <input class="form-control" type="email" name="user_email" id="email" required placeholder="Enter Your Email" onBlur="checkAvailabilityEmailid()">
                                                    <span id="emailid-availability" style="font-size:12px;"></span>
                                                </div>
                                            </div>
                                           <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                                    <input class="form-control" type="tel" id="phoneNumber" name="user_phone" required 
                                                           placeholder="Enter Your Phone Number (Format: 254XXXXXXXXX)"
                                                           pattern="254[17][0-9]{8}" 
                                                           title="Phone number must be in the format 254XXXXXXXXX">
                                                </div>
                                            </div>
                                            
                                            <script>
                                            document.getElementById('phoneNumber').addEventListener('input', function (e) {
                                                var input = e.target.value.replace(/\D/g, '');
                                                var formatted = '';
                                            
                                                if (input.startsWith('01')) {
                                                    formatted = '2541' + input.substr(2, 8);
                                                } else if (input.startsWith('07')) {
                                                    formatted = '2547' + input.substr(2, 8);
                                                } else if (input.startsWith('254')) {
                                                    formatted = input.substr(0, 12);
                                                } else {
                                                    formatted = input;
                                                }
                                            
                                                e.target.value = formatted.substr(0, 12);
                                            });
                                            
                                            document.querySelector('form').addEventListener('submit', function(e) {
                                                var phoneInput = document.getElementById('phoneNumber');
                                                if (!phoneInput.value.match(/^254[17][0-9]{8}$/)) {
                                                    e.preventDefault();
                                                    alert('Please enter a valid phone number in the format 254XXXXXXXXX');
                                                }
                                            });
                                            </script>
                                            
                                            
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                     <label for="kra" class="form-label">KRA</label>
                                                    <input class="form-control" type="text" name="user_kra" required placeholder="Enter Your KRA Pin">
                                                </div>
                                            </div>
                                            
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                     <label for="passport" class="form-label">Passport</label>
                                                    <input class="form-control" type="text" name="user_passport" required placeholder="Enter Your ID/Passport Number">
                                                </div>
                                            </div>
                                            
                                             <div class="col-md-12">
                                                  
                                                <div class="form-group">
                                                      <label for="dob" class="form-label">Date of birth</label>
                                                    <input class="form-control" type="date" name="user_dob" required placeholder="Enter Your Date of Birth">
                                                </div>
                                            </div>
                                            
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                     <label for="kin_name" class="form-label">Next of kin name</label>
                                                    <input class="form-control" type="text" name="kin_name" required placeholder="Enter Next of Kin's Name">
                                                </div>
                                            </div>
                                            
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                        <label for="kin_phone" class="form-label">Next of kin phone</label>
                                                    <input class="form-control" type="tel" id="phoneNumber2" name="kin_phone" required 
                                                     placeholder="Enter Your Phone Number (Format: 254XXXXXXXXX)"
                                                           pattern="254[17][0-9]{8}" 
                                                           title="Phone number must be in the format 254XXXXXXXXX">
                                                </div>
                                            </div>
                                            
                                            <script>
                                            document.getElementById('phoneNumber2').addEventListener('input', function (e) {
                                                var input = e.target.value.replace(/\D/g, '');
                                                var formatted = '';
                                            
                                                if (input.startsWith('01')) {
                                                    formatted = '2541' + input.substr(2, 8);
                                                } else if (input.startsWith('07')) {
                                                    formatted = '2547' + input.substr(2, 8);
                                                } else if (input.startsWith('254')) {
                                                    formatted = input.substr(0, 12);
                                                } else {
                                                    formatted = input;
                                                }
                                            
                                                e.target.value = formatted.substr(0, 12);
                                            });
                                            
                                            document.querySelector('form').addEventListener('submit', function(e) {
                                                var phoneInput = document.getElementById('phoneNumber2');
                                                if (!phoneInput.value.match(/^254[17][0-9]{8}$/)) {
                                                    e.preventDefault();
                                                    alert('Please enter a valid phone number in the format 254XXXXXXXXX');
                                                }
                                            });
                                            </script>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                        <label for="Password " class="form-label">Password </label>
                                                    <input class="form-control" type="password" name="user_password" required placeholder="Enter Your Password">
                                                </div>
                                            </div>
                                            <input hidden name="added_by" value="self" />
                                            
                                            
                                            <div class="col-md-12">
                                                <button class="theme-btn-1 btn btn-block" style="background-color:#007fff" type="submit" id="submit">
                                                    REGISTER
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<!-- LOGIN AREA END -->

<!-- CALL TO ACTION START (call-to-action-6) -->
<div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bg="img/1.jpg--">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg text-center---">
                    <div class="coll-to-info text-color-white">
                        <h1>Looking for a dream home?</h1>
                        <p>We can help you realize your dream of a new home</p>
                    </div>
                    <div class="btn-wrapper">
                        <a class="btn btn-effect-3 btn-white" href="contact.html">Explore Properties <i class="icon-next"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
<!-- CALL TO ACTION END -->
<?php include_once 'footer.php'; ?>