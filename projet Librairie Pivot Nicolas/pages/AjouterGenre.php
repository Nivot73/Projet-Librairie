<?php

if(!isset($_SESSION['connecter'])){
    header('Location: index.php');
    exit();
}

require_once('bdd/connect.php');

if (isset($_POST['genre']) && !empty($_POST['genre'])
    && isset($_POST['description']) && !empty($_POST['description']))
{
    $genre = strip_tags($_POST['genre']);
    $description = strip_tags($_POST['description']);

    $sql = "INSERT INTO genres (`genre`,`description`) VALUES (:genre, :description)";

    $query = $db->prepare($sql);
    $query->bindValue(':genre', $genre);
    $query->bindValue(':description', $description);
    $query->execute();

    header('Location: index.php?page=ListGenre');
    exit();
}

require_once('bdd/close.php');
?>

<form method="post" action="">
    <label for="genre">nom du genre :</label>
    <input type="text" name="genre" id="genre" required>
    <br>
    <label for="description">description du genre :</label>
    <input type="text" name="description" id="description" required>
    <br>
    <input type="submit" value="enregistrer">
</form>