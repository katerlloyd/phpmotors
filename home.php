<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP Motors</title>
        <link rel="stylesheet" href="/phpmotors/css/styles.css" type="text/css" media="screen">
    </head>
    <body>
        <header>
           <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>
        <nav>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php'; ?>
        </nav>
        <main>
            <h1>Welcome to PHP Motors!</h1>
            <div id="dmc">
                <section id="dmc-text">
                    <h2>DMC Delorean</h2>
                    <p>3 Cup holders</p>
                    <p>Superman doors</p>
                    <p>Fuzzy dice!</p>
                </section>
                <picture>
                    <img src="/phpmotors/images/delorean.jpg" alt="Delorean car" id="delorean">
                </picture>
                <input type="image" src="/phpmotors/images/site/own_today.png" alt="Own today button" id="own">
            </div>
            <div id="parts-grid">
            <section>
                    <h2>DMC Delorean Reviews</h2>
                    <ul>
                        <li>"So fast its almost like traveling in time." [4/5]</li>
                        <li>"Coolest ride on the road." [4/5]</li>
                        <li>"I'm feeling Marty McFly!" [5/5]</li>
                        <li>"The most futuristic ride of our day." [4.5/5]</li>
                        <li>"80's livin and I love it!" [5/5]</li>
                    </ul>
                </section>
                <section id="upgrades">
                    <h2>Delorean Upgrades</h2>
                    <div id="upgrades-grid">
                        <picture>
                            <img src="/phpmotors/images/upgrades/flux-cap.png" alt="Flux capacitor">
                        </picture>
                        <picture>
                            <img src="/phpmotors/images/upgrades/flame.jpg" alt="Flame decals">
                        </picture>
                        <a href="#">Flux Capacitor</a>
                        <a href="#">Flame Decals</a>
                        <picture>
                            <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper sticker">
                        </picture>
                        <picture>
                            <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Hub cap">
                        </picture>
                        <a href="#">Bumper Stickers</a>
                        <a href="#">Hub Caps</a>
                    </div>
                </section>
            </div>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>