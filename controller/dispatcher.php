<?php

define('MODEL_PATH', ROOT . DS . 'model' . DS);

if (isset($_GET['controller']))
    $controller = $_GET['controller']; //recupere le controlleur passe dans l'url
else
    $controller = "utilisateur";

if (isset($_GET['action']))
    $action = $_GET['action'];    //recupere l'action  passee dans l'url
else
    $action = "readAll";

switch ($controller) {
    case "utilisateur":
        require_once "ControllerUtilisateur.php";
        break;

    case "trajet":
        require_once "ControllerTrajet.php";
        break;

    default:
}
?>