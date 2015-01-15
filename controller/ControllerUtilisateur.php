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
		
		$view="connexion";
		$pagetitle="connexion";
		$label="connexion";
		$submit="Se connecter";
		break;
		
	case "deconnexion":
                ModelUtilisateur::deconnexion();
                header('Location: .');
            
           
    break;
		
	case "created":
	
			$view="created";
			$pagetitle="Créer!";
			$ps=myGet('pseudo');
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
	
		
	case "connected":
            if(!estConnecte()){
              if (!(isset($_POST['pseudo']) || isset($_POST['pwd']))){
                  header('Location: .');
              }
                $data = array(
                "pseudo" => $_POST['pseudo'],
                "pwd" => hash('sha256',$_POST['pwd'].conf::getSeed()),
                );
				//var_dump($data);
                $user = ModelUtilisateur::selectWhere($data);
				//var_dump($user);
                if($user != null) {
                  
                    $data2 = array(
                      "idUtilisateur" => $user[0]->idUtilisateur,
                      "pseudo" => $user[0]->pseudo
                    );
                    ModelUtilisateur::connexion($data2);
                    /*if(isset($_POST['redirurl'])) $url = $_POST['redirurl'];
                    else{$url = ".";}
                    header("Location:$url");*/
					$view="connected";
					$pagetitle="Vous êtes connecté!";
                }
                else{
				//$messageErreur="Mot de passe ou identifiant incorrect";
				$view="error";
				$pagetitle="Erreur!";
				break;
				} 
            }
            else{
              header('Location: .');
            }
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
