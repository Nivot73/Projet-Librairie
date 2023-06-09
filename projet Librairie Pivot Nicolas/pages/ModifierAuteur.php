<?php
require_once('bdd/connect.php');

if (isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['prenom']) && !empty($_POST['prenom'])
    && isset($_POST['pays']) && !empty($_POST['pays'])
    && isset($_POST['status']) && !empty($_POST['status'])
    && isset($_POST['dateDeces']) && !empty($_POST['dateDeces']))
{
    $id = strip_tags($_GET['id']);
    $nom = strip_tags($_POST['nom']);
    $prenom = strip_tags($_POST['prenom']);
    $pays = strip_tags($_POST['pays']);
    $status = strip_tags($_POST['status']);
    $dateDeces = strip_tags($_POST['dateDeces']);

    $sql = "UPDATE `auteurs` SET `nom`=:nom, `prenom`=:prenom, `pays`=:pays, `status`=:status, `dateDeces`=:dateDeces WHERE `id`=:id;";

    $query = $db->prepare($sql);
    $query->bindValue(':id', $id);
    $query->bindValue(':nom', $nom);
    $query->bindValue(':prenom', $prenom);
    $query->bindValue(':pays', $pays);
    $query->bindValue(':status', $status);
    $query->bindValue(':dateDeces', $dateDeces);
    $query->execute();

    $cible = $_POST['id'];

    header("Location: index.php?page=DetailGenre&id=".$cible."");
}

if (isset($_GET['id']) && !empty($_GET['id'])) 
{
    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM `auteurs` WHERE id=:id';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id);
    $query->execute();
    $auteur = $query->fetch();
}

require_once('bdd/close.php');
?>

<form method="post" action="">
    <label for="nom">nom de l'auteur :</label>
    <input type="text" name="nom" id="nom" value="<?= $auteur['nom'] ?>" required>
    <br>
    <label for="prenom">prenom de l'auteur :</label>
    <input type="text" name="prenom" id="prenom" value="<?= $auteur['prenom'] ?>" required>
    <br>
    <label for="pays">pays de l'auteur :</label>
    <input type="text" name="pays" id="pays" value="<?= $auteur['pays'] ?>" required>
    <br>
    <label for="status">status de l'auteur :</label>
    <select name="status" id="status">
    <option value="<?= $auteur['status'] ?>"><?= $auteur['status'] ?></option>
    <option value="vivant">Vivant</option>
    <option value="mort">Mort</option>
    </select>
    <br>
    <label for="dateDeces">date de deces de l'auteur (si l'auteur est vivant, une date aléatoire peut etre choisi):</label>
    <input type="date" name="dateDeces" id="dateDeces" value="<?= $auteur['dateDeces'] ?>" required>
    <br>
    <input type="hidden" name="id" id="id" value="<?= $auteur['id'] ?>" required>
    <input type="submit" value="enregistrer">
</form>