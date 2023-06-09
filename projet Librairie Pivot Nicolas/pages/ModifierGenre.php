<?php
require_once('bdd/connect.php');

if (isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['genre']) && !empty($_POST['genre'])
    && isset($_POST['description']) && !empty($_POST['description']))
{
    $id = strip_tags($_GET['id']);
    $genre = strip_tags($_POST['genre']);
    $description = strip_tags($_POST['description']);

    $sql = "UPDATE `genres` SET `genre`=:genre, `description`=:description WHERE `id`=:id;";

    $query = $db->prepare($sql);
    $query->bindValue(':id', $id);
    $query->bindValue(':genre', $genre);
    $query->bindValue(':description', $description);
    $query->execute();

    $cible = $_POST['id'];

    header("Location: index.php?page=DetailGenre&id=".$cible."");
}

if (isset($_GET['id']) && !empty($_GET['id'])) 
{
    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM `genres` WHERE id=:id';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id);
    $query->execute();
    $genre = $query->fetch();
}

require_once('bdd/close.php');
?>

<form method="post" action="">    
    <label for="genre">nom du genre :</label>
    <input type="text" name="genre" id="genre" value="<?= $genre['genre'] ?>" required>
    <br>
    <label for="description">description du genre :</label>
    <input type="text" name="description" id="description" required>
    <br>
    <input type="hidden" name="id" id="id" value="<?= $genre['id'] ?>" required>
    <input type="submit" value="enregistrer">
</form>