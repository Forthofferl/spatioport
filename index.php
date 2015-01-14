<?php
require_once('config.inc.php');
// define permet de définir des constantes
// ROOT permet de gérer différentes racines du projet
define('ROOT', dirname(__FILE__));
// DS contient le slash des chemins de fichiers, c'est-à-dire '/' sur Linux et '\' sur Windows
define('DS', dirname(DIRECTORY_SEPARATOR));
define('BASE', str_replace('//', '/', dirname($_SERVER['PHP_SELF']). '/'));

define('CTR_PATH', ROOT.DS.'controller'.DS);

define('VIEW_PATH_BASE', BASE.'view/');
define('VIEW_PATH', ROOT . DS . 'view' . DS);


// include fait une inclusion textuelle (comme un copier/coller) du fichier
// ./controller/dispatcher.php (sous Linux)
include ROOT . DS . 'controller' . DS . 'dispatcher.php';

$page = 'index';
if (isset($_GET['action']))
    $action = $_GET['action'];
include CTR_PATH.'ControllerUtilisateur.php';

?>

