<?php
require_once '../../path.php';
require_once "create.php";
$conn = connect();
$id = security('property_id');
$sql = "delete from features where property_id = '$id'";
insert_delete_edit($sql);
foreach($_POST['amenities_id'] as $key=>$val){
    $arr['features_id'] = create_id('features', 'features_id');
    $arr['amenities_id'] = mysqli_real_escape_string($conn,$val);
    $arr['property_id'] = security('property_id');
    build_sql_insert("features",$arr);
}
header("location:../../backoffice/view_properties.php?features_suc");