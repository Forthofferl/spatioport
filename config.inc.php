<?php
define('ROOT', dirname(__FILE__));
define('DS', dirname(DIRECTORY_SEPARATOR));
define('BASE', str_replace('//', '/', dirname($_SERVER['PHP_SELF']). '/'));
define('VIEW_PATH', ROOT.DS.'view'.DS);
define('CTR_PATH', ROOT.DS.'controller'.DS);
define('MODEL_PATH', ROOT.DS.'model'.DS);
define('VIEW_PATH_BASE', BASE.'view/');

session_start();

// vérifier si l'utilisateur est connecté
function estConnecte() {
    return(isset($_SESSION['idJoueur']));
}
?>
