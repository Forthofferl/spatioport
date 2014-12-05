<?php

<<<<<<< HEAD
require_once ROOT . DS . 'config' . DS . 'Config.php';
=======
// On va chercher le fichier de configuration dans "./config/Conf.php"
require_once ROOT . DS . 'config' . DS . 'Conf.php';

>>>>>>> 1314187d1212d86d5a94a02872883c77af558776
class Model {

    public static $pdo;

    public static function set_static() {
<<<<<<< HEAD
        $host = Config::getHostname();
        $dbname = Config::getDatabase();
        $login = Config::getLogin();
        $pass = Config::getPassword();

        try {
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            if (Config::getDebug()) {
                echo $ex->getMessage();
                die ("Problème lors de la connexion à la base de données");
            } else {
                echo "Une erreur est survenue.";
=======
        $host = Conf::getHostname();
        $dbname = Conf::getDatabase();
        $login = Conf::getLogin();
        $pass = Conf::getPassword();

        try {
            // Connexion � la base de donn�es            
            // Le dernier argument sert � ce que toutes les chaines de charact�res 
            // en entr�e et sortie de MySql soit dans le codage UTF-8
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            if (Conf::getDebug()) {
                echo $ex->getMessage();
                die('Probl�me lors de la connexion � la base de donn�e');
            } else {
                echo 'Une erreur est survenue. <a href=""> Retour a la page d\'accueil </a>';
>>>>>>> 1314187d1212d86d5a94a02872883c77af558776
            }
            die();
        }
    }
<<<<<<< HEAD
}
Model::set_static();

=======

    public static function selectAll() {
        try {
            $sql = "SELECT * FROM " . static::$table;
            $req = self::$pdo->query($sql);
            // fetchAll retoure un tableau d'objets repr�sentant toutes les lignes du jeu d'enregistrements 
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la recherche de tous les objets de la BDD " . static::$table);
        }
    }

    public static function select($data) {
        try {
            $table = static::$table;
            $primary = static::$primary_index;
            $sql = "SELECT * FROM $table WHERE $table.$primary = :$primary";
            // Preparation de la requete
            $req = self::$pdo->prepare($sql);
            // execution de la requete
            $req->execute($data);

            if ($req->rowCount() != 0)
                return $req->fetch(PDO::FETCH_OBJ);
            return null;  // Optionel : si return est omis, Php envoie null dans tous les cas
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la recherche dans la BDD " . static::$table);
        }
    }

    public static function delete($data) {
        try {
            $table = static::$table;
            $primary = static::$primary_index;
            $sql = "DELETE FROM $table WHERE $table.$primary = :$primary";
            // Preparation de la requete
            $req = self::$pdo->prepare($sql);
            // execution de la requete
            return $req->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la suppression dans la BDD " . static::$table);
        }
    }

    public static function insert($data) {
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
            return $req->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de l\'insertion dans la BDD " . static::$table);
        }
    }

    public static function update($data) {
        try {
            $table = static::$table;
            $primary = static::$primary_index;
                    
            $update = "";
            foreach ($data as $key => $value)
                $update .= "$key=:$key, ";
            $update = rtrim($update, ', ');
            $sql = "UPDATE $table SET $update WHERE $primary=:$primary";           
            
            // Preparation de la requete
            $req = self::$pdo->prepare($sql);
            // execution de la requete
            return $req->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la mise � jour dans la BDD " . static::$table);
        }
    }

}

// On initialise la connexion $pdo un fois pour toute
Model::set_static();
>>>>>>> 1314187d1212d86d5a94a02872883c77af558776
?>
