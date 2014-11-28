<?php

require_once MODEL_PATH."Utilisateur.php";

    if (empty($_GET)) {
      $vue="defaut";
      $pagetitle="Utilisateur";
    }
    else if (isset($action)) {
        switch ($action) {

        /*
         * action=inscription
         * Permet d'accéder au formulaire d'inscription
         */
        case "inscription":
            if(!estConnecte()){
                $vue="creation";
                $pagetitle="Formulaire d'inscription";
                break;
            }
            else{
                $messageErreur="Vous êtes déjà connecté !";
            }
        break;
        /*
         * action=save
         * Insertion d'un joueur dans la BDD (après une inscription)
         */
        case "save":
            if(!estConnecte()){
              if (!(isset($_POST['pseudo']) && isset($_POST['sexe']) && isset($_POST['age']) && isset($_POST['pwd']) && isset($_POST['pwd2']) && isset($_POST['email']))) {
                  $messageErreur='<a href="joueur.php?action=inscription">S\'inscrire</a>';
                  break;
              }
              $data = array(
                  "pseudo" => $_POST["pseudo"],
                  "sexe" => $_POST["sexe"],
                  "age" => $_POST["age"],
                  "pwd" => $_POST["pwd"],
                  "email" => $_POST["email"]
              );
              if($data['pwd']==$_POST["pwd2"]){
                  Utilisateur::inscription($data);
              }
              else {
                  $messageErreur="Vous avez saisi deux mots de passe différents !";
                  break;
              }
              $vue="created";
              $pagetitle="Inscription terminée !";
            }
            else{
              $messageErreur="Vous êtes déjà connecté !";
            }
        break;

        /*
         * action=connexion
         * Permet d'accéder au formulaire de connexion
         */
        case "connexion":
            if(!estConnecte()){
                $vue="connexion";
                $pagetitle="Connexion";
                break;
            }
            else{
              $messageErreur="Vous êtes déjà connecté !";
            }
        /*
         * action=connect
         * Verifie que les données saisies dans le formulaire sont bonnes et ouvre la session
         */
        case "connect":
            if(!estConnecte()){
              if (!(isset($_POST['pseudo']) || isset($_POST['pwd']))){
                  $messageErreur='<a href="joueur.php?action=connexion">Se connecter</a>';
                  break;
              }
                $data = array(
                "pseudo" => $_POST['pseudo'],
                "pwd" => $_POST['pwd']
                );
                if((Joueur::checkExisteConnexion($data))) {
                    Joueur::connexion($data);
                    $vue="connecte";
                    $pagetitle="Connexion réussie !";
                }
                else{
                    $messageErreur="Pseudo ou mot de passe erroné !";
                }
            }
            else{
              $messageErreur="Vous êtes déjà connecté !";
            }
        break;

        case "deconnexion":
            if(estConnecte()){
                Utilisateur::deconnexion();
                $vue="deconnexion";
                $pagetitle="Déconnexion réussie !";
            }
            else{
                $messageErreur="Vous n'êtes pas connecté !";
            }
        break;

        case "delete":
            if(estConnecte()){
                $vue="delete";
                $pagetitle="Confirmation suppression de votre profil";
            }
            else{
                $messageErreur="Vous n'êtes pas connecté !";
            }
        break;

        case "deleted":
            if(estConnecte()){
              Utilisateur::deleteProfil();
              Utilisateur::deconnexion();
              $vue="deleted";
              $pagetitle="Profil supprimé !";
              }
            else{
                $messageErreur="Vous n'êtes pas connecté !";
            }
        break;

        case "profil":
            if(estConnecte()){
                $joueur = Utilisateur::getProfil();
                $p = $joueur->pseudo;
                $a = $joueur->age;
                $s = $joueur->sexe;
                $e = $joueur->email;
                $nbv = $joueur->nbV;
                $nbd = $joueur->nbD;
                $r = 0;
                if($nbd!=0) $r = $nbv/$nbd;
                $vue="profil";
                $pagetitle="Votre profil";
            }
            else{
                $messageErreur="Vous n'êtes pas connecté !";
            }
        break;

        case "update":
            if(estConnecte()){
                $joueur = Utilisateur::getProfil();
                $p = $joueur->pseudo;
                $a = $joueur->age;
                $s = $joueur->sexe;
                $e = $joueur->email;
                $vue="update";
                $pagetitle="Mise à jour de votre profil";
                break;
            }
            else{
                $messageErreur="Vous n'êtes pas connecté !";
            }
        break;

        case "updated":
            if(estConnecte()){
            if (!(isset($_POST['pseudo']) && isset($_POST['age']) && isset($_POST['pwd']) && isset($_POST['pwd2']) && isset($_POST['email']))) {
                $messageErreur='<a href="joueur.php?action=update">Mettre à jour son profil</a>';
                break;
            }
            $data = array(
                "pseudo" => $_POST["pseudo"],
                "age" => $_POST["age"],
                "pwd" => $_POST["pwd"],
                "email" => $_POST["email"]
            );
            if($data['pwd']==$_POST["pwd2"]){
                Utilisateur::updateProfil($data);
            }
            else {
                $messageErreur="Vous avez saisi deux mots de passe différents !";
                break;
            }
            $_SESSION['pseudo'] = $_POST["pseudo"];
            $vue="updated";
            $pagetitle='Profil mis à jour !';
            }
            else{
                $messageErreur="Vous n'êtes pas connecté !";
            }
        break;

    		case "search":
    		    if(estConnecte()){
        				$vue='find';
        				$pagetitle="Recherche d'un joueur";
            }
            else{
                $messageErreur="Vous n'êtes pas connecté !";
            }
    				break;


        case "searched":
            if(estConnecte()){
              if (!isset($_POST['pseudo'])) {
                  $messageErreur='<a href="joueur.php?action=search">Rechercher un joueur</a>';
                  break;
              }
              $data = array("pseudo" => $_POST['pseudo']);
              $joueur = Utilisateur::search($data);
              if (is_null($joueur)){
                  $vue="notFound";
                  $pagetitle="Aucun résultat";
                  break;
              }
              else{
                  $p = $joueur->pseudo;
                  $a = $joueur->age;
                  $s = $joueur->sexe;
                  $e = $joueur->email;
                  $nbv = $joueur->nbV;
                  $nbd = $joueur->nbD;
                  $r = 0;
                  if($nbd!=0) $r = $nbv/$nbd;
                  $vue="found";
                  $pagetitle="Résultat trouvé";
              }
            }
              else{
                  $messageErreur="Vous n'êtes pas connecté !";
              }
              break;

        default :
            $messageErreur="Il semblerait que vous ayez trouvé un glitch dans le système !";

        }
      }
      else {
        $messageErreur="Il semblerait que vous ayez trouvé un glitch dans le système !";
      }
require VIEW_PATH."vue.php";