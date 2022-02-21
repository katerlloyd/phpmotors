<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpmotors/');
} else {
    $clientData = $_SESSION['clientData'];
    $info = "<h1>$clientData[clientFirstname] $clientData[clientLastname]</h1>";
    $info .= '<p>You are logged in.</p>';
    $info .= '<ul>';
    $info .= "<li><strong>First Name:</strong> $clientData[clientFirstname]</li>";
    $info .= "<li><strong>Last Name:</strong> $clientData[clientLastname]</li>";
    $info .= "<li><strong>Email:</strong> $clientData[clientEmail]</li>";
    $info .= '</ul>';

    if ($_SESSION['clientData']['clientLevel'] > 1) {
        $info .= "<p>Here is the <a href='/phpmotors/vehicles/'>Vehicle Management</a> page.</p>";
    }
}
?><!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | PHP Motors</title>
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
            <?php echo $info; ?>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>