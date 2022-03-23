<?php
// This is the reviews controller

session_start();
require_once '../library/connections.php';
require_once '../library/functions.php';
require_once '../model/main-model.php';
require_once '../model/reviews-model.php';

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
    case 'add-review':
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
//         $reviewDate = time();
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

		// Check for missing data
		if (empty($reviewText) || empty($invId) || empty($clientId)) {
			$message = "<p class='notice'>Please write a review before trying to submit it.</p>";
			$_SESSION['message'] = $message;
			header("Location: /phpmotors/vehicles/?action=details&invId=$invId");
			exit;
		}

		// Send the data to the model if no errors exist
        $addOutcome = insertReview($reviewText, $invId, $clientId);

        // Check and report result
        if ($addOutcome === 1) {
	        $message = "<p class='notice'>Review created successfully.</p>";
	        $_SESSION['message'] = $message;
            header("Location: /phpmotors/vehicles/?action=details&invId=$invId");
            exit;
        } else {
            $message = "<p class='notice'>Sorry, something went wrong when adding your review. Please try again.</p>";
            $_SESSION['message'] = $message;
            header("Location: /phpmotors/vehicles/?action=details&invId=$invId");
            exit;
        }
        break;
    case 'edit-review-page':
	    include '../views/edit-review.php';
        break;
    case 'edit-review':
        break;
    case 'delete-review-page':
        $message = "<p class='notice'>Are you sure that you want to delete this review?</p>";
        $_SESSION['message'] = $message;
//         header("Location: /phpmotors/vehicles/?action=details&invId=$invId");
        include '../views/delete-review.php';
        break;
    case 'delete-review':
        break;
    default:
        include '../views/admin.php';
        break;
}
?>