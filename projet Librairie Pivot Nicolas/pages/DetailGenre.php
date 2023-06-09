<?php
require_once('bdd/connect.php');

$sql = 'SELECT * FROM `livres` ';
$query = $db->prepare($sql);
$query->execute();
$listLivre = $query->fetchAll(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM `auteurs` ';
$query = $db->prepare($sql);
$query->execute();
$listAuteur = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM `genres` WHERE `id`=:id';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $genre = $query->fetch();

    if (!$genre) {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}

require_once('bdd/close.php');
?>

<p>Description du genre : <?= $genre['description'] ?></p>

<?php
if ($genre['id'] != 1) {
?>

<?php
if(isset($_SESSION['connecter'])){ ?>

<p><a href="?page=ModifierGenre&id=<?= $genre['id'] ?>">Modifier le nom du genre</a> <a href="?page=SupprimerGenre&id=<?= $genre['id'] ?>">Supprimer</a></p>


<?php }} ?>

<h2>livre pour le genre : <?= $genre['genre'] ?></h2>

<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Prix</th>
            <th>Edition</th>
            <th>Langue</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($listLivre as $livre) {
            $auteurExist = false;
            if ($genre['id'] == $livre['idGenre']){
        ?>
            <tr>
                <td><a href="?page=DetailLivre&id=<?= $livre['id'] ?>"><?= $livre['titre'] ?></a></td>

                <?php 
                foreach ($listAuteur as $auteur) {

                if ($auteur['id'] == $livre['idAuteur']){
                    $auteurExist = true;
                    ?>
            
                    <td><a href="?page=DetailAuteur&id=<?= $livre['idAuteur'] ?>"><?= $auteur['nom']." ".$auteur['prenom'] ?></a></td>

                <?php }} 
                if ($auteurExist == false){ ?>

                    <td><a href="?page=DetailAuteur&id=1">Non Existant</a></td>

                <?php } ?>
                

                <td><?= $livre['prix'] ?> €</td>
                <td><?= $livre['edition'] ?></td>
                <td><?= $livre['langue'] ?></td>
                <td><?= $livre['stock'] ?></td>
            </tr>
        <?php }}  ?>
    </tbody>
</table>