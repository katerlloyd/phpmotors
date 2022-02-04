<?php
// Main PHP Motors Vehicles Model

function insertClassification($classificationId, $classificationName) {
   
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
 
    // The SQL statement
    $sql = 'INSERT INTO classification (classificationId, classificationName)
        VALUES (:classificationId, :classificationName)';
  
  // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
 
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    
    // Insert the data
    $stmt->execute();
    
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
   
    // Close the database interaction
    $stmt->closeCursor();
   
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

function insertVehicle($invId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId) {
   
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
 
    // The SQL statement
    $sql = 'INSERT INTO inventory (invId, invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
        VALUES (:invId, :invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
  
  // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
 
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
    
    // Insert the data
    $stmt->execute();
    
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
   
    // Close the database interaction
    $stmt->closeCursor();
   
    // Return the indication of success (rows changed)
    return $rowsChanged;
}
?>