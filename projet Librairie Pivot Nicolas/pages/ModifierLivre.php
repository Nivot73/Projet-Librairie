<?php
require_once('bdd/connect.php');

if (isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['titre']) && !empty($_POST['titre'])
    && isset($_POST['resume']) && !empty($_POST['resume'])
    && isset($_POST['idAuteur']) && !empty($_POST['idAuteur'])
    && isset($_POST['idGenre']) && !empty($_POST['idGenre'])
    && isset($_POST['dateParution']) && !empty($_POST['dateParution'])
    && isset($_POST['edition']) && !empty($_POST['edition'])
    && isset($_POST['langue']) && !empty($_POST['langue'])
    && isset($_POST['isbn']) && !empty($_POST['isbn'])
    && isset($_POST['stock']) && !empty($_POST['stock'])
    && isset($_POST['prix']) && !empty($_POST['prix'])) 
{
    $id = strip_tags($_GET['id']);
    $titre = strip_tags($_POST['titre']);
    $resume = strip_tags($_POST['resume']);
    $idAuteur = strip_tags($_POST['idAuteur']);
    $idGenre = strip_tags($_POST['idGenre']);
    $dateParution = strip_tags($_POST['dateParution']);
    $edition = strip_tags($_POST['edition']);
    $langue = strip_tags($_POST['langue']);
    $isbn = strip_tags($_POST['isbn']);
    $stock = strip_tags($_POST['stock']);
    $prix = strip_tags($_POST['prix']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        if ($_FILES['image']['size'] <= 10000000) {
  
          $infosfichier = pathinfo($_FILES['image']['name']);
          $extension_upload = $infosfichier['extension'];
          $extensions_autorisees = array('jpg','jpeg','gif','png','PNG');
  
          if (in_array($extension_upload, $extensions_autorisees)) {
  
            $filename = basename($_FILES['image']['name']);
  
            move_uploaded_file($_FILES['image']['tmp_name'],'images/' . $filename);
          }
        }
      }
      else {
        $filename = "aucune";
    }

    $sql = "UPDATE `livres` SET `image`=:filename, `titre`=:titre, `resume`=:resume, `idAuteur`=:idAuteur, `idGenre`=:idGenre, `dateParution`=:dateParution, `edition`=:edition, `langue`=:langue, `isbn`=:isbn, `prix`=:prix, `stock`=:stock WHERE `id`=:id;";

    $query = $db->prepare($sql);

    $query->bindValue(':id', $id);
    $query->bindValue(':filename', $filename);
    $query->bindValue(':titre', $titre);
    $query->bindValue(':resume', $resume);
    $query->bindValue(':idAuteur', $idAuteur);
    $query->bindValue(':idGenre', $idGenre);
    $query->bindValue(':dateParution', $dateParution);
    $query->bindValue(':edition', $edition);
    $query->bindValue(':langue', $langue);
    $query->bindValue(':isbn', $isbn);
    $query->bindValue(':stock', $stock);
    $query->bindValue(':prix', $prix);
    
    $query->execute();

    $cible = $_POST['id'];

    header("Location: index.php?page=DetailLivre&id=".$cible."");
}


if (isset($_GET['id']) && !empty($_GET['id'])) 
{
    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM `livres` WHERE id=:id';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id);
    $query->execute();
    $livre = $query->fetch();

    $sql = 'SELECT * FROM `auteurs` ';
    $query = $db->prepare($sql);
    $query->execute();
    $listAuteur = $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'SELECT * FROM `genres` ';
    $query = $db->prepare($sql);
    $query->execute();
    $listGenre = $query->fetchAll(PDO::FETCH_ASSOC);
}

require_once('bdd/close.php');
?>

<form method="post" action="" enctype="multipart/form-data">
    
<label for="image">Ajouter une image (attention, il est nécessaire de la chercher à nouveau)</label>
<input type="file" name="image" id="image">
<br>
<label for="titre">titre :</label>
<input type="text" name="titre" id="titre" value="<?= $livre['titre'] ?>" required>
<br>
<label for="resume">resume :</label>
<textarea type="text" name="resume" id="resume" required><?= $livre['resume'] ?></textarea>
<br>
<label for="idAuteur">auteur :</label>
<select name="idAuteur" id="idAuteur">
<?php
    foreach ($listAuteur as $auteur) {

    if ($auteur['id'] == $livre['idAuteur']){
?>
    <option value="<?= $livre['idAuteur'] ?>"><?= $auteur['nom']." ".$auteur['prenom'] ?></option>
<?php }}
    foreach ($listAuteur as $auteur) {
?>
    <option value="<?= $auteur['id'] ?>"><?= $auteur['nom']." ".$auteur['prenom'] ?></option>
<?php } ?>
</select>
<br>
<label for="idGenre">genre :</label>
<select name="idGenre" id="idGenre">
<?php
    foreach ($listGenre as $genre) {

    if ($genre['id'] == $livre['idAuteur']){
?>
    <option value="<?= $livre['idGenre'] ?>"><?= $genre['genre'] ?></option>
<?php }}
    foreach ($listGenre as $genre) {
?>
    <option value="<?= $genre['id'] ?>"><?= $genre['genre'] ?></option>
<?php } ?>
</select>
<br>
<label for="dateParution">date de Parution :</label>
<input type="date" name="dateParution" id="dateParution" value="<?= $livre['dateParution'] ?>" required>
<br>
<label for="edition">edition :</label>
<input type="text" name="edition" id="edition" value="<?= $livre['edition'] ?>" required>
<br>
<label for="langue">langue :</label>
<input type="text" name="langue" id="langue" value="<?= $livre['langue'] ?>" required>
<br>
<label for="isbn">isbn :</label>
<input type="number" name="isbn" id="isbn" min="1" value="<?= $livre['isbn'] ?>" required>
<br>
<label for="stock">Stock :</label>
<input type="number" name="stock" id="stock" min="0" value="<?= $livre['stock'] ?>" required>
<br>
<label for="prix">Prix :</label>
<input type="number" name="prix" id="prix" min="0" step="0.1" value="<?= $livre['prix'] ?>" required>
<br>
<input type="hidden" name="id" id="id" value="<?= $livre['id'] ?>" required>

<input type="submit" value="enregistrer">

</form>

