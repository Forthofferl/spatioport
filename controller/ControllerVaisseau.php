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
        if (!is_null(myGet('id'))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $data = array("id" => myGet('id'));
        $t = ModelVaisseau::select($data);
        // Initialisation des variables pour la vue        
        $i = $t->id;
        $hidden_id = "<input type='hidden' name='id' value='$i' />"; //$t->id;
        $c = $t->conducteur;
        $d = $t->depart;
        $a = $t->arrivee;
        $p = $t->prix;
        $n = $t->nbplaces;
        $pagetitle = "Mise à jour d'un Vaisseau";
        $label = "Modifier";
        $submit = "Mise à jour";
        $act = "updated";
        $view = "create";
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

    case "updated":
        if (is_null(myGet('conducteur')) || is_null(myGet('depart')) || is_null(myGet('arrivee')) 
                || is_null(myGet('prix')) || is_null(myGet('nbplaces'))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $data = array(
            "id" => myGet("id"),
            "conducteur" => myGet("conducteur"),
            "depart" => myGet("depart"),
            "arrivee" => myGet("arrivee"),
            "prix" => myGet("prix"),
            "nbplaces" => myGet("nbplaces")
        );
        ModelVaisseau::update($data);
        // Initialisation des variables pour la vue
        $i = myGet('id');
        $tab_Vaisseaus = ModelVaisseau::selectAll();
        // Chargement de la vue
        $view = "updated";
        $pagetitle = "Liste des Vaisseaus";
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
      
        $nV = "";
        $p="";
        $c="";
      
        $submit = "Rechercher";
        $view = "search";
		$pagetitle="Recherche";
		break;
		
	case "searched";
		 // Initialisation des variables pour la vue        
		
		$data = array(
                "nomVaisseau" => $_POST['nomVaisseau'],
                "prix" => $_POST['prix'],
                );
        $t = ModelVaisseau::select($data);
        // Chargement de la vue
        if (is_null($t)) {
            $view = "error";
            $pagetitle = "Erreur";
        } else {

        }
        break;
	
	break;
		
}
require VIEW_PATH . "view.php";
