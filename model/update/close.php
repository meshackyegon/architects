<?php
require_once "create.php";

$id         = security('id', 'GET');
$table      = security('table', 'GET');
$column     = 'project_id';
$status     = 'completion_status';
$return_url = architects_url . security('page', 'GET');

$sql = "SELECT $status FROM $table WHERE $column = '$id' ";
$row = select_rows($sql)[0];
cout($row);

if ($row[$status] == 'In Progress') {
	$arr[$status] = 'Completed';
} else {
	$arr[$status] = 'In Progress';
}

if (!build_sql_edit($table, $arr, $id, $column)) {
	$error[$table] = 149;
	error_checker($return_url);
}
write_metadata($table,'Close and Reopen Project',$id,'Architect',$_SESSION['architect_id']);
$success[$table] = 221;
render_success($return_url);
