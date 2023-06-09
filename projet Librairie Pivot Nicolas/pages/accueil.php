<?php

?>
<h2>Bienvenue sur le site de la biblioteque de Moncus-dans-les-bois.</h2>

<h3>Explication du fonctionnnement</h3>
<p>---------------</p>
<p>Depuis la navBar, vous avez accès à 3 listes : les livres, les auteurs et les genres.</p>
<p>Depuis ces listes, vous pourrez choisir d'acceder à la page de détail d'un des éléments.</p>
<p>Les pages détails des auteurs et genres disposent d'une liste de livre qui repondent à ce critere</p>
<p>Vous pouvez naviguez entre les different éléments en suivant les liens qui sont dans les pages.</p>
<p>Vous pourrez ajouter de nouveau livre/auteur/genre depuis la liste correspondante.</p>
<p>Lorsque vous validerez un ajout, celui-ci sera fait automatiquement à la BDD.</p>
<p>---------------</p>

<h3>BDD</h3>
<p>---------------</p>
<p>Dans le dossier BDD, modifier le fichier connect.php pour acceder a la BDD desiré.</p>
<p>Dans la BDD, les tables "genres" "auteurs" et "livres" doivent exister.</p>
<p>auteurs doit avoir 6 colomnes : id, nom, prenom, pays, status, dateDeces.</p>
<p>genres doit avoir 3 colomnes : id, genre, description.</p>
<p>livres doit avoir 12 columnes : id, titre, idAuteur, resume, prix, dateParution, idGenre, edition, langue, image, isbn, stock.</p>
<p>les idAuteur et idGenre de la table livres sont ce qui fait le lien entre les 3 tables.</p>
<p>auteurs et genres auront une valeur default qui aura comme id 1. Cet ID ne devra pas etre effacé, elle est utilisé comme securité pour eviter les trou.</p>
<p>Lorsque vous créer ou modifier un livre, vous ne pourrez entrer comme valeur qu'un auteur et un genre qui existe déjà dans la BDD.</p>
<p>Si un livre possede un genre ou auteur qui n'existe plus (car celui-ci  a été efface de la BDD), le code attribura la valeur default correspondant.</p>
<p>---------------</p>