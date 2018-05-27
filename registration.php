<?php
session_start();
error_reporting(0);

require_once ('Models/AccountDataSet.php');

$view = new stdClass();
$view->pageTitle = 'Registration';

$accountDataSet = new AccountDataSet();



if(isset($_POST['register'])){  // The register function that checks if the registration is complete
    if($_POST['password'] !== $_POST['confirm-password']){    // If the chosen password and its confirmation are not the same
        $view->error = "Password and confirm password did not match. Please try again!";
    } else {       // Register the user
        if ( $_POST['captchaInput'] && $_SESSION['answer'] == $_POST['captchaInput']) {
            $email = $_POST['email'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            $phone_number = $_POST['phone_number'];
            $address = $_POST['address'];
            $accountDataSet->registration($email, $name, $password, $phone_number, $address);


            header("Location:login.php");
        } else{
            $view->error = "Wrong answer. Please try again!";
        }
    }
}


require_once('Views/registration.phtml');

