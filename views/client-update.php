<?php
if (!(isset($_SESSION['loggedin']))) {
    header('Location: /phpmotors/');
    exit;
}
?><!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account Management | PHP Motors</title>
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
            <h1>Account Management</h1>
            <?php if (isset($_SESSION['message'])) { echo $_SESSION['message']; } ?>
            <h2>Update Account</h2>
            <form action="/phpmotors/accounts/index.php" method="POST">
                <label for="clientFirstname">First Name
                    <input name="clientFirstname" id="clientFirstname" type="text" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($clientInfo['clientFirstname'])) {echo "value='$clientInfo[clientFirstname]'";} ?> required>
                </label>
                <label for="clientLastname">Last Name
                    <input name="clientLastname" id="clientLastname" type="text" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($clientInfo['clientLastname'])) {echo "value='$clientInfo[clientLastname]'";} ?> required>
                </label>
                <label for="clientEmail">Email
	                <input name="clientEmail" id="clientEmail" type="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($clientInfo['clientEmail'])) {echo "value='$clientInfo[clientEmail]'";} ?> required>
	            </label>

                <button type="submit">Update Info</button>
                <input type="hidden" name="action" value="updateAccount">
                <input type="hidden" name="clientId" value="<?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];}
                elseif(isset($clientId)){ echo $clientId; } ?>">
            </form>
            <?php if (isset($_SESSION['message'])) { echo $_SESSION['message']; } ?>
            <h2>Change Password</h2>
            <form action="/phpmotors/accounts/index.php" method="POST">
                <span id="password-notice">Passwords must be at least 8 characters and contain at least 1 number, 1 uppercase letter, 1 lowercase letter, and 1 special character.</span><br>
                <br><p><strong>Note</strong>: Your original password will be changed.</p><br>

                <label for="clientPassword">New Password
                    <input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                </label>

                <button type="submit">Update Password</button>
                <input type="hidden" name="action" value="updatePassword">
                <input type="hidden" name="clientId" value="<?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];}
                elseif(isset($clientId)){ echo $clientId; } ?>">
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>