<?php
	
    require_once('config.inc.php');
    $page = 'vaisseau';
    if (isset($_GET['action']))
        $action = $_GET['action'];
    include CTR_PATH.'ControllerVaisseau.php';
	//include ROOT . DS . 'controller' . DS . 'dispatcher.php';
?>