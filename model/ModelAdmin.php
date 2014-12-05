<?php

require_once 'Model.php';

class ModelUtilisateur extends Model {
    protected static $table = "Administrateur";
    protected static $primary_index = "idAdmin";
}

?>