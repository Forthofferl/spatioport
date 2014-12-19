<?php

define('VIEW_PATH', ROOT . DS . 'view' . DS);

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

    case "readAllTrajets":
        require_once MODEL_PATH . 'ModelTrajet.php';
        if (!is_null(myGet('login'))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        // Initialisation des variables pour la vue        
        $data = array("login" => myGet('login'));
        $tab_trajets = ModelUtilisateur::findTrajets($data);
        $login = myGet('login');
        $data2 = array("conducteur" => $login);
        $tab_conduc = ModelTrajet::selectWhere($data2);
        $view = "ListTrajets";
        $pagetitle = "Liste des trajets d'un utilisateur";
        break;

    case "deleteTrajet":
        require_once MODEL_PATH . 'ModelTrajet.php';
        if (is_null(myGet('login')) || is_null(myGet('id'))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $id = myGet('id');
        $login = myGet('login');
        
        $data = array(
            "login" => $login,
            "id" => $id
        );
        ModelUtilisateur::deletePassager($data);
        
        $data = array("login" => $login);
        $tab_trajets = ModelUtilisateur::findTrajets($data);
        $data2 = array("conducteur" => $login);
        $tab_conduc = ModelTrajet::selectWhere($data2);
        $view = "DeleteTrajets";
        $pagetitle = "Liste des trajets d'un utilisateur";
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

    case "create":
        $l = "";
        $n = "";
        $p = "";
        $e = "";
        $m1="";
        $m2="";
        $label = "Créer";
        $login_status = "required";
        $pagetitle = "Création d'un utilisateur";
        $submit = "Création";
        $act = "save";
        $view = "create";
        break;

    case "save":
        if (is_null(myGet('login') || is_null(myGet('nom')) || is_null(myGet('prenom')) 
                || is_null(myGet('email')) || is_null(myGet('mdp')) || is_null(myGet('mdp2')))) {
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
            "login" => myGet("login"),
            "nom" => myGet("nom"),
            "prenom" => myGet("prenom"),
            "email" => myGet("email"),
            "mdp" => hash('sha256',myGet("mdp") . Conf::getSeed())
        );
        ModelUtilisateur::insert($data);
        // Initialisation des variables pour la vue
        $login = myGet('login');
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

    case "delete":
        if (!is_null(myGet('login'))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $data = array("login" => myGet('login'));
        $u = ModelUtilisateur::delete($data);
        // Initialisation des variables pour la vue
        $login = myGet('login');
        $tab_util = ModelUtilisateur::selectAll();
        // Chargement de la vue
        $view = "deleted";
        $pagetitle = "Liste des utilisateurs";
        break;

    default:
    // Si l'action est inconnue, nous effectuerons 'readAll'

    case "readAll":
        // Initialisation des variables pour la vue
        $tab_util = ModelUtilisateur::selectAll();
        // Chargement de la vue
        $view = "list";
        $pagetitle = "Liste des utilisateurs";
        break;
}
require VIEW_PATH . "view.php";
