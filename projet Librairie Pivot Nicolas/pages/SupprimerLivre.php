<?php
require_once('bdd/connect.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = strip_tags($_GET['id']);

    $sql = "DELETE FROM livres WHERE id=:id";

    $query = $db->prepare($sql);
    $query->bindValue(':id', $id);
    $query->execute();

    header('Location: index.php?page=ListLivre');
}

require_once('bdd/close.php');
?>