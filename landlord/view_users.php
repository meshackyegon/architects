<?php
$page        = 'users';
$header_name = 'Clients';

//  require_once '../path.php';
require_once 'header.php';

// $users = get_landlord_users();
$sql = "SELECT user.* FROM user JOIN property ON user.property_id = property.property_id  WHERE property.added_by = '$profile[landlord_id]'  ";
$users = select_rows($sql);

$num_columns = 11;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => ''),
        array('data' => 'col_' . $i, 'title' => 'S.no'),
        array('data' => 'user_name', 'title' => 'Name'),
        array('data' => 'user_email', 'title' => 'Email'),
        array('data' => 'user_phone', 'title' => 'Phone'),
        array('data' => 'user_passport', 'title' => 'ID Number'),
        array('data' => 'user_dob', 'title' => 'DOB'),
        array('data' => 'user_kra', 'title' => 'KRA Pin'),
        array('data' => 'property_id', 'title' => 'Property'),
        array('data' => 'preferred_date', 'title' => 'Preferred Date'),
        array('data' => 'action', 'title' => 'Action'),
    );
}

$add = 'user';

$houses = get_landlord_properties($profile['landlord_id']);
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> Clients</h4>



    <form method="post" id="quickForm" enctype="multipart/form-data" action="<?= model_url ?>csv">
        <div class="card-body">
            <div class="col-md-12 col-sm-12 col-12 mb-4">
                <label for="properties" class="form-label">Property</label>
                <select name="property_id" id="properties" class="select2 form-select form-select-lg" required data-allow-clear="true">
                    <!--<option value="All">All</option>-->
                    <?php
                    foreach ($houses as $property) { ?>
                        <option value="<?= $property['property_id'] ?>"><?= $property['property_name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <input type="file" name="tenants_csv" id="tenants_csv" accept=".csv" onchange="checkFile()">
                <input hidden name="added_by" value="<?= $profile['landlord_id'] ?>" />
                <p>Once you've chosen your file, click the button below.</p>
            </div>
            <?php submit("Click me once you choose file", "info", "center", "mt-5"); ?>
        </div>
    </form>

    <script>
        function checkFile() {
            if (document.getElementById('tenants_csv').files.length > 0) {
                document.getElementById('add').disabled = false;
            } else {
                document.getElementById('add').disabled = true;
            }
        }

        checkFile();
    </script>
    <br>
    <br>

    <!--  -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th> </th>
                        <th>S.no</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>ID Number</th>
                        <th>DOB</th>
                        <th>KRA Pin</th>
                        <th>Property</th>
                        <th>Preferred Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($users as $user) {
                        $user_id = encrypt($user['user_id']);
                        if (empty($user['user_image'])) {
                            $image = 'white_bg_image.png';
                        } else {
                            $image = $user['user_image'];
                        }
                    ?>
                        <tr>
                            <td> </td>
                            <td><?= $cnt ?></td>
                            <td> <?= $user['user_name'] ?> </td>
                            <td> <?= $user['user_email'] ?> </td>
                            <td> <?= $user['user_phone'] ?> </td>
                            <td> <?= $user['user_passport'] ?> </td>
                            <td> <?= $user['user_dob'] ?> </td>
                            <td> <?= $user['user_kra'] ?> </td>
                            <td> <?= get_by_id('property', $user['property_id'])['property_name'] ?> </td>
                            <td> <?= $user['preferred_date'] ?> </td>
                            <td>
                                <a href="<?= landlord_url ?>user?id=<?= $user_id ?>" class="btn btn-success">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <a href="<?= delete_url ?>id=<?= $user_id ?>&table=<?= encrypt('user') ?>&page=<?= encrypt('view_users') ?>&method=user&landlord" class="btn btn-danger">
                                    <i class='bx bx-trash'></i>
                                </a>
                            </td>

                        </tr>
                    <?php
                        $cnt++;
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<!-- container-fluid -->

<!-- End of Main Content -->
<?php include_once 'footer.php'; ?>