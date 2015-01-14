<?php

require_once('config.inc.php');
$controller="Utilisateur";
// On va chercher le modele dans "./model/ModelUtilisateur.php"
require_once MODEL_PATH . 'Model' . ucfirst($controller) . '.php';

switch ($action) {
    case "read":
        if (!is_null(myGet('login'))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        // Initialisation des variables pour la vue        
        $data = array("login" => myGet('login'));
        $u = ModelUtilisateur::select($data);
        // Chargement de la vue
        if (is_null($u)) {
            $view = "error";
            $pagetitle = "Erreur";
        } else {
            $view = "find";
            $pagetitle = "Détail d'un utilisateur";
        }
        break;


    case "update":
        if (!is_null(myGet('login'))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $data = array("login" => myGet('login'));
        $u = ModelUtilisateur::select($data);
        // Initialisation des variables pour la vue        
        $l = $u->login;
        $n = $u->nom;
        $p = $u->prenom;
        $e = $u->email;
        $pagetitle = "Mise à jour d'un utilisateur";
        $label = "Modifier";
        $login_status = "readonly";
        $submit = "Mise à jour";
        $act = "updated";
        $view = "create";
        break;

    
		
	case "connect":
            if(!estConnecte()){
                $view="connexion";
                $pagetitle="Connexion";
				$submit = "Se connecter";
				$label = "Connexion";
                break;
            }
            else{
              header('Location: .');
            }
			
	case "connected":
		
		$_SESSION['pseudo']=myGet('pseudo');
			$_SESSION['pwd']=myGet('pwd');
			if ((is_null($_SESSION['pseudo']))&&(is_null($_SESSION['pwd']))){
				$view = "error";
				$pagetitle = "Erreur";
				break;
			}
			
		$data = array("pseudo" => $_SESSION['pseudo'],"pwd" => $_SESSION['pwd']);
		if(count(ModelUtilisateur::selectWhere($data))!=null){
			
			// Chargement de la vue
		
				$view = "connected";
				$pagetitle = "Connecté";
		}	
		else{
			$view = "error";
				$pagetitle = "Erreur";
				break;
		}
		
	case "created":
	
			$view="created";
			$pagetitle="Créer!";
			$ps=myget('pseudo');
			break;
			
    case "save":
        if (is_null(myGet('pseudo') || is_null(myGet('prenom')) || is_null(myGet('nom')) 
                || is_null(myGet('age')) || is_null(myGet('adr')) || is_null(myGet('pwd')) || is_null(myGet('pwd2')) || is_null(myGet('email')) || is_null(myGet('numtel')))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        if((myGet('mdp'))!=(myGet('mdp2'))){
            $view = "error";
            $pagetile ="Erreur";
            break;
        }
        $data = array(
            "pseudo" => myGet("pseudo"),
            "nom" => myGet("nom"),
            "prenom" => myGet("prenom"),
            "email" => myGet("email"),
			"adr" => myGet("adr"),
			"age" => myGet("age"),
			"numtel" => myGet("numtel"),
            "pwd" => hash('sha256',myGet("pwd") . Conf::getSeed())
        );
        ModelUtilisateur::insert($data);
        // Initialisation des variables pour la vue
        $login = myGet('pseudo');
        $tab_util = ModelUtilisateur::selectAll();
        // Chargement de la vue
        $view = "created";
        $pagetitle = "Liste des utilisateurs";
        break;

    case "updated":
        if (is_null(myGet('login') || is_null(myGet('nom')) || is_null(myGet('prenom')) || is_null(myGet('email')))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $data = array(
            "login" => myGet("login"),
            "nom" => myGet("nom"),
            "prenom" => myGet("prenom"),
            "email" => myGet("email")
        );
        ModelUtilisateur::update($data);
        // Initialisation des variables pour la vue
        $login = myGet('login');
        $tab_util = ModelUtilisateur::selectAll();
        // Chargement de la vue
        $view = "updated";
        $pagetitle = "Liste des utilisateurs";
        break;
		
	
	default:
	
	case "create":
        $ps = "";
        $n = "";
        $p = "";
		$a = "";
		$adr = "";
		$n = "";
        $e = "";
        $m1="";
        $m2="";
        $label = "Créer";
        $pseudo_status = "required";
        $pagetitle = "Création d'un utilisateur";
	
        $submit = "Création";
        $act = "save";
        $view = "create";
        break;

}
require VIEW_PATH . "view.php";
