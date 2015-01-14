<?php

require_once 'Model.php';

class ModelUtilisateur extends Model {
    protected static $table = "utilisateur";
    protected static $primary_index = "idUtilisateur";
    
    /*public static function findTrajets($data) {
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
    }*/
	
	public static function connexion($data) {
        $_SESSION['idUtilisateur'] = $data['idUtilisateur'];
        $_SESSION['pseudo'] = $data['pseudo'];
    }

    public static function deconnexion(){
        
        session_unset();
        session_destroy();
    }

    public static function checkExisteConnexion($data) {
        try {
            $data['pwd'] = hash('sha256',$data['pwd'].Config::getSeed());
            $req = self::$pdo->prepare('SELECT idUtilisateur FROM Utilisateur WHERE pseudo = :pseudo AND pwd = :pwd');
            $req->execute($data);
            return ($req->rowCount() != 0);
        }  catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la recherche dans la base de données checkConnexion";
        }
    }


    public static function inscription($data) {
        if(!(ModelUtilisateur::checkAlreadyExist($data))) {
            try {
                $data['pwd'] = hash('sha256',$data['pwd'].Config::getSeed());
                $req = self::$pdo->prepare('INSERT INTO Utilisateur (idUtilisateur, pseudo, prenom, nom, age, adr, pwd, email, numtel, nbrVaisseauAcheter) VALUES (:pseudo, :sexe, :age, :pwd, :email) ');
                $req->execute($data);
            } catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Erreur lors de l'insertion dans la base de données pour inscription";
            }
        }
        else {
            $messageErreur="Pseudo ou email déjà existant";
        }
    }

}

?>