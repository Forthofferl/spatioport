<?php

require_once 'Model.php';

class ModelUtilisateur extends Model {
    protected static $table = "utilisateur";
    protected static $primary_index = "login";
    
    public static function findTrajets($data) {
        try {
            $sql = "SELECT t.* FROM trajet t INNER JOIN passager p "
                    . "WHERE t.id = p.trajet_id AND p.utilisateur_login = :login";                       
            // Preparation de la requete
            $req = self::$pdo->prepare($sql);
            // execution de la requete
            $req->execute($data);
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD " . static::$table);
        }
    }
    
    public static function deletePassager($data) {
        try {
            $sql = "DELETE FROM passager WHERE trajet_id = :id AND utilisateur_login = :login";
            // Preparation de la requete
            $req = self::$pdo->prepare($sql);
            // execution de la requete
            return $req->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD " . static::$table);
        }
    }

}

?>