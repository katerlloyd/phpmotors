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
		$price = number_format($vehicle['invPrice']);
		$dv .= "<li><a href='/phpmotors/vehicles/?action=details&invId=".urlencode($vehicle['invId'])."'>";
		$dv .= "<img src='..$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
		$dv .= '<hr>';
		$dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
		$dv .= "<span>$$price</span>";
		$dv .= '</a></li>';
	}
	$dv .= '</ul>';
	return $dv;
}

// Build display of the details of a vehicle
function buildVehicleDetailsDisplay($vehicle) {
	$price = number_format($vehicle['invPrice']);
	$dv = '<div id="vehicle-details">';
		$dv .= '<div id="price-img">';
		$dv .= "<p id='price'>Price: $$price</p>";
		$dv .= "<img src='..$vehicle[invImage]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
		$dv .= '</div>';
		$dv .= '<div id="details">';
			$dv .= "<p id='title'>$vehicle[invMake] $vehicle[invModel] Details</p>";
			$dv .= "<p>$vehicle[invDescription]</p>";
			$dv .= "<p>Color: $vehicle[invColor]</p>";
			$dv .= "<p>In Stock: $vehicle[invStock]</p>";
		$dv .= '</div>';
	$dv .= '</div>';
	return $dv;
}

?>