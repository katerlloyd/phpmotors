<?php
// Main PHP Motors Model

function getClassifications() {

    $db = phpmotorsConnect(); 

    $sql = 'SELECT classificationName FROM carclassification ORDER BY classificationName ASC'; 
 
    $stmt = $db->prepare($sql);

    $stmt->execute(); 

    $classifications = $stmt->fetchAll(); 

    $stmt->closeCursor(); 

    return $classifications;
}
?>