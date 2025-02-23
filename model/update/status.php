<?php
require_once "create.php";

$id         = security('id', 'GET');
$table      = security('table', 'GET');
$column     = $table . '_id';
$status     = $table . '_status';
$return_url = admin_url . security('page', 'GET');

$sql = "SELECT $status FROM $table WHERE $column = '$id' ";
$row = select_rows($sql)[0];

if ($row[$status] == 'active') {
	$arr[$status] = 'inactive';
} else {
	$arr[$status] = 'active';
}

if (!build_sql_edit($table, $arr, $id, $column)) {
	$error[$table] = 149;
	error_checker($return_url);
}
write_metadata($table,'Activate Landlord',$id,'Admin',$_SESSION['admin_id']);
$success[$table] = 221;
render_success($return_url);
