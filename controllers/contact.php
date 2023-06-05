<?php

require('models/contact.php');



if (isset($_POST["send"])) {

    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim(htmlspecialchars(strip_tags($value)));
    }


    if (
        mb_strlen($_POST["name"]) >= 3 &&
        mb_strlen($_POST["name"]) <= 60 &&
        mb_strlen($_POST["subject"]) >= 3 &&
        mb_strlen($_POST["subject"]) <= 150 &&
        mb_strlen($_POST["message"]) >= 3 &&
        mb_strlen($_POST["message"]) <= 2000 &&
        filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
    ) {

        $contactModel = new Contact();

        $contactId = $contactModel->saveContact($_POST);


        header('Content-Type: application/json');
        echo json_encode(['status' => 'OK']);
        exit;
    }





}