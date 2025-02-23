<?php
$page        = 'view-users';
$header_name = 'Clients';

//  require_once '../path.php';
require_once 'header.php';

$users = get_all_users();

$num_columns = 11;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'S.no'),
        array('data' => 'col_' . $i, 'title' => 'S.no'),
        array('data' => 'user_name', 'title' => 'Name'),
        array('data' => 'user_email', 'title' => 'Email'),
        array('data' => 'user_phone', 'title' => 'Phone'),
        array('data' => 'user_names', 'title' => 'ID Number'),
        array('data' => 'user_emails', 'title' => 'DOB'),
        array('data' => 'user_phonesz', 'title' => 'KRA Pin'),
        array('data' => 'user_emailss', 'title' => 'Address'),
        array('data' => 'user_phoness', 'title' => 'Town'),
        array('data' => 'user_phoness', 'title' => 'Cover Status'),

    );
}

?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> Clients</h4>

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
                        <th>Address</th>
                        <th>Town</th>
                        <th>Cover Status</th>
                        <!--<th>Action</th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($users as $user) {
                        $user_id = encrypt($user['user_id']);
                        if(empty($user['user_image'])){
                            $image = 'white_bg_image.png';
                        }else{
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

                            <td> <?= $user['user_address'] ?> </td>
                            <td> <?= $user['user_town'] ?> </td>
                            <td> <?= $user['user_status'] ?> </td>
                          
                            <!--<td>-->
                            <!--   <a href="<?= admin_url ?>user?id=<?= $user_id ?>" class="btn btn-success">-->
                            <!--        <i class='bx bx-edit'></i>-->
                            <!--    </a>-->
                            <!--    <a href="<?= delete_url ?>id=<?= $user_id ?>&table=<?= encrypt('user') ?>&page=<?= encrypt('view_users') ?>&method=user" class="btn btn-danger">-->
                            <!--        <i class='bx bx-trash'></i>-->
                            <!--    </a>-->
                            <!--</td>-->

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