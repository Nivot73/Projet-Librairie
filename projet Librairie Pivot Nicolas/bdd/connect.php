<?php

$databaseDNS    	= 'mysql:host=localhost;dbname=librairie';
$databaseUsername 	= 'root';
$databasePassword 	= '';



try {
    $db = new PDO($databaseDNS, $databaseUsername, $databasePassword);
} catch (PDOException $exception) {
    echo 'Erreur de connexion : ' . $exception->getMessage();
    die();
}

?>
