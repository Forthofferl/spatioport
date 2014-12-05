<?php

/*
 * Classe Utilisateur
 */

require_once 'Modele.php';
require_once 'Vaisseau.php';

class Utilisateur extends Model {

    public static function connexion($data) {
        try {
            $data['pwd'] = hash('sha256',$data['pwd'].Config::getSeed());
            $req = self::$pdo->prepare('SELECT idUtilisateur, pseudo FROM Utilisateur WHERE pseudo = :pseudo AND pwd = :pwd');
            $req->execute($data);
            if ($req->rowCount() != 0) {
                $data_recup = $req->fetch(PDO::FETCH_OBJ);
                $_SESSION['idUtilisateur'] = $data_recup->idUtilisateur;
                $_SESSION['pseudo'] = $data_recup->pseudo;
            }
        }catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Échec lors de la connexion d'un utilisateur";
        }
    }

    public static function deconnexion(){
        if(Jeu::checkDejaAttente($_SESSION['idUtilisateur'])){
            Jeu::deleteAttente($_SESSION['idUtilisateur']);
        }
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
        if(!(Joueur::checkAlreadyExist($data))) {
            try {
                $data['pwd'] = hash('sha256',$data['pwd'].Config::getSeed());
                $req = self::$pdo->prepare('INSERT INTO Utilisateur (pseudo, sexe, age, pwd, email) VALUES (:pseudo, :sexe, :age, :pwd, :email) ');
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

    public static function checkAlreadyExist($data) {
      try {
              $var = "SELECT * FROM Utilisateur WHERE";
              if (estConnecte()) $var .= " Utilisateur !=".$_SESSION['idUtilisateur']." AND";
              $var .= " (Utilisateur = :Utilisateur OR email = :email)";
              $req = self::$pdo->prepare($var);
              $req->execute(array('pseudo' => $data['Utilisateur'], 'email' => $data['email']));
              $data_recup = $req->fetch(PDO::FETCH_OBJ);
              return ($req->rowCount() != 0);
              }
           catch (PDOException $e) {
              echo $e->getMessage();
              $messageErreur="Erreur lors de la recherche d'un utilisateur dans la BDD pour le check pseudo/mail";
          }
    }


    public static function updateProfil($data) {
        if(!(Utilisateur::checkAlreadyExist($data))) {
            try {
                $data['pwd'] = hash('sha256',$data['pwd'].Config::getSeed());
                $req = self::$pdo->prepare('UPDATE Utilisateur SET pseudo= :pseudo, age= :age, pwd= :pwd, email= :email WHERE idUtilisateur='.$_SESSION['idUtilisateur']);
                $req->execute($data);
            } catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Erreur lors de la mise à jour d'un utilisateur dans la base de données";
            }
        }
        else{
            $messageErreur="Pseudo ou email déjà utilisé !";
        }
    }

    public static function deleteProfil() {
        try {
            $req = self::$pdo->prepare('DELETE FROM Utilisateur WHERE idUtilisateur ='.$_SESSION['idUtilisateur']);
            $req->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la suppression d'un utilisateur de la base de données";
        }
    }

    public static function getProfil() {
        try {
            $req = self::$pdo->prepare('SELECT * FROM Utilisateur WHERE idUtilisateur ='.$_SESSION['idUtilisateur']);
            $req->execute();
            return $req->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la recherche d'un utilisateur dans la base de données";
        }
    }

    public static function getPseudo($idJ) {
        try {
            $req = self::$pdo->prepare('SELECT pseudo FROM Utilisateur WHERE idUtilisateur ='.$idJ);
            $req->execute();
            $data_recup = $req->fetch(PDO::FETCH_OBJ);
            return $data_recup->pseudo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la recherche d'un utilisateur dans la base de données";
        }
    }

    public static function updateNbAchat($idJ) {
            try {
                $req = self::$pdo->prepare('UPDATE Utilisateur SET nbA=nbA+1 WHERE idUtilisateur='.$idJ);
                $req->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Erreur lors de la mise à jour du nombre d'achat d'un utilisateur dans la base de données";
            }
    }


}

?>