<?php

function view1($u) {
    $n = $u[0]->nomVaisseau;
    $p = $u[0]->prixVaisseau;
    $c = $u[0]->categorie;
    $nbr = $u[0]->nbrEnStock;
	$d = $u[0]->descripVaisseau;
	
    // La syntaxe suivante permet de créer facilement des chaînes de caractères multi-lignes
    echo <<< EOT
    
    <h2>Informations sur le $n</h2>
	<img src="<?php echo VIEW_PATH_BASE.'img/$n.jpg'?>" title="$n" width="200" height="150">
              <h3>Prix: $p</h3>
			  <h3>Categorie: $c</h3>
			  <h3>Nombre en stock: $nbr</h3>
			  <h3>Description: </h3>
			  <h3>$d</h3>
     <form method="post" action="utilisateur.php?action=dansPanier">
	 <label>Quantité : </label>
	<input type="text" name="quantite" style="border-radius:5px;" placeholder="quantite" size="10" \required></br>


    <input type="submit" class="btn btn-primary" value="Mettre dans le panier" />
	</form>
	
    <p> <a href="vaisseau.php?action=search" class="btn btn-danger"><span class="fa fa-trash"></span> Revenir à la recherche</a> </p>
EOT;
}
?>
        <?php view1($u); ?>
        