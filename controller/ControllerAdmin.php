<?php

require_once('config.inc.php');
$controller="admin";
// On va chercher le modele dans "./model/ModelUtilisateur.php"
require_once MODEL_PATH . 'ModelUtilisateur.php';
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'ModelVaisseau.php';


switch ($action) {

	case "gestion":
		if(estConnecte()&&estAdmin()){
		
		$view="gestion";
		$pagetitle="Gestion de l'administration";
		}
		else{
		$view="error";
		$pagetitle="Erreur!";	
		}
		break;
	
	case "search":
	
		if(estConnecte()&&estAdmin()){
		$view="Recherche";
		$pagetitle="Gestion d'un utilisateur";
		$pseudo="";
		}
		else{
		$view="error";
		$pagetitle="Erreur!";
		$messageErreur="Erreur lors du chargement de la page";
		}
	break;
		
}
require VIEW_PATH . "view.php";