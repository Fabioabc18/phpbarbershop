<?php include '../connect.php'; ?>
<?php include '../Includes/functions/functions.php'; ?>


<?php


if (isset($_POST['do']) && $_POST['do'] == "Delete") {
    $client_id = $_POST['client_id'];

    $stmt = $con->prepare("DELETE FROM clients WHERE client_id = ?");
    $stmt->execute([$client_id]);

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