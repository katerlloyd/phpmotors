<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpmotors/');
} else {
    $clientData = $_SESSION['clientData'];
    $info = "<h1>$clientData[clientFirstname] $clientData[clientLastname]</h1>";
    if (isset($_SESSION['message'])) { $info .= $_SESSION['message']; }
    $info .= '<p>You are logged in.</p>';
    $info .= '<ul>';
    $info .= "<li><strong>First Name:</strong> $clientData[clientFirstname]</li>";
    $info .= "<li><strong>Last Name:</strong> $clientData[clientLastname]</li>";
    $info .= "<li><strong>Email:</strong> $clientData[clientEmail]</li>";
    $info .= '</ul>';

    $info .= "<h2>Account Management</h2>";
    $info .= "<p>Update your account information <a href='/phpmotors/accounts?action=mod'>here</a>.</p>";

    if ($_SESSION['clientData']['clientLevel'] > 1) {
        $info .= "<h2>Inventory Management</h2>";
        $info .= "<p>Manage your vehicle inventory <a href='/phpmotors/vehicles/'>here</a>.</p>";
    }

    $info .= "<h2>Your Reviews</h2>";
    $info .= "<noscript><p class='notice'><strong>JavaScript Must Be Enabled to Use this Feature.</strong></p></noscript>";
    $info .= "<table id='reviewListDisplay'></table>";
}
?><!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | PHP Motors</title>
        <link rel="stylesheet" href="/phpmotors/css/styles.css" type="text/css" media="screen">
        <script defer src="../js/reviews.js"></script>
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
<?php unset($_SESSION['message']); ?>