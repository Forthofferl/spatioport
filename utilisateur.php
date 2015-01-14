<?php
    require_once('config.inc.php');
    $page = 'utilisateur';
    if (isset($_GET['action']))
        $action = $_GET['action'];
    include CTR_PATH.'ControleurUtilisateur.php';
?>
