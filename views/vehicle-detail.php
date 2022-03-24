<?php
if (isset($_SESSION['loggedin'])) {
	$clientInfo = $_SESSION['clientData'];
}
?><!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php if (isset($vehicle['invMake']) && isset($vehicle['invModel'])) {
            echo "$vehicle[invMake] $vehicle[invModel]";
            } elseif (isset($invMake) && isset($invModel)) {
        	    echo "$invMake $invModel"; }?> | PHP Motors</title>
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
            <h1><?php if (isset($vehicle['invMake']) && isset($vehicle['invModel'])) {
            	    echo "$vehicle[invMake] $vehicle[invModel]";
            	} elseif (isset($invMake) && isset($invModel)) {
            	    echo "$invMake $invModel";
            	} ?></h1>
            	<p class="review-notice">Reviews are shown at the bottom of the page.</p>
            <?php if (isset($message)) {echo $message;} ?>
            <?php if (isset($_SESSION['message'])) { echo $_SESSION['message']; } ?>
            <div id="grid">
                <div id="thumbnail-container">
	                <h2 id="thumbnail-title">Vehicle Thumbnails</h2>
			        <div id="thumbnails">
			            <?php if (isset($vehicleThumbnailDisplay)) { echo $vehicleThumbnailDisplay; } ?>
			        </div>
		        </div>
		        <?php if (isset($vehicleDisplay)) { echo $vehicleDisplay; } ?>
            </div>
            <br>
            <h2>Customer Reviews</h2>
            <?php if (isset($_SESSION['message'])) { echo $_SESSION['message']; } ?>
            <?php if (!isset($_SESSION['loggedin'])) { ?>
                <p class='review-notice'>Add a review by <a href="/phpmotors/accounts/?action=login")>logging in</a>.</p>
            <?php } else { ?>
                <p>WRITE A REVIEW</p>
				<form id="review-form" action="/phpmotors/reviews/index.php" method="POST">
	                <label for="name">Screen Name:
                        <input class="name" type="text" id="name" name="name" readonly value="<?php if(isset($clientFirstname)){echo substr($clientFirstname, 0, 1);} elseif(isset($clientInfo['clientFirstname'])) {echo substr($clientInfo['clientFirstname'], 0, 1);} if(isset($clientLastname)){echo $clientLastname;} elseif(isset($clientInfo['clientLastname'])) {echo $clientInfo['clientLastname'];} ?>">
                    </label>
					<label for="reviewText">Review this vehicle:
	                    <textarea name="reviewText" id="reviewText" rows="7" required><?php if(isset($reviewText)){echo "$reviewText";} ?></textarea>
	                </label>
	                <button type="submit">Submit Review</button>
                    <input type="hidden" name="action" value="add-review">
                    <input type="hidden" name="clientId" value="<?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>">
                    <input type="hidden" name="invId" value="<?php if(isset($vehicle['invId'])){ echo $vehicle['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
				</form>
            <?php } ?>
            <?php if (isset($reviewsDisplay)) {echo $reviewsDisplay;} ?>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>
<?php unset($_SESSION['message']); ?>