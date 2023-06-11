<?php

include('models/gallery.php');
include('models/team.php');
include('models/categories.php');
include('models/appointment.php');






$modelGallery = new Gallery();
$images = $modelGallery->get();

$modelTeam = new Team();
$barbers = $modelTeam->get();

$categoriesModel = new Categories();
$categories = $categoriesModel->getCategories();

$appointmentModel = new Appointment();
$services = $appointmentModel->getChoiceOfServices();
$availableBarber = $appointmentModel->getAvailableBarbers();







function homeAction()
{

    global $images;
    global $barbers;
    global $categories;
    global $services;
    global $availableBarber;











    include "views/header.php";
    include "views/navbar.php";
    include "views/about.php";
    include "views/services.php";
    include "views/appointment.php";
    include "views/booking.php";
    include "views/gallery.php";
    include "views/team.php";
    include "views/reviews.php";
    include "views/pricelist.php";
    include "views/contact.php";
    include "views/widgetsection.php";
    include "views/footer.php";
}


$action = isset($_GET['action']) ? $_GET['action'] : 'home';
switch ($action) {
    case 'home':
        homeAction();
        break;



    default:

        echo "Invalid action";
        break;
}