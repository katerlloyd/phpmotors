<?php
if (!(isset($_SESSION['loggedin']) && $_SESSION['clientData']['clientLevel'] > 1)) {
    header('Location: /phpmotors/');
    exit;
}
$classificationList = '<label for="classificationId">Car Classification</label><select name="classificationId" id="classificationId">';
$classificationList .= "<option>Choose a Car Classification</option>";
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)) {
        if ($classification['classificationId'] === $classificationId) {
            $classificationList .= ' selected ';
        } elseif (isset($invInfo['classificationId'])) {
	         if ($classification['classificationId'] === $invInfo['classificationId']) {
		          $classificationList .= ' selected ';
	         }
	     }
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';
?><!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            echo "Modify $invInfo[invMake] $invInfo[invModel]";
            } elseif (isset($invMake) && isset($invModel)) {
        	    echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
        <link rel="stylesheet" href="/phpmotors/css/styles.css" type="text/css" media="screen">
    </head>
    <body>
        <header>
           <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>
        <nav>
            <?php echo $navList; ?>
        </nav>
        <main>
            <h1><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            	    echo "Modify $invInfo[invMake] $invInfo[invModel]";
            	} elseif (isset($invMake) && isset($invModel)) {
            	    echo "Modify $invMake $invModel";
            	} ?></h1>
            <?php if (isset($message)) {echo $message;} ?>
            <form action="/phpmotors/vehicles/index.php" method="POST">
                <?php echo $classificationList; ?>
                <label for="invMake">Make
                    <input name="invMake" id="invMake" type="text" <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'";} ?> required>
                </label>
                <label for="invModel">Model
                    <input name="invModel" id="invModel" type="text" <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'";} ?> required>
                </label>
                <label for="invDescription">Description
                    <textarea name="invDescription" id="invDescription" rows="5" required><?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
                </label>
                <label for="invImage">Image Path
                    <input name="invImage" id="invImage" type="text" <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'";} ?> required>
                </label>
                <label for="invThumbnail">Thumbnail Path
                    <input name="invThumbnail" id="invThumbnail" type="text" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'";} ?> required>
                </label>
                <label for="invPrice">Price
                    <input name="invPrice" id="invPrice" type="text" <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'";} ?> required>
                </label>
                <label for="invStock">Stock
                    <input name="invStock" id="invStock" type="text" <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'";} ?> required>
                </label>
                <label for="invColor">Color
                    <input name="invColor" id="invColor" type="text" <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'";} ?> required>
                </label>

                <button type="submit">Update Vehicle</button>
                <input type="hidden" name="action" value="updateVehicle">
                <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];}
                elseif(isset($invId)){ echo $invId; } ?>">
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>