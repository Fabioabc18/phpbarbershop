<?php
include '../connect.php';
include '../Includes/functions/functions.php';

if (isset($_POST['do']) && $_POST['do'] == "Delete") {
	$employee_id = $_POST['employee_id'];

	$stmt = $con->prepare("DELETE FROM employees WHERE employee_id = ?");
	$stmt->execute([$employee_id]);

	$row_count = $stmt->rowCount();

	if ($row_count > 0) {
		$response = array('status' => 'OK');
		echo json_encode($response);
		exit();
	} else {
		$response = array('status' => 'Error');
		echo json_encode($response);
		exit();
	}
}
?>