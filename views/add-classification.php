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
        <title>Add Classification | PHP Motors</title>
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
            <h1>Add Classification</h1>
            <?php if (isset($message)) {echo $message;} ?>
            <form action="/phpmotors/vehicles/index.php" method="POST">
                <span>The classification name cannot be more than 30 characters long.<br></span>
                <label for="classificationName">Classification Name
                    <input name="classificationName" id="classificationName" type="text" pattern="^.{1,30}$">
                </label>

                <button type="submit">Add Classification</button>
                <input type="hidden" name="action" value="add-classification">
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>