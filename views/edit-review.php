<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpmotors/');
    exit;
}
?><!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Review | PHP Motors</title>
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
                echo "Edit Review for $vehicle[invMake] $vehicle[invModel]";
            } elseif (isset($invMake) && isset($invModel)) {
                echo "Edit Review for $invMake $invModel";
            } else { echo "Edit Review"; } ?></h1>
            <?php if (isset($message)) {echo $message;} ?>
            <form class="review-form" action="/phpmotors/reviews/index.php" method="POST">
				<label for="name">Screen Name:
				    <input class="name" type="text" id="name" name="name" readonly value="<?php if(isset($clientFirstname)){echo substr($clientFirstname, 0, 1);} elseif(isset($clientInfo['clientFirstname'])) {echo substr($clientInfo['clientFirstname'], 0, 1);} if(isset($clientLastname)){echo $clientLastname;} elseif(isset($clientInfo['clientLastname'])) {echo $clientInfo['clientLastname'];} ?>">
				</label>
                <label for="reviewText">Review Text:
                    <textarea name="reviewText" id="reviewText" rows="7" required><?php if(isset($reviewText)){ echo $reviewText; } elseif(isset($review['reviewText'])) {echo $review['reviewText']; }?></textarea>
                </label>

                <button type="submit">Update Review</button>
                <input type="hidden" name="action" value="edit-review">
                <input type="hidden" name="reviewId" value="<?php if(isset($review['reviewId'])){ echo $review['reviewId'];}
                elseif(isset($reviewId)){ echo $reviewId; } ?>">
                <input type="hidden" name="invId" value="<?php if(isset($review['invId'])){ echo $review['invId'];}
                elseif(isset($invId)){ echo $invId; } ?>">
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>