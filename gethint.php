<?php

require_once('Models/advertdata.php');
require_once('Models/AdvertDataSet.php');



//$search = new UserDataSet();


if(isset($_REQUEST['q'])){
    $query = $_REQUEST['q'];

    $advertDataSet = new AdvertDataSet();

    $json = json_encode($advertDataSet->fetchHint($query));

    header('Content-Type: application/json');


    print $json;
}


//$q = $_REQUEST["q"];
//
//$advNames = $search-> suggestions($q);

// get the q parameter, the text typed in, from URL

//$hint = "";
//// lookup all hints from array if $q is different from ""
//if ($q !== "") {
//    $q = strtolower($q);
//    $len=strlen($q);
//    foreach($advNames as $name) {
//        if (stristr($q, substr($name, 0, $len))) {
//            if ($hint === "") {
//                $hint = '<a href ="viewAdd.php?search="'.$name.'"&searchButton=Go!">'.$name.'</a>';
//
//            } else {
//                $hint .= ", '<a href =\"viewAdd.php?search=".$name."&searchButton=Go!\">'.$name.'</a>'";
//            }
//        }
//    }
//}
//$i=0;
//while($i<sizeof($advNames))
//{
//    if ($hint === "") {
//                $hint = "'<a href =\"viewAdd.php?search=".$advNames[$i]."&searchButton=Go!\">'.$advNames[$i].'</a>'";
//
//            } else {
//                $hint .= ", '<a href =\"viewAdd.php?search=".$advNames[$i]."&searchButton=Go!\">'.$advNames[$i].'</a>'";
//            }
//
//    $i++;
//}

//$search = $this->fetchHint($q);
// Output "no suggestion" if no hint was found or output results  
//echo $hint === "" ? "no suggestion" : $hint;

//echo($advNames);
//print_r($advNames);

