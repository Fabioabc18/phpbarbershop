<?php


include "models/base.php";



function homeAction()
{

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
    require "C:/xampp/htdocs/templates/images";
    require "templates/css";
    require "templates/js";

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