<?php
require_once '../../path.php';
require_once MODEL_PATH . "operations.php";

$id         = security('id', 'GET');
$table      = security('table', 'GET');
$column     = $table . '_id';

$method     = $_GET['method'];


if(isset($_GET['landlord'])){
    $return_url = landlord_url . security('page', 'GET');
}
if(isset($_GET['architect'])){
    $return_url = architects_url . security('page', 'GET');
}
if(isset($_GET['archdrawing'])){
    $return_url = architects_url . security('page', 'GET');
}
else{
    $return_url = admin_url . security('page', 'GET');
}
cout($return_url);
if ($method == 'simple_admin') {
    if (!delete($table, $column,  $id)) {
        $error['delete'] = 144;
        error_checker($return_url);
    }
    $success['delete'] = 212;
    render_success($return_url);
}


if ($method == 'property') {

    $new_table1 = 'property_image';
    $sql1       = "SELECT * FROM $new_table1 WHERE $column = '$id' ";
    $result1    = select_rows($sql1);
    foreach ($result1 as $row1) {
        if (!delete($new_table1, $column,  $id)) {
            $error['delete'] = 144;
            error_checker($return_url);
        }
    }


    $new_table2 = 'features';
    $sql2       = "SELECT * FROM $new_table2 WHERE $column = '$id' ";
    $result2    = select_rows($sql2);
    foreach ($result2 as $row2) {
        if (!delete($new_table2, $column,  $id)) {
            $error['delete'] = 144;
            error_checker($return_url);
        }
    }

    
    delete_files('property_image', 'property', 'property_id', $id);
    delete_files('property_image2', 'property', 'property_id', $id);
    if (!delete($table, $column,  $id)) {
        $error['delete'] = 144;
        error_checker($return_url);
    }
    
    
    $success['delete'] = 212;
    render_success($return_url);
}
if ($method == 'drawing') {

    $new_table1 = 'archdrawing';
    $sql1       = "SELECT * FROM $new_table1 WHERE $column = '$id' ";
    $result1    = select_rows($sql1);
    cout($result1);
    foreach ($result1 as $row1) {
        if (!delete($new_table1, $column,  $id)) {
            $error['delete'] = 144;
            error_checker($return_url);
        }
    }




    
    delete_files('arch_pdf', 'archdrawing', 'archdrawing_id', $id);
    delete_files('arch_file', 'archdrawing', 'archdrawing_id', $id);
    delete_files('arch_img', 'archdrawing', 'archdrawing_id', $id);
    delete_files('site_layout_pdf', 'archdrawing', 'archdrawing_id', $id);
    delete_files('floor_pdf', 'archdrawing', 'archdrawing_id', $id);
    delete_files('elevation_pdf', 'archdrawing', 'archdrawing_id', $id);
    delete_files('section_pdf', 'archdrawing', 'archdrawing_id', $id);
    delete_files('roof_pdf', 'archdrawing', 'archdrawing_id', $id);
    delete_files('detail_drawing_pdf', 'archdrawing', 'archdrawing_id', $id);
    delete_files('arch_calculation_pdf', 'archdrawing', 'archdrawing_id', $id);
    delete_files('working_drawings_pdf', 'archdrawing', 'archdrawing_id', $id);
    if (!delete($table, $column,  $id)) {
        $error['delete'] = 144;
        error_checker($return_url);
    }
    
    
    $success['delete'] = 212;
    render_success($return_url);
}

if ($method == 'user') {

    $new_table1 = 'booking';
    $sql1       = "SELECT * FROM $new_table1 WHERE $column = '$id' ";
    $result1    = select_rows($sql1);
    foreach ($result1 as $row1) {
        if (!delete($new_table1, $column,  $id)) {
            $error['delete'] = 144;
            error_checker($return_url);
        }
    }


    $new_table2 = 'payment';
    $sql2       = "SELECT * FROM $new_table2 WHERE $column = '$id' ";
    $result2    = select_rows($sql2);
    foreach ($result2 as $row2) {
        if (!delete($new_table2, $column,  $id)) {
            $error['delete'] = 144;
            error_checker($return_url);
        }
    }

    delete_files('user_image', 'user', 'user_id', $id);
    if (!delete($table, $column,  $id)) {
        $error['delete'] = 144;
        error_checker($return_url);
    }
    
    
    $success['delete'] = 212;
    render_success($return_url);
}

function delete_files($image, $table, $id_name, $id_value)
{

	$sql = "select $image from $table where $id_name = '$id_value'";
	$row = select_rows($sql)[0];
    // cout($row);

	return unlink(TARGET_DIR  . 'images/' . $row[$image]);
}
