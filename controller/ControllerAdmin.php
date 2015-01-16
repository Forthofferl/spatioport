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
		$messageErreur="Ce pseudo n'appartient à aucun utilisateur";
            break;
		}
		break;
	
	case "gestionU":
	
		if(estConnecte()&&estAdmin()){
		$view="recherche";
		$pagetitle="Gestion d'un utilisateur";
		
		}
		else{
		$view="error";
		$pagetitle="Erreur!";
		$messageErreur="Ce pseudo n'appartient à aucun utilisateur";
            break;
		}
		break;
		
	case "searchU":
	
		if(estConnecte()&&estAdmin()){
			if (!isset($_POST['pseudo'])) {
            $view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Ce pseudo n'appartient à aucun utilisateur";
            break;
			}
        
			$data=array("pseudo"=>$_POST['pseudo']);
			
			
			$u=ModelUtilisateur::selectWhere($data);
		
			if(count($u)==null){
			$view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Ce pseudo n'appartient à aucun utilisateur";
            break;
			}
			else{
			$view="gestionUtil";
			$controller="admin";
			$pagetitle="Informations sur le profil";
			}
		}
		else{
			$view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Vous devez être connecté en tant qu'administrateur pour accéder à cette partie du site!";
            break;
		}
	
	
	break;
		
}
require VIEW_PATH . "view.php";