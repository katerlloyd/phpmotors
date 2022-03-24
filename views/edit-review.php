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
            <h1>Edit Review</h1>
            <?php if (isset($message)) {echo $message;} ?>
            <form action="/phpmotors/reviews/index.php" method="POST">
                <label for="reviewText">Text
                    <textarea name="reviewText" id="reviewText" rows="5" required><?php if(isset($reviewText)){ echo $reviewText; } elseif(isset($review['reviewText'])) {echo $review['reviewText']; }?></textarea>
                </label>

                <button type="submit">Update Review</button>
                <input type="hidden" name="action" value="edit-review">
                <input type="hidden" name="reviewId" value="<?php if(isset($review['reviewId'])){ echo review['reviewId'];}
                elseif(isset(reviewId)){ echo reviewId; } ?>">
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>