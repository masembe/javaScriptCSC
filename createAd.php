<?php
require_once("Models/advertDataSet.php");
session_start();
$view = new stdClass();
$view->pageTitle = 'Page1';



$upload = new AdvertDataSet(); //Creates a new data set in the database
if(isset($_SESSION["name"])) {
    if (isset($_POST['Submit'])) {
        $expiry_date = new DateTime(date('Y-m-d')); //Gets the current date of when the ad was posted
        $expiry_date->add(new DateInterval('P14D')); //Adds 14 days from the day it was posted

            $upload->addAdvert($_POST['title'], $_POST['type'], $_POST['description'], $_POST['status'], $_POST['photo'], $_POST['price'], $_SESSION["name"],$expiry_date->format('Y-m-d'));

    }
}

else
    {
    header('location:login.php');
}
require_once('Views/createAd.phtml');