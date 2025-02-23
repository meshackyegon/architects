<?php
$page = 'password';
$header_name = 'Change Password';

//  require_once '../path.php';
require_once 'header.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script>
    $(document).ready(function() {
        function getQueryParams() {
            const urlParams = new URLSearchParams(window.location.search);
            const type = urlParams.get('success') ? 'success' : 'error';
            const message = urlParams.get(`${type}`)
            return {
                message,
                type
            };
        }

        function displayNotification(message, type) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-full-width",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "10000",
                "hideDuration": "1000",
                "timeOut": "100000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr[type](message);
        }

        function clearQueryParams() {
            window.history.replaceState({}, document.title, window.location.pathname);
        }

        const queryParams = getQueryParams();
        if (queryParams.message && queryParams.type) {
            displayNotification(queryParams.message, queryParams.type);
            clearQueryParams();
        }

    });
</script>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Security</h4>

    <div class="row">
        <div class="col-md-12">
            <!-- Navbar pills -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row mb-3">
                        <li class="nav-item">
                            <a class="nav-link " href="my_profile"><i class="bx bx-user me-1"></i> Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="password"><i class="bx bx-lock-alt me-1"></i> Security</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="edit_profile"><i class="bx bx-detail me-1"></i>Edit Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--/ Navbar pills -->
            <!-- Change Password -->
            <div class="card mb-4">
                <h5 class="card-header">Change Password</h5>
                <div class="card-body">
                    <form method="POST" action="<?= model_url ?>landlord_password">
                        <!-- <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="current_password">Current Password</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" name="current_password" id="current_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="new_password">New Password</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" id="new_password" name="new_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="confirm_password">Confirm New Password</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <p class="fw-semibold mt-2">Password Requirements:</p>
                                <ul class="ps-3 mb-0">
                                    <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                                    <li class="mb-1">At least one lowercase character</li>
                                    <li>At least one number, symbol, or whitespace character</li>
                                </ul>
                            </div>
                            <div class="col-12 mt-1">
                                <button type="submit" class="btn btn-primary me-2" id="submitBtn" disabled>Save changes</button>
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
    var newPassword = document.getElementById("new_password");
    var confirmPassword = document.getElementById("confirm_password");
    var submitBtn = document.getElementById("submitBtn");

    function checkPassword() {
        var password = newPassword.value;
        var confirm = confirmPassword.value;

        // Check if password meets the conditions
        var hasMinLength = password.length >= 8;
        var hasLowercase = /[a-z]/.test(password);
        var hasNumberOrSymbol = /[0-9\W_]/.test(password);

        // Check if password and confirm password are the same
        var passwordsMatch = password === confirm;

        // Enable or disable the submit button based on the conditions
        submitBtn.disabled = !(hasMinLength && hasLowercase && hasNumberOrSymbol && passwordsMatch);
    }

    // Add event listeners to the password fields
    newPassword.addEventListener("input", checkPassword);
    confirmPassword.addEventListener("input", checkPassword);
</script>


<?php include_once 'footer.php'; ?>