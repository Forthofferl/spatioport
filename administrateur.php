<?php
	
    require_once('config.inc.php');
    $page = 'administrateur';
    if (isset($_GET['action']))
        $action = $_GET['action'];
    include CTR_PATH.'ControllerAdmin.php';
	//include ROOT . DS . 'controller' . DS . 'dispatcher.php';
?>