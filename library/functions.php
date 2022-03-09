<?php 

// Checks if email is valid
function checkEmail($clientEmail) {
    $valEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters,
 // at least one 1 capital letter, at least 1 number and
 // at least 1 special character
function checkPassword($clientPassword) {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

// Check that classificationName is 1-30 characters long
function checkClassificationName($classificationName) {
    $pattern = '/^.{1,30}$/';
    return preg_match($pattern, $classificationName);
}

// Build navigation list
function buildNavList($classifications) {
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] vehicle line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Build the classifications select list
function buildClassificationList($classifications) {
	 $classificationList = '<select name="classificationId" id="classificationList">';
	 $classificationList .= "<option>Choose a Classification</option>";
	 foreach ($classifications as $classification) {
		  $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
	 }
	 $classificationList .= '</select>';
	 return $classificationList;
}

// Build display of vehicles within an unordered list
function buildVehiclesDisplay($vehicles) {
	$dv = '<ul id="inv-display">';
	foreach ($vehicles as $vehicle) {
		$dv .= '<li>';
		$dv .= "<img src='..$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
		$dv .= '<hr>';
		$dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
		$dv .= "<span>$vehicle[invPrice]</span>";
		$dv .= '</li>';
	}
	$dv .= '</ul>';
	return $dv;
}

?>