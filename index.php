<?php

// define permet de définir des constantes
// ROOT permet de gérer différentes racines du projet
define('ROOT', dirname(__FILE__));
// DS contient le slash des chemins de fichiers, c'est-à-dire '/' sur Linux et '\' sur Windows
define('DS', dirname(DIRECTORY_SEPARATOR));

// include fait une inclusion textuelle (comme un copier/coller) du fichier
// ./controller/dispatcher.php (sous Linux)
include ROOT . DS . 'controller' . DS . 'dispatcher.php';
require_once('config.inc.php');
$page = 'index';
if (isset($_GET['action']))
    $action = $_GET['action'];
include CTR_PATH.'ControleurUtilisateur.php';

?>

