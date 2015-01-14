<?php
    require_once('index.php');
    $page = 'utilisateur';
    if (isset($_GET['action']))
        $action = $_GET['action'];
    include CTR_PATH.'ControllerUtilisateur.php';
?>
