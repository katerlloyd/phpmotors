<div class="top">
    <img src="/phpmotors/images/site/logo.png" alt="PHP Motors logo" id="logo">
    <div class="text">
        <?php 
        if (isset($_SESSION['loggedin'])) {
            if (isset($_SESSION['clientData']['clientFirstname'])) { 
                $name = $_SESSION['clientData']['clientFirstname'];
                echo "<a href='/phpmotors/accounts/' id='welcome'>Welcome $name</a> | <a href='/phpmotors/accounts?action=Logout' id='logout'>Logout</a>";
            }
        } else {
            echo "<a href='/phpmotors/accounts?action=login' title='Login or Register with PHP Motors' id='account'>My Account</a>";
        }
        ?>
    </div>
</div>