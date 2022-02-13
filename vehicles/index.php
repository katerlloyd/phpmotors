<?php 
// This is the vehicle controller

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';

$classifications = getClassifications();

$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

$classificationList = '<label for="classificationId">Select Car Classification</label><select name="classificationId" id="classificationId">';
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
}
$classificationList .= '</select>';

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'add-classification-page':
        include '../views/add-classification.php';
        break;
    case 'add-vehicle-page':
        include '../views/add-vehicle.php';
        break;
    case 'add-classification':
            // Filter and store data
            $classificationName = filter_input(INPUT_POST, 'classificationName');
    
            // Check for missing data
            if (empty($classificationName)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../views/add-classification.php';
                exit; 
            }

            $regOutcome = insertClassification($classificationName);

            // Check and report result
            if ($regOutcome === 1) {
                // header('Location: /');
                include '../views/vehicle-management.php';                
                exit;
            } else {
                $message = "<p>Sorry, something went wrong when adding $classificationName. Please try again.</p>";
                include '../views/add-classification.php';
                exit;
            }
        break;
    case 'add-vehicle':
            // Filter and store data
            $invMake = filter_input(INPUT_POST, 'invMake');
            $invModel = filter_input(INPUT_POST, 'invModel');
            $invDescription = filter_input(INPUT_POST, 'invDescription');
            $invImage = filter_input(INPUT_POST, 'invImage');
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
            $invPrice = filter_input(INPUT_POST, 'invPrice');
            $invStock = filter_input(INPUT_POST, 'invStock');
            $invColor = filter_input(INPUT_POST, 'invColor');
            $classificationId = filter_input(INPUT_POST, 'classificationId');
    
            // Check for missing data
            if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../views/add-vehicle.php';
                exit; 
            }

            $regOutcome = insertVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        // Check and report result
        if ($regOutcome === 1) {
            $message = "<p>$invMake $invModel added successfully.</p>";
            // header('Location: /');
            include '../views/add-vehicle.php';
            exit;
        } else {
            $message = "<p>Sorry, something went wrong when adding $invMake $invModel. Please try again.</p>";
            include '../views/add-vehicle.php';
            exit;
        }
        break;
    default:
        include '../views/vehicle-management.php';
        break;
}
?>