<?php
    if (empty($_GET)) {
      $vue="default";
      $pagetitle='Bienvenue dans le Spatioport';
    }
    else if (isset($action)) {
      switch ($action) {

        case "recherche":
                $vue="recherche";
                $pagetitle="Recherche";
                break;
        break;

        case "connecter":
                $vue="connect";
                $pagetitle="Connexion";
                break;
        break;

        case "inscrire":
            $vue="inscrit";
            $pagetitle="Inscription";
            break;
          }

	case "panier"
          $vue="panier";
	  $pagetitle="Votre Panier"
        break;
    	}
    else {
      $messageErreur="Vous avez rencontrer une erreur, veuillez contacter un administrateur.";
    }
    require VIEW_PATH . "vue.php";
