<!DOCTYPE html>
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
            <?php if (isset($message)) {echo $message;} ?>
            <?php if (isset($vehicleDisplay)) { echo $vehicleDisplay; } ?>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>