<?php 
// This is the main controller

// Create or access a Session
session_start();

require_once 'library/connections.php';
require_once 'library/functions.php';
require_once 'model/main-model.php';

$classifications = getClassifications();

$navList = buildNavList($classifications);

// Check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'template':
        include 'views/template.php';
        break;
    default:
        include 'views/home.php';
        break;
}
?>