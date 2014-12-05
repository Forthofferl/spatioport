<?php

require_once 'Model.php';

class ModelUtilisateur extends Model {
    protected static $table = "Utilisateur";
    protected static $primary_index = "pseudo";
}

?>