<?php
require('models/appointment.php');

function submitForm()
{
    if (isset($_POST['submit_book_appointment_form'])) {
        $selectedService = $_POST['selected_service'];
        $selectedDate = $_POST['selected_date'];

        $_SESSION['selected_service'] = $selectedService;
        $_SESSION['selected_date'] = $selectedDate;

        $appointmentModel = new Appointment();

        $availableBarber = $appointmentModel->getAvailableBarbers();


        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' && isset($_POST['selected_date'])) {
            $selectedDate = $_POST['selected_date'];





            header('Content-Type: application/json');
            echo json_encode($availableBarber);
            exit;
        }

        header('Content-Type: application/json');
        echo json_encode(['status' => 'OK']);
        exit;
    }
}