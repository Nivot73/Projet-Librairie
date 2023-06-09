<?php
require_once('bdd/connect.php');

$sql = 'SELECT * FROM `auteurs` ';
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('bdd/close.php');

$auteurExist = false;
?>

<p><a href="?page=AjouterAuteur">Ajouter un Auteur</a></p>

<table>
    <?php
    if (!empty($result)){
    foreach ($result as $auteur) {
    ?>
    <tr>
        <td><a href="?page=DetailAuteur&id=<?= $auteur['id'] ?>"><?= $auteur['nom']." ".$auteur['prenom'] ?></a></td>
    </tr>    
    <?php  }} else { ?>
        <tr><td>Aucun auteur n'existe</td></tr>
    <?php }  ?>    
</table>