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

$sql = 'SELECT * FROM `genres` ';
$query = $db->prepare($sql);
$query->execute();
$listGenre = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('bdd/close.php');
?>

<?php
if(isset($_SESSION['connecter'])){ ?>
<p><a href="?page=AjouterLivre">Ajouter un Livre</a></p>
<?php } ?>

<table class="LivreList">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
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

            $auteurExist = false;
            $genreExist = false;

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
                    if($auteurExist == false)
                    {?>

                <td><a href="?page=DetailAuteur&id=1">Non existant</a></td>

                <?php   }
                ?>

                <td><?= $livre['prix'] ?> €</td>

                <?php
                foreach ($listGenre as $genre){
                    if($genre['id'] == $livre['idGenre']){
                        $genreExist = true;
                ?>

                <td><a href="?page=DetailGenre&id=<?= $livre['idGenre'] ?>"><?= $genre['genre'] ?></a></td>

                <?php }} 
                    if ( $genreExist == false )
                    { ?>
                <td><a href="?page=DetailGenre&id=1">Non existant</a></td>
                <?php } ?>
                
                <td><?= $livre['edition'] ?></td>
                <td><?= $livre['langue'] ?></td>
                <td><?= $livre['stock'] ?></td>
            </tr>
        <?php  }  ?>
    </tbody>
</table>