<?php

$erreur = "";

if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['mdp']) && !empty($_POST['mdp']))
{
    $nom = "admin";
    $mdp = "admin";

    if($_POST['nom'] == $nom && $_POST['mdp'] == $mdp)
    {
        $_SESSION['connecter'] = true;

        header("location:index.php");

        exit();
    }
    else {
        $erreur = "IDENTIFIANT ou MOT DE PASSE erroné";
    }
}
else {
    session_destroy();
}