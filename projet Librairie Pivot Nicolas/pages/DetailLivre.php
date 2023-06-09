<?php
require_once('bdd/connect.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM `livres` WHERE `id`=:id';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $livre = $query->fetch();

    if (!$livre) {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}
    $id =   $livre['idAuteur'];
    $sql = 'SELECT * FROM `auteurs` WHERE `id`=:id';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $auteur = $query->fetch();

    $id =   $livre['idGenre'];
    $sql = 'SELECT * FROM `genres` WHERE `id`=:id';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $genre = $query->fetch();

require_once('bdd/close.php');
?>
<p><?php if (!empty($livre['image'])) { echo "<img src='images/".$livre['image']."'>"; } ?></p>
<p>Titre du livre : <?= $livre['titre'] ?></p>
<p>Synopsis : <?= $livre['resume'] ?></p>
<?php
if(empty($auteur['nom'])){
?>
<p>Auteur : <a href="?page=DetailAuteur&id=1"> Non Existant </a></p>
<?php } else { ?>
<p>Auteur : <a href="?page=DetailAuteur&id=<?= $auteur['id'] ?>"><?= $auteur['nom'] ?> <?= $auteur['prenom'] ?></a></p>
<?php } 
if(empty($genre['genre'])){
?>
<p>Genre : <a href="?page=DetailGenre&id=1"> Non Existant </a></p>
<?php } else { ?>
<p>Genre : <a href="?page=DetailGenre&id=<?= $genre['id'] ?>"><?= $genre['genre'] ?></a></p>
<?php } ?>
<p>Date de parution : <?= $livre['dateParution'] ?></p>
<p>Edition : <?= $livre['edition'] ?></p>
<p>Langue : <?= $livre['langue'] ?></p>
<p>ISBN : <?= $livre['isbn'] ?></p>
<p>Stock : <?= $livre['stock'] ?></p>
<p>Prix : <?= $livre['prix'] ?> €</p>
<p><a href="?page=ModifierLivre&id=<?= $livre['id'] ?>">Modifier</a> <a href="?page=SupprimerLivre&id=<?= $livre['id'] ?>">Supprimer</a></p>