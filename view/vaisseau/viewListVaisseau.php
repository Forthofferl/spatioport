<?php
function view1($tab_vaisseau) {
    foreach ($tab_vaisseau as $t) {
        $i = $t->idVaisseau;
        $v = $t->nomVaisseau;
        $p = $t->prixVaisseau;
        $n = $t->nbrEnStock;
		$d = $t->descripVaisseau;
		
        // La syntaxe suivante permet de créer facilement des chaînes de caractères multi-lignes
        echo <<< EOT
		<li> Le $v coute $p crédit gallactique et il y en a $n.
			Description:
			$d
            <a href='vaisseau.php?action=read&id=$i'> Détails </a>
        </li></br>
		
    
EOT;
	}
}
?>
        <!-- Une variable $tab_util est donnée -->    
        <div>
            <h3>Liste des vaisseaux:</h3>
            <ul>
            <?php view1($tab_vaisseau); ?>
            </ul>
        </div>