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
    case 'getReviews':
	     $clientId = filter_input(INPUT_GET, 'clientId', FILTER_SANITIZE_NUMBER_INT);
	     $reviewsArray = getReviewsByClientId($clientId);
	     echo json_encode($reviewsArray);
	     break;
	case 'getVehicles':
// 	     $invId = $_GET['invId'];
// 	     $invId = htmlspecialchars($invId);
	     $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
         $vehiclesArray = getInvItemInfo($invId);
         echo json_encode($vehiclesArray);
         break;
    case 'edit-review-page':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $review = getReviewByReviewId($reviewId);
        if (count($reviews) < 1) {
            $message = "You haven't written any reviews yet.";
        }
        include '../views/edit-review.php';
        exit;
        break;
    case 'edit-review':
		$reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $reviewDate = filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        if (empty($reviewId) || empty($reviewText) || empty($reviewDate) || empty($invId) || empty($clientId)) {
            $message = "<p class='notice'>Please complete all information for the review.</p>";
            include '../views/edit-review.php';
            exit;
        }

        $updateResult = updateReview($reviewId, $reviewText, $reviewDate, $invId, $clientId);
        if ($updateResult) {
            $message = "<p class='notice'>Congratulations, your review was successfully updated.</p>";
            $_SESSION['message'] = $message;
            include '../views/admin.php';
            exit;
        } else {
            $message = "<p class='notice'>Error: Your review was not updated.</p>";
            include '../views/edit-review.php';
            exit;
        }
        break;
    case 'delete-review-page':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $review = getReviewByReviewId($reviewId);
        if (count($reviews) < 1) {
	        $message = 'Sorry, no review information could be found.';
	    }
        include '../views/delete-review.php';
        exit;
        break;
    case 'delete-review':
		$invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
		$vehicle = getInvItemInfo($invId);
		$invMake = $vehicle['invMake'];
        $invModel = $vehicle['invModel'];
		$reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

		$deleteResult = deleteReview($reviewId);
		if ($deleteResult) {
		    $message = "<p class='notice'>Congratulations, your $invMake $invModel review was successfully deleted.</p>";
		    $_SESSION['message'] = $message;
		    header('Location: /phpmotors/reviews/');
		    exit;
		} else {
		    $message = "<p class='notice'>Error: $invMake $invModel was not deleted.</p>";
		    $_SESSION['message'] = $message;
		    header('Location: /phpmotors/reviews/');
		    exit;
		}
		break;
    default:
        include '../views/admin.php';
        break;
}
?>