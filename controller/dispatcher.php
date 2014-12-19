<?php

function myGet($nomvar){
    if (isset($_GET[$nomvar]))
        return ($_GET[$nomvar]);
    if (isset($_POST[$nomvar]))
        return ($_POST[$nomvar]);
    return null;
}

define('MODEL_PATH', ROOT . DS . 'model' . DS);

if (!is_null(myGet('controller')))
    $controller = myGet('controller'); //recupere le controlleur passe dans l'url
else
    $controller = "utilisateur";

if (!is_null(myGet('action')))
    $action = myGet('action');    //recupere l'action  passee dans l'url
else
    $action = "readAll";

switch ($controller) {
    case "utilisateur":
        require_once "ControllerUtilisateur.php";
        break;

    case "vaisseau":
        require_once "ControllerVaisseau.php";
        break;

    default:
}


    
?>