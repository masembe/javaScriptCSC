<?php

require_once('Models/AccountData.php');
require_once('Models/AdvertDataSet.php');


if(isset($_REQUEST['q'])){
    $query = $_REQUEST['q'];

    $advertDataSet = new AdvertDataSet();

    $json = json_encode($advertDataSet->fetchHint($query));

    header('Content-Type: application/json');


    print $json;
}

