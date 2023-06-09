<?php

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?= $title ?></title>
</head>
<body>  
<header>
    <h1>Biblioteque de Moncus-dans-les-bois</h1>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="?page=ListLivre">Liste des Livres</a>
        <a href="?page=ListAuteur">Liste des Auteurs</a>
        <a href="?page=ListGenre">Liste des genres</a>
        <?php
        if(isset($_SESSION['connecter'])){ ?>
        <a href="?page=deconnexion">Deconnexion</a>
        <?php }
        else{
        ?>
        <a href="?page=connexion">Connexion</a>
        <?php } ?>
    </nav>
</header>