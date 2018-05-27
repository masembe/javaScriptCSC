<?php
session_start();


require_once('Models/AdvertDataSet.php');



$view = new stdClass();
$view->pageTitle = 'View Ads';
$today =new DateTime(date('Y-m-d'));
$advertDataSet = new AdvertDataSet();


if(isset($_POST["searchButton"])){  // Search for an Ad, with the text entered in the search bar
    $view->advertDataSet = $advertDataSet->fetchAdsBySearch($_POST["title"]);
}
else
    {
    $view->advertDataSet = $advertDataSet->fetchAllAdverts();
}
require('Views/viewAd.phtml');

    if(!empty($_GET['id'])){
        $advertDataSet->watchlist($_GET['id'], $_SESSION['name']);
    }
if(isset($_GET['delete_id'])) {
    $deleteID = $_GET['delete_id'];
    $advertDataSet->deleteAd($_GET['delete_id']);
    $view->advertDataSet = $advertDataSet->fetchAllAdverts();

}





