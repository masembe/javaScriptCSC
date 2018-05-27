<?php
session_start();


require_once('Models/AdvertDataSet.php');



$view = new stdClass();
$view->pageTitle = 'View Ads';
$today =new DateTime(date('Y-m-d'));
$advertDataSet = new AdvertDataSet();


if(!empty($_GET['id'])){
      $view->advertDataSet = $advertDataSet->fetchAdsById($_GET["id"]); 
}
//var_dump($view->advertDataSet);
require('Views/viewAdvert.phtml');





