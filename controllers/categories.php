<?php

require('models/categories.php');

$categoriesModel = new Categories();
$categories = $categoriesModel->getPriceList();


include('views/pricelist.php');