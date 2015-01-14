<?php

require_once('index.php');

// On va chercher le modele dans "./model/ModelVaisseau.php"
require_once MODEL_PATH . 'Model' . ucfirst($controller) . '.php';

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
            $pagetitle = "Détail d'un trajet";
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
        $tab_util = ModelTrajet::findUtilisateurs($data);
        $id = myGet('id');
        $t = ModelTrajet::select($data);
        $data2 = array ("login" => $t->conducteur);
        $u = ModelUtilisateur::select($data2);
        $view = "ListUtilisateurs";
        $pagetitle = "Liste des utilisateurs d'un trajet";
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
        ModelTrajet::deletePassager($data);
        
        $data = array("id" => $id);
        $tab_util = ModelTrajet::findUtilisateurs($data);        
        $t = ModelTrajet::select($data);
        $data2 = array ("login" => $t->conducteur);
        $u = ModelUtilisateur::select($data2);
        $view = "DeleteUtilisateurs";
        $pagetitle = "Liste des utilisateurs d'un trajet";
        break;
        
    case "update":
        if (!is_null(myGet('id'))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $data = array("id" => myGet('id'));
        $t = ModelTrajet::select($data);
        // Initialisation des variables pour la vue        
        $i = $t->id;
        $hidden_id = "<input type='hidden' name='id' value='$i' />"; //$t->id;
        $c = $t->conducteur;
        $d = $t->depart;
        $a = $t->arrivee;
        $p = $t->prix;
        $n = $t->nbplaces;
        $pagetitle = "Mise à jour d'un trajet";
        $label = "Modifier";
        $submit = "Mise à jour";
        $act = "updated";
        $view = "create";
        break;

    case "create":
        $hidden_id = "";
        $c = "";
        $d = "";
        $a = "";
        $p = "";
        $n = "";
        $label = "Créer";
        $pagetitle = "Création d'un trajet";
        $submit = "Création";
        $act = "save";
        $view = "create";
        break;

    case "save":
        if (!(is_null(myGet('conducteur')) || is_null(myGet('depart')) || is_null(myGet('arrivee')) 
                || is_null(myGet('prix')) || is_null(myGet('nbplaces')))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $data = array(
            "conducteur" => myGet("conducteur"),
            "depart" => myGet("depart"),
            "arrivee" => myGet("arrivee"),
            "prix" => myGet("prix"),
            "nbplaces" => myGet("nbplaces")
        );
        $i = ModelTrajet::insertAndGetId($data);
        // Initialisation des variables pour la vue
        $tab_trajets = ModelTrajet::selectAll();
        // Chargement de la vue
        $view = "created";
        $pagetitle = "Liste des trajets";
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
        ModelTrajet::update($data);
        // Initialisation des variables pour la vue
        $i = myGet('id');
        $tab_trajets = ModelTrajet::selectAll();
        // Chargement de la vue
        $view = "updated";
        $pagetitle = "Liste des trajets";
        break;

    case "delete":
        if (!is_null(myGet('id'))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $data = array("id" => myGet('id'));
        $t = ModelTrajet::delete($data);
        // Initialisation des variables pour la vue
        $i = myGet('id');
        $tab_trajets = ModelTrajet::selectAll();
        // Chargement de la vue
        $view = "deleted";
        $pagetitle = "Liste des trajets";
        break;

    default:
    // Si l'action est inconnue, nous effectuerons 'readAll'

    case "readAll":
        // Initialisation des variables pour la vue
        $tab_trajets = ModelTrajet::selectAll();
        // Chargement de la vue
        $view = "list";
        $pagetitle = "Liste des trajets";
        break;
}
require VIEW_PATH . "view.php";
