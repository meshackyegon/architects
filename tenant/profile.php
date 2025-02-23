<?php
$page = 'profile';
include_once 'header.php';
$profile = get_by_id('user', $_SESSION['user_id']);

?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="profile"><i class="bx bx-user me-1"></i> Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="password"><i class="bx bx-lock-alt me-1"></i> Security</a>
                </li>

            </ul>
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                <form method="POST" action="<?= model_url ?>user_edit" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="<?= empty($profile) || empty($profile['user_image']) ? file_url . 'user.png' : file_url . $profile['user_image'] ?>" alt="user_image" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" name="user_image" hidden accept="image/png, image/jpeg" onchange="previewImage(this);" />
                                </label>
                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                        </div>
                    </div>

                    <script>
                        function previewImage(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    document.getElementById('uploadedAvatar').src = e.target.result;
                                }

                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    </script>
                    <hr class="my-0" />
                    <div class="card-body">

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="user_name" class="form-label">Name</label>
                                <input class="form-control" type="text" id="user_name" name="user_name"
                                    value="<?= $profile['user_name'] ?>" autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" id="user_email" name="user_email"
                                    value="<?= $profile['user_email'] ?>" />
                                <span id="email-availability"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Phone Number</label>
                                <div class="input-group input-group-merge">

                                    <input type="text" id="phoneNumber" name="user_phone" class="form-control"
                                        value="<?= $profile['user_phone'] ?>"
                                         placeholder="Enter Your Phone Number (Format: 254XXXXXXXXX)"
                                                           pattern="254[17][0-9]{8}" 
                                                           title="Phone number must be in the format 254XXXXXXXXX"/>
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
                            <div class="mb-3 col-md-6">
                                <label for="passport" class="form-label">Passport</label>
                                <input class="form-control" type="text" id="user_passport" name="user_passport"
                                    value="<?= $profile['user_passport'] ?>" />

                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="dob" class="form-label">Date of birth</label>
                                <input class="form-control" type="date" id="user_dob" name="user_dob"
                                    value="<?= $profile['user_dob'] ?>" />
                            </div>
                              <div class="mb-3 col-md-6">
                                <label for="kra" class="form-label">KRA</label>
                                <input class="form-control" type="text" id="user_kra" name="user_kra"
                                    value="<?= $profile['user_kra'] ?>" />
                            </div>
                              <div class="mb-3 col-md-6">
                                <label for="kin_name" class="form-label">Next of kin name</label>
                                <input class="form-control" type="text" id="kin_name" name="kin_name"
                                    value="<?= $profile['kin_name'] ?>" />
                            </div>
                             <div class="mb-3 col-md-6">
                                <label for="kin_phone" class="form-label">Next of kin phone</label>
                                <input class="form-control" type="text" id="phoneNumber2" name="kin_phone"
                                    value="<?= $profile['kin_phone'] ?>"/>
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
                            
                            <input type="hidden" name="user_id" value="<?= $profile['user_id'] ?>">


                        </div>
                        <div class="mt-2">
                            <button type="submit" id='submit' class="btn btn-primary me-2">Save changes</button>

                        </div>

                    </div>
                    <!-- /Account -->
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = "admin";
        $('#' + table + '_email').on('input', function() {
            const submitButton = document.getElementById('submit');
            const email = $(this).val();
            const tableName = table;

            if (email.length > 0) {
                $.ajax({
                    url: 'check_available.php',
                    method: 'POST',
                    data: {
                        email: email,
                        table: tableName
                    },
                    success: function(response) {
                        const availabilitySpan = $('#email-availability');
                        if (response.trim() === "available") {
                            availabilitySpan.text('Email is available');
                            availabilitySpan.css('color', 'green');
                            submitButton.disabled = false;
                        } else if (response.trim() === "not available") {
                            availabilitySpan.text('Email is not available');
                            availabilitySpan.css('color', 'red');
                            submitButton.disabled = true;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            } else {
                $('#email-availability').text('');
                submitButton.disabled = false;
            }
        });
    });
</script>
<?php include_once 'footer.php'; ?>