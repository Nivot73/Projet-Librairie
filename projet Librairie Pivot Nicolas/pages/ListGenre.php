<?php

require_once('bdd/connect.php');

$sql = 'SELECT * FROM `genres` ';
$query = $db->prepare($sql);
$query->execute();
$listGenre = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('bdd/close.php');
?>

<p><a href="?page=AjouterGenre">Ajouter un Genre</a></p>

<table>
    <?php
    foreach ($listGenre as $genre) {
    ?>
        <tr>
            <td> <a href="?page=DetailGenre&id=<?= $genre['id'] ?>"><?= $genre['genre'] ?></a></td>
        </tr>
    <?php } ?>
</table>