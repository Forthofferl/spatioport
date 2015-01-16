<?php

function view1($u) {

   $i = $u->idVaisseau;
   $v = $u->nomVaisseau;
   $p = $u->prixVaisseau;
   $n = $u->nbrEnStock;
   $d = $u->descripVaisseau;

    // La syntaxe suivante permet de créer facilement des chaînes de caractères multi-lignes
    echo <<< EOT
        <li> Le $v coute $p et il y en a $n.
			Description:
			$d
            /*<a href='?action=read&controller=vaisseau&id=$i'> Détails </a>*/
        </li>
EOT;
}

view1($t);
?>
        <p>
            Retour à la <a href="?controller=utilisateur">page principale</a>.
        </p>