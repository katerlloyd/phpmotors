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
            <p>Contain a form for adding a new vehicle to the inventory table. ( Hint: Check the inventory table in the phpmotors database for the fields that will be needed in the form. DO NOT have a form field for the invId field as it is the primary key and is auto-incrementing in the database table).
When indicating the classification the vehicle belongs to, the classification must use the "select" element's drop-down list that should have been pre-built in the controller.
When adding images use the path to the "No Image Available" image that you downloaded and stored in this enhancement. (Hint: this could be hard coded into the form to happen automatically for now)
The view must have the means of displaying messages returned to it from the controller.
The form must send all data to the vehicles controller for checking and insertion to the database.
If the new vehicle is added successfully, a message to that affect must be displayed in the "add new vehicle" view.</p>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>