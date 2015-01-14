<?php
require_once('config.inc.php');
// define permet de définir des constantes
// ROOT permet de gérer différentes racines du projet



// include fait une inclusion textuelle (comme un copier/coller) du fichier
// ./controller/dispatcher.php (sous Linux)
include ROOT . DS . 'controller' . DS . 'dispatcher.php';

$page = 'index';
if (isset($_GET['action']))
    $action = $_GET['action'];
include CTR_PATH.'ControllerUtilisateur.php';

?>

