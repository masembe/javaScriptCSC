<?php
session_start();
require_once('Models/AccountDataSet.php');
$view = new stdClass();
$view->pageTitle = 'Log in';

$accountDataSet=new AccountDataSet();


if (isset($_POST["login"])) {        // Checks if the email matches with the password, and if so a session is created
    if (!$accountDataSet->loginAuthorized($_POST["email"],$_POST["password"])){
        $view->error = "Password/Email did not match. Please try again!";
    } else {
        $_SESSION["name"] = $_POST["email"];
        header("Location:viewAd.php"); //Sends the user to view ads
    }
}

require_once('Views/login.phtml');




