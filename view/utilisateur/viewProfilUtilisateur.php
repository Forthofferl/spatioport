<?php

function view1($u) {
    $p = $u[0]->pseudo;
    $n = $u[0]->nom;
    $pr = $u[0]->prenom;
    $e = $u[0]->email;
	$t = $u[0]->numtel;
	$a = $u[0]->age;
	$adr = $u[0]->adr;
	$nbr = $u[0]->nbrVaisseauAcheter;

    // La syntaxe suivante permet de créer facilement des chaînes de caractères multi-lignes
    echo <<< EOT
    
    <h2>Profil de $p</h2>
              <h3>Nom: $n</h3>
			  <h3>Prenom: $pr</h3>
			  <h3>Age: $a ans</h3>
			  <h3>E-mail: $e</h3>
			  <h3>Téléphone: $t</h3>
			  <h3>Adresse: $adr</h3>
			  <h3>Nombre d'achat: $nbr</h3>
              
	<p> <a href="utilisateur.php?action=update" class="btn btn-primary"><span class="fa fa-refresh"></span> Mettre à jour votre profil</a> </p>
    <p> <a href="utilisateur.php?action=delete" class="btn btn-danger"><span class="fa fa-trash"></span> Supprimer votre profil</a> </p>
EOT;
}
?>
        <?php view1($u); ?>
        