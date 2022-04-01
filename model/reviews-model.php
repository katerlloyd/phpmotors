<?php
// Main PHP Motors Reviews Model

function insertReview($reviewText, $invId, $clientId) {

    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();

    // The SQL statement
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId)
        VALUES (:reviewText, :invId, :clientId)';

  // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
//     $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Get review by invId
function getReviewsByInvId($invId) {

	 $db = phpmotorsConnect();
	 $sql = ' SELECT * FROM reviews WHERE invId = :invId ORDER BY reviewDate DESC';
	 $stmt = $db->prepare($sql);
	 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
	 $stmt->execute();
	 $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
	 $stmt->closeCursor();
	 return $reviews;
}

// Get review by clientId
function getReviewsByClientId($clientId) {

	 $db = phpmotorsConnect();
	 $sql = 'SELECT r.reviewId, r.reviewText, DATE_FORMAT(r.reviewDate, "%M %e, %Y") reviewDate, i.invMake, i.invModel FROM reviews r LEFT JOIN inventory i ON r.invId = i.invId WHERE clientId = :clientId ORDER BY r.reviewDate DESC';
	 $stmt = $db->prepare($sql);
	 $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
	 $stmt->execute();
	 $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
	 $stmt->closeCursor();
	 return $reviews;
}

// Get review by reviewId
function getReviewByReviewId($reviewId) {

	 $db = phpmotorsConnect();
	 $sql = 'SELECT * FROM reviews WHERE reviewId = :reviewId';
	 $stmt = $db->prepare($sql);
	 $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
	 $stmt->execute();
	 $review = $stmt->fetch(PDO::FETCH_ASSOC);
	 $stmt->closeCursor();
	 return $review;
}



// Update a review
function updateReview($reviewId, $reviewText, $reviewDate, $invId, $clientId) {

	$db = phpmotorsConnect();
	$sql = 'UPDATE reviews SET reviewText = :reviewText, reviewDate = :reviewDate,
		invId = :invId, clientId = :clientId WHERE reviewId = :reviewId';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
	$stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
	$stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
	$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
	$stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
	$stmt->execute();
	$rowsChanged = $stmt->rowCount();
	$stmt->closeCursor();
	return $rowsChanged;
}

// Delete a review
function deleteReview($reviewId) {

	$db = phpmotorsConnect();
	$sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
	$stmt->execute();
	$rowsChanged = $stmt->rowCount();
	$stmt->closeCursor();
	return $rowsChanged;
}
?>