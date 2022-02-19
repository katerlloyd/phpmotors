<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login | PHP Motors</title>
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
            <h1>Login</h1>
            <?php if (isset($message)) {echo $message;} ?>
            <form action="/phpmotors/accounts/index.php" method="POST">
                <label for="clientEmail">Email
                    <input name="clientEmail" id="clientEmail" type="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
                </label>

                <label for="clientPassword">Password
                    <input name="clientPassword" id="clientPassword" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                </label>

                <span id="password-notice">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</span>

                <button type="submit">Login</button>
                <!-- <input type="submit" name="submit" value="Login"> -->
                <input type="hidden" name="action" value="Login">
                <a href="/phpmotors/accounts?action=register-page">Need to create an account?</a>
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>