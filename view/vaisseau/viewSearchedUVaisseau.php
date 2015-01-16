<?php

function view1($u) {
    $n = $u[0]->nomVaisseau;
    $p = $u[0]->prixVaisseau;
    $c = $u[0]->categorie;
    $nbr = $u[0]->nbrEnStock;
	$d = $u[0]->descripVaisseau;
	
    // La syntaxe suivante permet de créer facilement des chaînes de caractères multi-lignes
    echo <<< EOT
    
    <h2>Informations sur le vaisseau $n</h2>
              <h3>Prix: $p</h3>
			  <h3>Categorie: $c</h3>
			  <h3>Nombre en stock: $nbr</h3>
			  <h3>Description: </h3>
			  <h3>$d</h3>
              
	<p> <a href="utilisateur.php?action=dansPanier" class="btn btn-primary"><span class="fa fa-refresh"></span> Mettre dans le panier</a> </p>
    <p> <a href="vaisseau.php?action=search" class="btn btn-danger"><span class="fa fa-trash"></span> Revenir à la recherche</a> </p>
EOT;
}
?>
        <?php view1($u); ?>
        