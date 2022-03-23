<?php
if (!(isset($_SESSION['loggedin']) || !$_SESSION['clientData']['clientLevel'] > 1)) {
    header('Location: /phpmotors/');
    exit;
}
if (isset($_SESSION['message'])) {
	$message = $_SESSION['message'];
}
?><!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vehicle Management | PHP Motors</title>
        <link rel="stylesheet" href="/phpmotors/css/styles.css" type="text/css" media="screen">
        <script defer src="../js/inventory.js"></script>
    </head>
    <body>
        <header>
           <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>
        <nav>
            <?php echo $navList; ?>
        </nav>
        <main>
            <h1>Vehicle Management</h1>
            <ul>
                <li><a href="/phpmotors/vehicles?action=add-classification-page" title="Add a classification">Add Classification</a></li>
                <li><a href="/phpmotors/vehicles?action=add-vehicle-page" title="Add a vehicle">Add Vehicle</a></li>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                if (isset($classificationList)) {
	                 echo '<h2>Vehicles By Classification</h2>';
	                 echo '<p>Choose a classification to see those vehicles: </p>';
	                 echo $classificationList;
                }
                ?>
                <noscript>
                    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                </noscript>
                <table id="inventoryDisplay"></table>
            </ul>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>
<?php unset($_SESSION['message']); ?>