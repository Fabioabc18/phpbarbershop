<?php

include('models/gallery.php');
include('models/categories.php');



$modelGallery = new Gallery();

$images = $modelGallery->get();

$categoriesModel = new Categories();
$categories = $categoriesModel->getCategories();





function homeAction()
{

    global $images;
    global $categories;
    include "views/header.php";
    include "views/navbar.php";
    include "views/about.php";
    include "views/services.php";
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