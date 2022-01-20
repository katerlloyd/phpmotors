<?php
    // Proxy connection to the phpmotors database
    function phpmotorsConnect(){
        $server = 'localhost';
        $dbname= 'phpmotors';
        $username = 'iClient';
        $password = 'rjlSn0Ow2LMGR(P4'; 
        $dsn = "mysql:host=$server;dbname=$dbname";
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            $link = new PDO($dsn, $username, $password, $options);
            return $link;
        } catch(PDOException $e) {
            // echo 'Connection failed' . $e->getMessage();
            header('Location: /phpmotors/views/500.php');
            exit;
        }
    }
?>