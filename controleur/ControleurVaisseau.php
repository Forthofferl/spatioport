<?php

require_once MODEL_PATH."Utilisateur.php";

    if (empty($_GET)) {
      $vue="defaut";
      $pagetitle="Utilisateur";
    }
    else if (isset($action)) {
        switch ($action) {

	 case "description":
		    
		$vaisseau = Vaisseau::getDescription();
		$i = $vaisseau->id;
		$n = $vaisseau->nom;
		$p = $vaisseau->prix;
		$s = $vaisseau->stock;
		$d = $joueur->description;
		$vue="descriptionVaisseau";
		$pagetitle="Vaisseau";
	 break;

	case "search":
			$vue='rechercheVaisseau';
			$pagetitle="Recherche d'un Vaisseau";
		
		
    	break;
