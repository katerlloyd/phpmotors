<?php 
// This is the vehicle controller

// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../library/functions.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';

$classifications = getClassifications();

$navList = buildNavList($classifications);

// $classificationList = '<label for="classificationId">Select Car Classification</label><select name="classificationId" id="classificationId">';
// foreach ($classifications as $classification) {
//     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
// }
// $classificationList .= '</select>';

// Check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

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
            $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));
            $checkClassificationName = checkClassificationName($classificationName);
    
            // Check for missing data
            if (empty($checkClassificationName)) {
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
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
            $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
            $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
            $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
            $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
    
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
    case 'getInventoryItems':
         // Get the classificationId
         $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
         // Fetch the vehicles by classificationId from the DB
         $inventoryArray = getInventoryByClassification($classificationId);
         // Convert the array to a JSON object and send it back
         echo json_encode($inventoryArray);
         break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../views/vehicle-update.php';
        exit;
	    break;
	case 'updateVehicle':
	    $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
	    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
	    $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

	    if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
		    $message = '<p>Please complete all information for the item! Double check the classification of the item.</p>';
		    include '../views/vehicle-update.php';
		    exit;
	    }

	    $updateResult = updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId);
	    if ($updateResult) {
	        $message = "<p>Congratulations, the $invMake $invModel was successfully updated.</p>";
	        $_SESSION['message'] = $message;
            header('Location: /phpmotors/vehicles/');
	        exit;
	    } else {
	        $message = "<p>Error: $invMake $invModel was not updated.</p>";
	        include '../views/vehicle-update.php';
	        exit;
	    }
	    break;
	case 'del':
	    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
	    $invInfo = getInvItemInfo($invId);
	    if (count($invInfo) < 1) {
	        $message = 'Sorry, no vehicle information could be found.';
	    }
	    include '../views/vehicle-delete.php';
	    exit;
	    break;
	case 'deleteVehicle':
	    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

	    $deleteResult = deleteVehicle($invId);
	    if ($deleteResult) {
	        $message = "<p class='notice'>Congratulations, the $invMake $invModel was successfully deleted.</p>";
	        $_SESSION['message'] = $message;
	        header('Location: /phpmotors/vehicles/');
	        exit;
	    } else {
	        $message = "<p class='notice'>Error: $invMake $invModel was not deleted.</p>";
	        $_SESSION['message'] = $message;
	        header('Location: /phpmotors/vehicles/');
	        exit;
	    }
	    break;
	case 'classification':
		 $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		 $vehicles = getVehiclesByClassification($classificationName);
		 if (!count($vehicles)) {
		    $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
		 } else {
		    $vehicleDisplay = buildVehiclesDisplay($vehicles);
		 }
// 		 echo $vehicleDisplay;
//          exit;
		 include '../views/classification.php';
		 break;
    default:
        $classificationList = buildClassificationList($classifications);

        include '../views/vehicle-management.php';
        break;
}
?>