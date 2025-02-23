<?php
$page = 'password';
$header_name = 'Change Password';

//  require_once '../path.php';
require_once 'header.php';
?>


<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Security</h4>

    <div class="row">
        <div class="col-md-12">
            <!-- Navbar pills -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row mb-3">
                        <li class="nav-item">
                            <a class="nav-link " href="profile"><i class="bx bx-user me-1"></i> Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="password"><i class="bx bx-lock-alt me-1"></i> Security</a>
                        </li>

                    </ul>
                </div>
            </div>
            <!--/ Navbar pills -->
            <!-- Change Password -->
            <div class="card mb-4">
                <h5 class="card-header">Change Password</h5>
                <div class="card-body">
                    <form method="POST" action="<?= model_url ?>user_password">
                        <div class="row">
                            <div class="col-6 mb-4">
                                <?php
                                input_hybrid('New Password', 'user_password', $profile1, true);
                                ?>
                            </div>

                            <div class="col-6 mb-4">
                                <?php
                                input_hybrid('Confirm Password', 'confirm_password', $profile1, true);
                                ?>
                            </div>

                            <div class="col-12 mb-4" id="pass">
                                <p class="fw-semibold mt-2">Password Requirements:</p>
                                <ul class="ps-3 mb-0">
                                    <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                                    <li>At least one digit</li>
                                    <li>Contains at least one upper case letter</li>
                                    <li>Contains at least one lower case letter</li>
                                    <li>Contains at least one special character e.g !@#$%^&*()_+{}[]:.,;?/|\\</li>
                                </ul>
                            </div>
                            <div class="col-12 mt-1">
                                <button type="submit" class="btn btn-primary me-2" id="submitBtn" disabled>Save
                                    changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--/ Change Password -->

        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        var table = "user";
        $('#' + table + '_password, #confirm_password').on('input', function () {
            var newPassword = $('#' + table + '_password').val();
            var confirmPassword = $('#confirm_password').val();
            var pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+{}[\]:.,;?/|\\]).{8,}$/;

            // Create an error message element if it doesn't exist
            if ($('#passwordError').length === 0) {
                $('<div id="passwordError" class="text-danger mt-2"></div>').insertBefore('#pass');
            }

            if (newPassword !== confirmPassword) {
                $('#submitBtn').prop('disabled', true);
                $('#passwordError').text('Passwords do not match');
            } else if (!pattern.test(newPassword)) {
                $('#submitBtn').prop('disabled', true);
                $('#passwordError').text('Password does not meet the requirements');
            } else {
                $('#submitBtn').prop('disabled', false);
                $('#passwordError').text('');
            }
        });
    });
</script>


<?php include_once 'footer.php'; ?>