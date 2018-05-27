<?php
session_start();
require_once('Models/advertDataSet.php');

$view = new stdClass();
$view->pageTitle = 'Watchlist';
$advertDataSet = new advertDataSet();
$today = new DateTime(date('Y-m-d'));


$view->advertDataSet = $advertDataSet->fetchWatchlist($_SESSION['name']);
require_once('Views/watchlist.phtml');

if(isset($_GET['delete_id'])) {
    $deleteID = $_GET['delete_id'];
    $advertDataSet->deleteFromWatchlist($_GET['delete_id']);
    $view->advertDataSet = $advertDataSet->fetchWatchlist($_SESSION['name']);
}
require_once('Views/watchlist.phtml');


?>