<?php
include '../connect.php';
include '../Includes/functions/functions.php';

if (isset($_POST['do']) && $_POST['do'] == "Add") {
    $category_name = test_input($_POST['category_name']);

    $checkItem = checkItem("category_name", "service_categories", $category_name);

    if ($checkItem != 0) {
        $data['alert'] = "Aviso";
        $data['message'] = "Este nome de categoria já existe!";
        echo json_encode($data);
        exit();
    } elseif ($checkItem == 0) {

        $stmt = $con->prepare("INSERT INTO service_categories (category_name) VALUES (?)");
        $stmt->execute(array($category_name));

        $data['alert'] = "Sucesso";
        $data['message'] = "A nova categoria foi adicionada com sucesso!";
        echo json_encode($data);
        exit();
    }
}

if (isset($_POST['action']) && $_POST['action'] == "Delete") {
    $category_id = $_POST['category_id'];

    try {
        $con->beginTransaction();

        $stmt_services = $con->prepare("SELECT service_id FROM services WHERE category_id = ?");
        $stmt_services->execute(array($category_id));
        $services = $stmt_services->fetchAll();
        $services_count = $stmt_services->rowCount();

        if ($services_count > 0) {
            foreach ($services as $service) {
                $stmt_update_service = $con->prepare("UPDATE services SET category_id = NULL WHERE service_id = ?");
                $stmt_update_service->execute(array($service["service_id"]));
            }
        }

        $stmt = $con->prepare("DELETE FROM service_categories WHERE category_id = ?");
        $stmt->execute(array($category_id));
        $con->commit();
        $data['alert'] = "Sucesso";
        $data['message'] = "A categoria foi eliminada com sucesso!";
        echo json_encode($data);
        exit();
    } catch (Exception $exp) {
        $con->rollBack();
        $data['alert'] = "Aviso";
        $data['message'] = $exp->getMessage();
        echo json_encode($data);
        exit();
    }
}

if (isset($_POST['action']) && $_POST['action'] == "Edit") {
    $category_id = $_POST['category_id'];
    $category_name = test_input($_POST['category_name']);

    $checkItem = checkItem("category_name", "service_categories", $category_name);

    if ($checkItem != 0) {
        $data['alert'] = "Aviso";
        $data['message'] = "Este nome de categoria já existe!";
        echo json_encode($data);
        exit();
    } elseif ($checkItem == 0) {
        try {
            $stmt = $con->prepare("UPDATE service_categories SET category_name = ? WHERE category_id = ?");
            $stmt->execute(array($category_name, $category_id));

            $data['alert'] = "Sucesso";
            $data['message'] = "O nome da categoria foi atualizado com sucesso!";
            echo json_encode($data);
            exit();
        } catch (Exception $e) {
            $data['alert'] = "Aviso";
            $data['message'] = $e->getMessage();
            echo json_encode($data);
            exit();
        }
    }
}
?>