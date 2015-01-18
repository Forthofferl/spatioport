<?php

require_once('config.inc.php');
$controller="admin";
// On va chercher le modele dans "./model/ModelUtilisateur.php"
require_once MODEL_PATH . 'ModelUtilisateur.php';
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'ModelVaisseau.php';


switch ($action) {
	case "accueil":
		$view="accueil";
		$pagetitle="Accueil";
	break;
	
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
			$_SESSION['pseudoUtil']=$u[0]->pseudo;
			$_SESSION['idUtil']=$u[0]->idUtilisateur;
			}
		}
		else{
			$view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Vous devez être connecté en tant qu'administrateur pour accéder à cette partie du site!";
            
		}
	
	
	break;
	
	case "update":
	if(estConnecte()&&estAdmin()){
        
        $data = array("pseudo" => $_SESSION['pseudoUtil']);
        $u = ModelUtilisateur::selectWhere($data);
        // Initialisation des variables pour la vue
		
		$ps=$u[0]->pseudo;
        $a = $u[0]->age;
        $n = $u[0]->nom;
        $p = $u[0]->prenom;
        $e = $u[0]->email;
		$t = $u[0]->numtel;
		$adr = $u[0]->adr;
        $pagetitle = "Mise à jour d'un utilisateur";
        $label = "Modifier";
        $pseudo_status = "readonly";
        $submit = "Mise à jour";
        $act = "updated";
        $view = "update";
		
	}
	else{
	$view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Vous devez être connecté en tant qu'administrateur pour pouvoir accéder à cette partie.";
            
	}
    break;
		
	case "updated":
        if (is_null($_POST['pseudo'] || is_null($_POST['prenom']) || is_null($_POST['nom']) 
                || is_null($_POST['age']) || is_null($_POST['adr']) || is_null($_POST['pwd']) || is_null($_POST['email']) || is_null($_POST['numtel']))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        
		$data = array(
            "pseudo" => $_SESSION['pseudoUtil'],
            "nom" => $_POST["nom"],
            "prenom" => $_POST["prenom"],
            "email" => $_POST["email"],
			"adr" => $_POST["adr"],
			"age" => $_POST["age"],
			"numtel" => $_POST["numtel"],
            "pwd" => hash('sha256',$_POST["pwd"] . Conf::getSeed())
        );
		if($_POST['admin']=="Oui"){
         $data["admin"]=1;
		}
		elseif($_POST['admin']=="Non"){
			$data["admin"]=0;
		}
		
        ModelUtilisateur::updateUtilAdmin($data);
        // Initialisation des variables pour la vue
        $pseudo = $_POST['pseudo'];
        
        // Chargement de la vue
        $view = "updated";
        $pagetitle = "Mise à jour";
        break;
		case "delete":
            if(estConnecte()&&estAdmin()){
                $view="delete";
                $pagetitle="Confirmation suppression de votre compte";
            }
            else{
              $view="error";
			  $pagetitle="Erreur";
			  $messageErreur="Vous devez être connecté en tant qu'administrateur pour pouvoir accéder à cette partie.";
            }
        break;

        case "deleted":
            if(estConnecte()&&estAdmin()){
              $data = array(
                "idUtilisateur" => $_SESSION["idUtil"],
              );
              ModelUtilisateur::suppression($data);
              $dataWaiting = array(
                "idUtilisateur" => $_SESSION["idUtil"]
              );
              $attente = ModelUtilisateur::selectWhere($dataWaiting);
              if($attente != null) { // on est en recherche d'un adversaire ?
                $dataDel = array(
                  "idUtilisateur" => $_SESSION["idUtil"]
                );
                ModelUtilisateur::suppressionWhere($dataDel);
              }
              
              $view="deleted";
              $pagetitle="Profil supprimé !";
              }
            else{
              $view="error";
			  $pagetitle="Erreur";
			  $messageErreur="Vous devez être connecté en tant qu'administrateur pour pouvoir accéder à cette partie.";
            }
        break;
		
		
	/*case "gestionU":
	
		if(estConnecte()&&estAdmin()){
		$view="search";
		$pagetitle="Gestion d'un vaisseau";
		
		}
		else{
		$view="error";
		$pagetitle="Erreur!";
		$messageErreur="Vous devez être connecté en tant qu'administrateur pour pouvoir accéder à cette partie du site!";
            break;
		}
		break;
		
	case "searchV":
	
		if(estConnecte()&&estAdmin()){
			if (!isset($_POST['nomVaisseau'])) {
            $view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Ce pseudo n'appartient à aucun utilisateur";
            break;
			}
        
			$data=array("nomVaisseau"=>$_POST['nomVaisseau']);
			
			
			$u=ModelVaisseau::selectWhere($data);
			
			
			if(count($u)==null){
			$view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Ce nom n'appartient à aucun vaisseau";
            break;
			}
			else{
			$view="gestionVais";
			$controller="admin";
			$pagetitle="Informations sur le profil";
			$_SESSION['pseudoVais']=$u[0]->nomVaisseau;
			$_SESSION['idVais']=$u[0]->idVaisseau;
			}
		}
		else{
			$view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Vous devez être connecté en tant qu'administrateur pour accéder à cette partie du site!";
            
		}
	
	
	break;*/
	
	case"createV":
	
	

}
require VIEW_PATH . "view.php";