<?php
if (!(isset($_SESSION['loggedin']) && $_SESSION['clientData']['clientLevel'] > 1)) {
    header('Location: /phpmotors/');
    exit;
}
?><!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            echo "Delete $invInfo[invMake] $invInfo[invModel]";
            } elseif (isset($invMake) && isset($invModel)) {
        	    echo "Delete $invMake $invModel"; }?> | PHP Motors</title>
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
            	    echo "Delete $invInfo[invMake] $invInfo[invModel]";
            	} elseif (isset($invMake) && isset($invModel)) {
            	    echo "Delete $invMake $invModel";
            	} ?></h1>
            <?php if (isset($message)) {echo $message;} ?>
            <p>Confirm Vehicle Deletion. The delete is permanent.</p>
            <form action="/phpmotors/vehicles/index.php" method="POST">
                <label for="invMake">Make
                    <input name="invMake" id="invMake" type="text" <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?> readonly>
                </label>
                <label for="invModel">Model
                    <input name="invModel" id="invModel" type="text" <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> readonly>
                </label>
                <label for="invDescription">Description
                    <textarea name="invDescription" id="invDescription" rows="5" readonly><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; } ?></textarea>
                </label>

                <button type="submit">Delete Vehicle</button>
                <input type="hidden" name="action" value="deleteVehicle">
                <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){echo $invInfo['invId'];} ?>">
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>