<?php
session_start();

$view = new stdClass();
$view->pageTitle = 'test page';


require_once('Views/test.phtml');
