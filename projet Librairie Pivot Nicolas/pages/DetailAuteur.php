<?php
require_once('bdd/connect.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM `auteurs` WHERE `id`=:id';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $auteur = $query->fetch();

    if (!$auteur) {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}

$sql = 'SELECT * FROM `livres` ';
$query = $db->prepare($sql);
$query->execute();
$listLivre = $query->fetchAll(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM `genres` ';
$query = $db->prepare($sql);
$query->execute();
$listGenre = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('bdd/close.php');

$aPublie = false;

if($auteur['id'] == 1){
?>

<p>Cette page est réservé au livre n'ayant pas d'auteur.</p>

<?php } else {?>

<p>Nom de l'auteur : <?= $auteur['nom'] ?></p>
<p>Prenom de l'auteur : <?= $auteur['prenom'] ?></p>
<p>Pays : <?= $auteur['pays'] ?></p>
<p>Status : <?= $auteur['status'] ?></p>
<?php
if ($auteur['status'] == "mort"){
?>
<p>Date de deces : <?= $auteur['dateDeces'] ?></p>
<?php } ?>

<?php
if(isset($_SESSION['connecter'])){ ?>

<p><a href="?page=ModifierAuteur&id=<?= $auteur['id'] ?>">Modifier</a> <a href="?page=SupprimerAuteur&id=<?= $auteur['id'] ?>">Supprimer</a></p>

<?php }} ?>

<p>Liste des livres de l'auteur :</p>

<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Prix</th>
            <th>Genre</th>
            <th>Edition</th>
            <th>Langue</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($listLivre as $livre) {
            if ($livre['idAuteur'] == $auteur['id']){
                $genreExist = false;
                $aPublie = true;
        ?>
            <tr>
                <td><a href="?page=DetailLivre&id=<?= $livre['id'] ?>"><?= $livre['titre'] ?></a></td>
                <td><?= $livre['prix'] ?> €</td>

                <?php
                foreach ($listGenre as $genre){
                    if($genre['id'] == $livre['idGenre']){
                        $genreExist = true;
                ?>

                <td><a href="?page=DetailGenre&id=<?= $livre['idGenre'] ?>"><?= $genre['genre'] ?></a></td>

                <?php }} 
                if ($genreExist == false){ ?>

                    <td><a href="?page=DetailGenre&id=1">Non Existant</a></td>

                <?php } ?>

                <td><?= $livre['edition'] ?></td>
                <td><?= $livre['langue'] ?></td>
                <td><?= $livre['stock'] ?></td>
            </tr>
        <?php  }}  
        if ($aPublie == false){
        ?>
            <tr>
            <td colspan=6>
                Nous n'avons pas de livre de cet auteur.
            </td>
            </tr>
        <?php 
        }
        ?>
    </tbody>
</table>