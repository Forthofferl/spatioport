<?php

define('VIEW_PATH', ROOT . DS . 'view' . DS);

// On va chercher le modele dans "./model/ModelTrajet.php"
require_once MODEL_PATH . 'Model' . ucfirst($controller) . '.php';

switch ($action) {
    case "read":
        if (!isset($_GET['id'])) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        // Initialisation des variables pour la vue        
        $data = array("id" => $_GET['id']);
        $t = ModelTrajet::select($data);
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
        if (!isset($_GET['id'])) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        // Initialisation des variables pour la vue        
        $data = array("id" => $_GET['id']);
        $tab_util = ModelTrajet::findUtilisateurs($data);
        $id = $_GET['id'];
        $t = ModelTrajet::select($data);
        $data2 = array ("login" => $t->conducteur);
        $u = ModelUtilisateur::select($data2);
        $view = "ListUtilisateurs";
        $pagetitle = "Liste des utilisateurs d'un trajet";
        break;
        
    case "deleteUtilisateur":
        require_once MODEL_PATH . 'ModelUtilisateur.php';
        if (!(isset($_GET['id']) && isset($_GET['login']))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $id = $_GET['id'];
        $login = $_GET['login'];        
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
        if (!isset($_GET['id'])) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $data = array("id" => $_GET['id']);
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
        if (!(isset($_GET['conducteur']) && isset($_GET['depart']) && isset($_GET['arrivee']) 
                && isset($_GET['prix']) && isset($_GET['nbplaces']))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $data = array(
            "conducteur" => $_GET["conducteur"],
            "depart" => $_GET["depart"],
            "arrivee" => $_GET["arrivee"],
            "prix" => $_GET["prix"],
            "nbplaces" => $_GET["nbplaces"]
        );
        $i = ModelTrajet::insertAndGetId($data);
        // Initialisation des variables pour la vue
        $tab_trajets = ModelTrajet::selectAll();
        // Chargement de la vue
        $view = "created";
        $pagetitle = "Liste des trajets";
        break;

    case "updated":
        if (!(isset($_GET['conducteur']) && isset($_GET['depart']) && isset($_GET['arrivee']) 
                && isset($_GET['prix']) && isset($_GET['nbplaces']))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $data = array(
            "id" => $_GET["id"],
            "conducteur" => $_GET["conducteur"],
            "depart" => $_GET["depart"],
            "arrivee" => $_GET["arrivee"],
            "prix" => $_GET["prix"],
            "nbplaces" => $_GET["nbplaces"]
        );
        ModelTrajet::update($data);
        // Initialisation des variables pour la vue
        $i = $_GET['id'];
        $tab_trajets = ModelTrajet::selectAll();
        // Chargement de la vue
        $view = "updated";
        $pagetitle = "Liste des trajets";
        break;

    case "delete":
        if (!isset($_GET['id'])) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $data = array("id" => $_GET['id']);
        $t = ModelTrajet::delete($data);
        // Initialisation des variables pour la vue
        $i = $_GET['id'];
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
