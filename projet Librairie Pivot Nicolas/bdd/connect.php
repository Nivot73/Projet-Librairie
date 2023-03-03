<?php

$databaseDNS    	= 'mysql:host=localhost;dbname=librairie';
$databaseUsername 	= 'librairie_admin';
$databasePassword 	= 'librairie_password';



try {
    $db = new PDO($databaseDNS, $databaseUsername, $databasePassword);
} catch (PDOException $exception) {
    echo 'Erreur de connexion : ' . $exception->getMessage();
    die();
}

?>