<?php

function view1($t) {
   $i = $t->id;
   $v = $t->nomVaisseau;
   $p = $t->prix;
   $n = $t->nbStock;
   $d = $t->description;

    // La syntaxe suivante permet de créer facilement des chaînes de caractères multi-lignes
    echo <<< EOT
        <li> Le $v coute $t et il y en a $n à $p.
			Description:
			$d
            <a href='?action=read&controller=vaisseau&id=$i'> Détails </a>
        </li>
EOT;
}

view1($t);
?>
        <p>
            Retour à la <a href="?controller=trajet">page principale</a>.
        </p>