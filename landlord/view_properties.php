<?php
$page = 'property';
include_once 'header.php';
$properties = get_landlord_properties($profile['landlord_id']);

$num_columns = 9;

$column_indexes = range(0, $num_columns - 1);

// Create an array of column definition objects
$column_defs = array();
for ($i = 0; $i < $num_columns; $i++) {
    $column_defs = array(
        array('data' => '', 'title' => 'id'),
        array('data' => 'col_' . $i, 'title' => '#'),
        array('data' => 'property_image', 'title' => 'First Image'),
        array('data' => 'property_image2', 'title' => 'Second Image'),
        array('data' => 'property_name', 'title' => 'Title'),
        array('data' => 'property_price', 'title' => 'Units'),
        array('data' => 'property_other', 'title' => 'Other Images'),
        array('data' => '', 'title' => 'Action'),
        array('data' => 'property_date_created', 'title' => 'Created On')
    );
}

$add = 'property.php';
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View</span> properties</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th></th>

                        <th>No.</th>
                        <th>First Image</th>
                        <th>Second Image</th>
                        <th>Title</th>
                        <th>Units</th>
                        <th>Other Images</th>
                        
                        <th>Action</th>
                        <th>Created On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($properties as $property) {
                        $property_id = encrypt($property['property_id']);
                        $image_type = !empty(get_image($property['property_id'])) ? 'Edit/View' : 'Add';
                        $units = sizeof(get_by_column('property_unit','property_id',$property['property_id']));
                        if($units > 0){
                            $link = landlord_url . "property_details?id=" . $property_id;
                        }else{
                            $link = landlord_url . "property_units?id=" . $property_id;
                        }

                    ?>
                        <tr>
                            <td> </td>
                            <td><?= $cnt ?></td>
                            <td>
                                <img alt="property image <?= $property['property_name'] ?>" src="<?= file_url . $property['property_image'] ?>" style="width:150px; height:auto; border-radius:5px;" title="<?= $property['property_name'] ?>">
                            </td>
                            <td>
                                <img alt="property image <?= $property['property_name'] ?>" src="<?= file_url . $property['property_image2'] ?>" style="width:150px; height:auto; border-radius:5px;" title="<?= $property['property_name'] ?>">
                            </td>
                            <td><?= $property['property_name'] ?></td>
                            <td>
                            <a href="<?= $link ?>" class="btn btn-info">
                                    <small>View Units</small>
                                </a></td>

                            <td>
                                <a href="<?= landlord_url ?>property_images?id=<?= $property_id ?>" class="btn btn-primary">
                                    <small><?= $image_type ?></small>
                                </a>
                            </td>

                          
                            <td>

                                <a href="<?= landlord_url ?>property_details?id=<?= $property_id ?>" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="../model/delete?id=<?= $property_id ?>&table=<?= encrypt('property') ?>&page=<?= encrypt('view_properties') ?>&method=property&landlord" class="btn btn-danger mt-1">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                              <td><?= get_ordinal_month_year($property['property_date_created']) ?></td>
                        </tr>

                    <?php $cnt++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>



</div>
<!-- / Content -->


<?php
include_once 'footer.php';
?>