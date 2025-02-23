<?php
$page        = 'users';
$header_name = 'Clients';

//  require_once '../path.php';
require_once 'header.php';

// $users = get_landlord_users();
$sql = "SELECT user.*,request.request_id, request.property_id, request.property_unit_id FROM user LEFT JOIN request ON user.user_id = request.user_id JOIN property ON request.property_id = property.property_id  WHERE property.added_by = '$profile[landlord_id]'  ";
$users = select_rows($sql);
// cout($sql);

$num_columns = 12;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => ''),
        array('data' => 'col_' . $i, 'title' => 'S.no'),
        array('data' => 'property_id', 'title' => 'Property'),
        array('data' => 'property_unit', 'title' => 'Unit'),
        array('data' => 'user_name', 'title' => 'Name'),
        array('data' => 'user_email', 'title' => 'Email'),
        array('data' => 'user_phone', 'title' => 'Phone'),
        array('data' => 'user_passport', 'title' => 'ID Number'),
        array('data' => 'action', 'title' => 'Action'),
        array('data' => 'user_dob', 'title' => 'DOB'),
        array('data' => 'user_kra', 'title' => 'KRA Pin'),
        array('data' => 'preferred_date', 'title' => 'Preferred Date'),
    );
}

$add = 'user';

$houses = get_landlord_properties($profile['landlord_id']);
?>



<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> Clients</h4>

    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th> </th>
                        <th>S.no</th>
                        <th>Property</th>
                        <th>Unit</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>ID Number</th>
                        <th>Action</th>
                        <th>DOB</th>
                        <th>KRA Pin</th>
                        <th>Preferred Date</th>
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
                            <td> <?= get_by_id('property', $user['property_id'])['property_name'] ?> </td>
                            <td> <?= get_by_id('property_unit', $user['property_unit_id'])['property_unit_name'] ?> </td>
                            <td> <?= $user['user_email'] ?> </td>
                            <td> <?= $user['user_phone'] ?> </td>
                            <td> <?= $user['user_passport'] ?> </td>
                             <td>
                                <a href="<?= base_url ?>model/update/admission?id=<?= encrypt($user['request_id']) ?>" class="btn btn-success">
                                    Accept
                                </a>
                                <a href="<?= model_url ?>booking4?id=<?= encrypt($user['request_id']) ?>" class="btn btn-danger">
                                    Decline
                                </a>
                            </td>
                            <td> <?= $user['user_dob'] ?> </td>
                            <td> <?= $user['user_kra'] ?> </td>
                            <td> <?= $user['preferred_date'] ?> </td>
                           

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