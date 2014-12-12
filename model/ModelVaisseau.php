<?php

/*
 * Classe Vaisseau
 */

require_once 'Model.php';
require_once 'ModelUtilisateur.php';

class Vaisseau extends Model {

	public static function getNom($id) {
			try {
				$req = self::$pdo->prepare("SELECT nom FROM Vaisseau WHERE idVaisseau=".$id);
				$req->execute();
				if ($req->rowCount() != 0) {
					$data_recup = $req->fetch(PDO::FETCH_OBJ);
					return $data_recup->nom;
				}
				} catch (PDOException $e) {
					echo $e->getMessage();
					die("Erreur lors de la récupération du nom du vaisseau dans la BDD");
				}
		}
	public static function search($data) {
			try {
				$req = self::$pdo->prepare("SELECT * FROM Vaisseau WHERE nom = :nom");
				$req->execute($data);
				if ($req->rowCount() != 0)
					return $req->fetch(PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				echo $e->getMessage();
				$messageErreur="Erreur lors de la recherche du vaisseau dans la base de données";
			}
		    }

}

?>
