<!DOCTYPE html>
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
            <?php //require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php'; 
            echo $navList; ?>
        </nav>
        <main>
            <h1>Add Classification</h1>
            <p>Contain a form for adding a new classification (you will only need to add the name, the id in the table is auto-incrementing).
The form must send all data to the vehicles controller for checking and insertion to the database.
The view must have the means of displaying messages returned to it from the controller.
When the data is sent for insertion to the controller and if the insertion works, the vehicles controller should call itself using a header() function and pass no name - value pair. This should result in the "vehicle management" view being displayed and the new classification should appear as part of the navigation menu. Note: There will NOT be a success message. The classification item appearing in the navigation bar will be the indication of success. However, if it fails, then a clear failure message should be displayed in the add new classification view.</p>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>