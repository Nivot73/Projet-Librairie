<?php
ob_start();

if(isset($_GET['page'])){
	$page = $_GET['page'] ;
} 
else { 
	$page = 'accueil';
}

switch($page) :

	case 'accueil' :
   		$title = "Accueil du site" ;
		include 'pages/accueil.php' ;
	break;
   
	case 'ListLivre' :
   		$title = "Liste des Livres" ;
		include 'pages/ListLivre.php' ;
	break;

	case 'ListAuteur' :
		$title = "Liste des Auteurs" ;
	 include 'pages/ListAuteur.php' ;
 	break;

	case 'ListGenre' :
		$title = "Liste des Genres" ;
	include 'pages/ListGenre.php' ;
 	break;

	case 'DetailLivre' :
		$title = "Detail du Livre" ;
	include 'pages/DetailLivre.php' ;
 	break;

	case 'DetailAuteur' :
		$title = "Detail de l'auteur" ;
	include 'pages/DetailAuteur.php' ;
 	break;

	case 'DetailGenre' :
		$title = "liste de livre" ;
	include 'pages/DetailGenre.php' ;
 	break;
	
	case 'AjouterLivre' :
		$title = "Creation d'une page Livre" ;
	include 'pages/AjouterLivre.php' ;
 	break;

	case 'AjouterAuteur' :
		$title = "Creation d'une page Auteur" ;
	include 'pages/AjouterAuteur.php' ;
 	break;

	 case 'AjouterGenre' :
		$title = "Creation d'une page Genre" ;
	include 'pages/AjouterGenre.php' ;
 	break;

	case 'SupprimerLivre' :
		$title = "Suppression d'un Livre" ;
	include 'pages/SupprimerLivre.php' ;
 	break;

	case 'SupprimerAuteur' :
		$title = "Suppression d'un Auteur" ;
	include 'pages/SupprimerAuteur.php' ;
 	break;

	case 'SupprimerGenre' :
		$title = "Suppression d'un Genre" ;
	include 'pages/SupprimerGenre.php' ;
 	break;

	case 'ModifierLivre' :
		$title = "Modification d'un Livre" ;
	include 'pages/ModifierLivre.php' ;
 	break;

	case 'ModifierGenre' :
		$title = "Modification d'un Genre" ;
	include 'pages/ModifierGenre.php' ;
 	break;

	case 'ModifierAuteur' :
		$title = "Modification d'un Auteur" ;
	include 'pages/ModifierAuteur.php' ;
 	break;

    default :
   		$title = "erreur page inexistante" ;
   		include 'pages/404.php' ; 
	break;

endswitch ;

$contenu = ob_get_clean() ;

include 'template/template.php' ;
?>