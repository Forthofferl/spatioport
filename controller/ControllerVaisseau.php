<?php

require_once('config.inc.php');

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
        $hidden_id = "";
        $c = "";
        $d = "";
        $a = "";
        $p = "";
        $n = "";
        $label = "Créer";
        $pagetitle = "Création d'un Vaisseau";
        $submit = "Création";
        $act = "save";
        $view = "create";
        break;

    case "save":
        if (!(is_null(myGet('nomVaisseau')) || is_null(myGet('prixVaisseau')) || is_null(myGet('nbrEnStock')) 
                || is_null(myGet('descripVaisseau')))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        $data = array(
            "nomVaisseau" => myGet("nomVaisseau"),
            "prixVaisseau" => myGet("prixVaisseau"),
            "nbrEnStock" => myGet("nbrEnStock"),
            "descripVaisseau" => myGet("descripVaisseau")
        );
        $i = ModelVaisseau::insertAndGetId($data);
        // Initialisation des variables pour la vue
        $tab_Vaisseaus = ModelVaisseau::selectAll();
        // Chargement de la vue
        $view = "created";
        $pagetitle = "Liste des Vaisseaus";
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
}
require VIEW_PATH . "view.php";
