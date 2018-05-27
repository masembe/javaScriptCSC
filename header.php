<?php
$headerView = new stdClass();
require_once('Models/AccountDataSet.php');
$accountDataSet=new AccountDataSet();

if(isset($_SESSION["name"])){   // Display the name of the logged user
    $headerView->welcome="Welcome!";
    $headerView->account=$accountDataSet->userAccount($_SESSION["name"]);


}

if(isset($_POST["logout"])) {   // And display the log out button, who destroy the session if clicked
    unset($headerView->welcome);
    session_unset();
    session_destroy();
    header("Location:index.php");
}


require_once("Views/template/header.phtml");