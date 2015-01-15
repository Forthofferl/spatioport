<?php

require_once 'Model.php';

class ModelVaisseau extends Model {

    protected static $table = "vaisseau";
    protected static $primary_index = "idVaisseau";
    
    public static function insertAndGetId($data) {
        try {
            $table = static::$table;
            $indices = "";
            $values = "";
            foreach ($data as $key => $value) {
                $indices .= "$key, ";
                $values .= ":$key, ";
            }
            $indices = '(' . rtrim($indices, ', ') . ')';
            $values = '(' . rtrim($values, ', ') . ')';
            $sql = "INSERT INTO $table $indices VALUES $values";
            // Preparation de la requete
            $req = self::$pdo->prepare($sql);
            // execution de la requete
            $req->execute($data);
            return self::$pdo->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("<br /> Erreur lors de l'insertion dans la BDD " . static::$table);
        }
    }

    /*public static function findUtilisateurs($data) {
        try {
            $table = static::$table;
            $primary = static::$primary_index;
            $sql = "SELECT u.* FROM utilisateur u INNER JOIN passager p "
                    . "WHERE u.login = p.utilisateur_login AND p.Vaisseau_id = :id";                       
            // Preparation de la requete
            $req = self::$pdo->prepare($sql);
            // execution de la requete
            $req->execute($data);
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la recherche dans la BDD " . static::$table);
        }
    }
    
    public static function deletePassager($data) {
        try {
            $sql = "DELETE FROM passager WHERE `Vaisseau_id` = :id AND `utilisateur_login` = :login";            
            // Preparation de la requete
            $req = self::$pdo->prepare($sql);
            // execution de la requete            
            return $req->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD " . static::$table);
        }
    }*/
}

?>