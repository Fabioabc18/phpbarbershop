<?php include '../connect.php'; ?>
<?php include '../Includes/functions/functions.php'; ?>


<?php


if (isset($_POST['do']) && $_POST['do'] == "Delete") {
    $contact_id = $_POST['contact_id'];

    $stmt = $con->prepare("DELETE FROM contact WHERE contact_id = ?");
    $stmt->execute([$contact_id]);

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