<?php
$page = 'admin';
//  require_once '../path.php';
require_once 'header.php';

$admin = get_by_id('admin', security('id', 'GET'));

if (!empty($admin)) {
    session_assignment(array(
        'edit' => $admin['admin_id']
    ), false);
    $require = false;
} else {
    $require = true;
}
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    Add admin </h3>
            </div>
            <div class="mt-4">
                <form action="<?= model_url ?>admin" method="POST">
                    <div class="row">

                        <?php
                        input_hybrid('Name', 'admin_name', $admin, $require);
                        ?>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for='admin_email'>Email</label>
                                <input class="form-control" type="email" name="admin_email" id="admin_email" required placeholder="Enter Your Email" value="<?php echo isset($admin['admin_email']) ? $admin['admin_email'] : ''; ?>" onBlur="checkAvailabilityEmailid()" required>
                                <span id="emailid-availability" style="font-size:12px;"></span>
                            </div>
                        </div>
                       <br>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4 text-center">
                            <div class="text-center">
                                <button class="btn btn-primary" type="submit" id="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->

<script>
    function checkAvailabilityEmailid() {
        jQuery.ajax({
            url: "../check_available.php",
            data: 'admin_email=' + $("#admin_email").val(),
            type: "POST",
            success: function(data) {
                console.log(data);
                $("#emailid-availability").html(data);
            },
            error: function() {}
        });
    }
</script>


<?php include_once 'footer.php'; ?>