<?php

require_once('config.inc.php');
$controller="Vaisseau";
// On va chercher le modele dans "./model/ModelVaisseau.php"
require_once MODEL_PATH . 'Model' . ucfirst($controller) . '.php';
require_once MODEL_PATH . 'Model.php';

switch ($action) {
    case "read":
        if (!is_null(myGet('id'))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        // Initialisation des variables pour la vue        
        $data = array("id" => myGet('id'));
        $t = ModelVaisseau::select($data);
        // Chargement de la vue
        if (is_null($t)) {
            $view = "error";
            $pagetitle = "Erreur";
        } else {
            $view = "find";
            $pagetitle = "Détail d'un ";
        }
        break;

    case "readAllUtilisateurs":
        require_once MODEL_PATH . 'ModelUtilisateur.php';
        if (!is_null(myGet('id'))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        // Initialisation des variables pour la vue        
        $data = array("id" => myGet('id'));
        $tab_util = ModelVaisseau::findUtilisateurs($data);
        $id = myGet('id');
        $t = ModelVaisseau::select($data);
        $data2 = array ("login" => $t->conducteur);
        $u = ModelUtilisateur::select($data2);
        $view = "ListUtilisateurs";
        $pagetitle = "Liste des utilisateurs d'un Vaisseau";
        break;
        
    case "deleteUtilisateur":
        require_once MODEL_PATH . 'ModelUtilisateur.php';
        if (!(is_null(myGet('id')) || is_null(myGet('login')))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $id = myGet('id');
        $login = myGet('login');        
        $data = array("id" => $id, "login" => $login);
        ModelVaisseau::deletePassager($data);
        
        $data = array("id" => $id);
        $tab_util = ModelVaisseau::findUtilisateurs($data);        
        $t = ModelVaisseau::select($data);
        $data2 = array ("login" => $t->conducteur);
        $u = ModelUtilisateur::select($data2);
        $view = "DeleteUtilisateurs";
        $pagetitle = "Liste des utilisateurs d'un Vaisseau";
        break;
        
    case "update":
	if(estConnecte()&&estAdmin()){
        
        $data = array("nomVaisseau" => $_SESSION['nomVaisseau']);
        $u = ModelVaisseau::selectWhere($data);
        // Initialisation des variables pour la vue
			
			$_SESSION['idVais']=$u[0]->idVaisseau;
			$v = $u[0]->nomVaisseau;
			$d = $u[0]->descripVaisseau;
			$p = $u[0]->prixVaisseau;
			$n = $u[0]->nbrEnStock;
			$_SESSION['categorie']=$u[0]->categorie;
			$label = "Mise à jour d'";
			$pagetitle = "Mis à jour d'un Vaisseau";
			$submit = "Mettre à jour";
			$pseudo_status = "readonly";
			$act = "updated";
			$view = "create";
		
		
	}
	else{
	$view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Vous devez être connecté en tant qu'administrateur pour pouvoir accéder à cette partie.";
            
	}
    break;
		
	case "updated":
        if (!(is_null(myGet('nomVaisseau')) || is_null(myGet('prixVaisseau')) || is_null(myGet('nbrEnStock')) || is_null(myGet('categorie')) 
                || is_null(myGet('descripVaisseau')))) {
			$view = "error";
            $pagetitle = "Erreur";
            break;
        }
        
		if(estConnecte()&&estAdmin()){
        $data = array(
            "nomVaisseau" => myGet("nomVaisseau"),
            "prixVaisseau" => myGet("prix"),
			"categorie" => myGet("categorie"),
            "nbrEnStock" => myGet("nbrStock"),
            "descripVaisseau" => myGet("description")
			
        );
		
		$_SESSION['categorie']=$_POST['categorie'];
        ModelVaisseau::updateVaisAdmin($data);
        // Initialisation des variables pour la vue
        $nom = myGet('nomVaisseau');
        
        // Chargement de la vue
        $view = "updated";
        $pagetitle = "Mise à jour";
		}
		else{
              $view="error";
			  $pagetitle="Erreur";
			  $messageErreur="Vous devez être connecté en tant qu'administrateur pour pouvoir accéder à cette partie.";
            }
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


    case "create":
		if(estConnecte()&&estAdmin()){
			$hidden_id = "";
			$v = "";
			
			$d = "";
			$p = "";
			$n = "";
			$label = "Enregister";
			$pagetitle = "Création d'un Vaisseau";
			$submit = "Création";
			$act = "save";
			$view = "create";
		}
		else{
              $view="error";
			  $pagetitle="Erreur";
			  $messageErreur="Vous devez être connecté en tant qu'administrateur pour pouvoir accéder à cette partie.";
            }
        break;

    case "save":
        if (!(is_null(myGet('nomVaisseau')) || is_null(myGet('prixVaisseau')) || is_null(myGet('nbrEnStock')) || is_null(myGet('categorie')) 
                || is_null(myGet('descripVaisseau')))) {
            $view = "error";
            $pagetitle = "Erreur";
			$messageErreur = "L'un des champs est null";
            break;
        }
        $data = array(
            "nomVaisseau" => myGet("nomVaisseau"),
            "prixVaisseau" => myGet("prix"),
			"categorie" => myGet("categorie"),
            "nbrEnStock" => myGet("nbrStock"),
            "descripVaisseau" => myGet("description")
			
        );
		var_dump($data);
        ModelVaisseau::insert($data);
        // Initialisation des variables pour la vue
        $nom=$data['nomVaisseau'];
        // Chargement de la vue
        $view = "created";
        $pagetitle = "Ajout réussit";
        break;

    

    case "delete":
        if (!is_null(myGet('id'))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $data = array("id" => myGet('id'));
        $t = ModelVaisseau::delete($data);
        // Initialisation des variables pour la vue
        $i = myGet('id');
        $tab_Vaisseaus = ModelVaisseau::selectAll();
        // Chargement de la vue
        $view = "deleted";
        $pagetitle = "Liste des Vaisseaus";
        break;

    default:
    // Si l'action est inconnue, nous effectuerons 'readAll'

    case "readAll":
        // Initialisation des variables pour la vue
        $tab_Vaisseaus = ModelVaisseau::selectAll();
        // Chargement de la vue
        $view = "list";
        $pagetitle = "Liste des Vaisseaus";
        break;
		
	case "search":
		if(estConnecte()){
		$view = "search";
		$pagetitle="Recherche";
		}
		else{
              $view="error";
			  $pagetitle="Erreur";
			  $messageErreur="Vous devez être connecté pour pouvoir accéder à cette partie.";
            }
		break;

		
	case "searched":
 
        $data = array("nomVaisseau" => $_POST['nomVaisseau']);
		$_SESSION['nomVaisseau']=$_POST['nomVaisseau'];
        $u = ModelVaisseau::selectWhere($data);
        // Chargement de la vue
        if (is_null($u)) {
            $view = "error";
            $pagetitle = "Erreur";
        } else {
			if(estConnecte()&&estAdmin()){
            $view = "searchedA";
            $pagetitle = "Détail d'un vaisseau";
			break;
			}
			elseif(estConnecte()){
				$view="searchedU";
				$pagetitle="Détail d'un vaisseau";
			}	
			else{
				$view="error";
				$pagetitle="Erreur";
				$messageErreur="Vous devez être connecté pour pouvoir accéder à cette partie.";
            }
        }
       
		
        break;
	
	
		
}
require VIEW_PATH . "view.php";
