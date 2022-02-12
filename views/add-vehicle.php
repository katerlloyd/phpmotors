<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Vehicle | PHP Motors</title>
        <link rel="stylesheet" href="/phpmotors/css/styles.css" type="text/css" media="screen">
    </head>
    <body>
        <header>
           <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>
        <nav>
            <?php //require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php'; 
            echo $navList; ?>
        </nav>
        <main>
            <h1>Add Vehicle</h1>
            <?php if (isset($message)) {echo $message;} ?>
            <form action="/phpmotors/vehicles/index.php" method="POST">
                <?php echo $classificationList; ?>
                <label for="invMake">Make
                    <input name="invMake" id="invMake" type="text">
                </label>
                <label for="invModel">Model
                    <input name="invModel" id="invModel" type="text">
                </label>
                <label for="invDescription">Description
                    <textarea name="invDescription" id="invDescription" rows="4" cols="50"></textarea>
                </label>
                <label for="invImage">Image Path
                    <input name="invImage" id="invImage" type="text">
                </label>
                <label for="invThumbnail">Thumbnail Path
                    <input name="invThumbnail" id="invThumbnail" type="text">
                </label>
                <label for="invPrice">Price
                    <input name="invPrice" id="invPrice" type="text">
                </label>
                <label for="invStock">Stock
                    <input name="invStock" id="invStock" type="text">
                </label>
                <label for="invColor">Color
                    <input name="invColor" id="invColor" type="text">
                </label>

                <button type="submit">Add Vehicle</button>
                <input type="hidden" name="action" value="add-vehicle">
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>