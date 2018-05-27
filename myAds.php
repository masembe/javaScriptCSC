<?php
session_start();

require_once('Models/AdvertDataSet.php');

$view = new stdClass();
$view->pageTitle = 'My Ads ';
$today =new DateTime(date('Y-m-d'));
$advertDataSet = new AdvertDataSet();

$view->advertDataSet = $advertDataSet->fetchAllAdverts();

if(isset($_GET['delete_id'])) {
    $deleteID = $_GET['delete_id'];
    $advertDataSet->deleteAd($_GET['delete_id']);
    $view->advertDataSet = $advertDataSet->fetchAllAdverts();
}



require_once('Views/myAds.phtml');






