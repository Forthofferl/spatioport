<?php


define('ROOT', dirname(__FILE__));
// DS contient le slash des chemins de fichiers, c'est-à-dire '/' sur Linux et '\' sur Windows
define('DS', dirname(DIRECTORY_SEPARATOR));
define('BASE', str_replace('//', '/', dirname($_SERVER['PHP_SELF']). '/'));
define('CTR_PATH', ROOT.DS.'controller'.DS);
define('VIEW_PATH_BASE', BASE.'view/');
define('VIEW_PATH', ROOT . DS . 'view' . DS);
define('MODEL_PATH', ROOT . DS . 'model' . DS);
define('URL', 'http://infolimon.iutmontp.univ-montp2.fr');
define('SITEEMAIL','no_reply@spatioport.fr');
$data=array();
session_start();
//setcookie("comptPanier",0);
//setcookie("panier",serialize($data));

// vérifier si l'utilisateur est connecté
function estConnecte() {
    return(isset($_SESSION['pseudo']));
}

function estAdmin() {

	return (!empty($_SESSION ['admin'])&&$_SESSION ['admin']=="1") ;

}

?>
