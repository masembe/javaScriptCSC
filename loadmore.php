<?php
session_start();


require_once('Models/AdvertDataSet.php');



$view = new stdClass();
$view->pageTitle = 'View Ads';
$today =new DateTime(date('Y-m-d'));
$advertDataSet = new AdvertDataSet();

if(isset($_GET['no'])){
      $json = json_encode($advertDataSet->loadMore($_GET["no"]));
        
    header('Content-Type: application/json');


    print $json;

}
