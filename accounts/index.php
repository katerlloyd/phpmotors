<?php 
// This is the accounts controller

// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../library/functions.php';
require_once '../model/main-model.php';
require_once '../model/accounts-model.php';

$classifications = getClassifications();

$navList = buildNavList($classifications);

// var_dump($classifications);
// exit;

// Check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'login':
        include '../views/login.php';
        // $clientEmail = filter_input(INPUT_POST, 'clientEmail');
        // $clientPassword = filter_input(INPUT_POST, 'clientPassword');
        break;
    case 'registration':
        // include '../views/registration.php';

        // Filter and store data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $checkPassword = checkPassword($clientPassword);

        $existingEmail = checkExistingEmail($clientEmail);

        // Check for existing email address in the clients table
        if ($existingEmail) {
            $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include '../views/login.php';
            exit;
        }

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../views/registration.php';
            exit; 
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model if no errors exist
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report result
        if ($regOutcome === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "Thanks for registering, $clientFirstname. Please use your email and password to login.";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../views/registration.php';
            exit;
        }
        break;
    case 'Login':
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $passwordCheck = checkPassword($clientPassword);

        // Run basic checks, return if errors
        if (empty($clientEmail) || empty($passwordCheck)) {
            $message = '<p class="notice">Please provide a valid email address and password.</p>';
            include '../views/login.php';
            exit;
        }
        
        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../views/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        include '../views/admin.php';
        exit;
    case 'Logout':
        // setcookie('PHPSESSID', "", time() - 3600);
        session_unset();
        session_destroy();
        if (isset($_COOKIE['firstname'])) {
            setcookie('firstname', "", time() - 3600);
        }
        header('Location: /phpmotors/');
        break;
    case 'register-page':
        include '../views/registration.php';
        break;
	case 'mod':
		$clientInfo = $_SESSION['clientData'];

        if ($clientInfo === null) {
            $message = 'Sorry, your information could not be found.';
        }
        include '../views/client-update.php';
        exit;
	    break;
	case 'updateAccount':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientEmail = checkEmail($clientEmail);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        $sessionEmail = $_SESSION['clientData']['clientEmail'];

        if ($clientEmail !== $sessionEmail) {
            $existingEmail = checkExistingEmail($clientEmail);
            if ($existingEmail) {
                $message = '<p class="notice">That email address already exists. Please try a different one.</p>';
                include '../views/client-update.php';
                exit;
            }
        }

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            $_SESSION['message'] = $message;
            include '../views/client-update.php';
            exit;
        }

        // Send the data to the model if no errors exist
        $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

        // Check and report result
        if ($updateResult) {
            $clientInfo = getClientById($clientId);
            // Remove the password from the array
            array_pop($clientInfo);
            // Store the array into the session
            $_SESSION['clientData'] = $clientInfo;

            $message = "Your account information has been updated successfully.";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p>Error: Your account information was not updated. Please try again.</p>";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/accounts/');
            exit;
        }
		break;
	case 'updatePassword':
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $checkPassword = checkPassword($clientPassword);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

		// Check for missing data
        if (empty($checkPassword)) {
			$message = '<p>Please provide a valid new password.</p>';
			$_SESSION['message'] = $message;
            include '../views/client-update.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model if no errors exist
        $updatePasswordResult = updatePassword($hashedPassword, $clientId);

        // Check and report result
        if ($updatePasswordResult) {
            $message = "Your password has been updated successfully.";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p>Error: Your password was not updated. Please try again.</p>";
            $_SESSION['message'] = $message;
            include '../views/client-update.php';
            exit;
        }
        break;
    default:
        include '../views/admin.php';
        break;
}
?>