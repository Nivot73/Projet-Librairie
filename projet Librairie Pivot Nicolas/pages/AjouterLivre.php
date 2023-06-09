<?php

if(!isset($_SESSION['connecter'])){
  header('Location: index.php');
  exit();
}

require_once('bdd/connect.php');

if (isset($_POST)) {
    if (isset($_POST['titre']) && !empty($_POST['titre'])
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
          $imageTest = $filename;

          move_uploaded_file($_FILES['image']['tmp_name'],'images/' . $imageTest);
        }
      }
    }

    $sql = "INSERT INTO livres (`image`,`titre`,`resume`,`idAuteur`,`idGenre`,`dateParution`,`edition`,`langue`,`isbn`,`stock`,`prix`) VALUES (:imageTest, :titre, :resume, :idAuteur, :idGenre, :dateParution, :edition, :langue, :isbn, :stock, :prix)";

    $query = $db->prepare($sql);
    $query->bindValue(':imageTest', $imageTest);
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
    
    header('Location: index.php?page=ListLivre');
    exit();
  }
}

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
<h1>Ajouter un produit</h1>
<form action="" method="post" enctype="multipart/form-data">
  <label for="image">Ajouter une image</label>
  <input type="file" name="image" id="image">
  <br>
  <label for="titre">titre :</label>
  <input type="text" name="titre" id="titre" required>
  <br>
  <label for="resume">resume :</label>
  <textarea type="text" name="resume" id="resume" required></textarea>
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
  <input type="date" name="dateParution" id="dateParution" required>
  <br>
  <label for="edition">edition :</label>
  <input type="text" name="edition" id="edition" required>
  <br>
  <label for="langue">langue :</label>
  <input type="text" name="langue" id="langue" required>
  <br>
  <label for="isbn">isbn :</label>
  <input type="number" name="isbn" id="isbn" min="1" required>
  <br>
  <label for="stock">Stock :</label>
  <input type="number" name="stock" id="stock" min="0" required>
  <br>
  <label for="prix">Prix :</label>
  <input type="number" name="prix" id="prix" min="0" step="0.1" required>
  <br>
  <input type="submit" value="enregistrer">
</form>