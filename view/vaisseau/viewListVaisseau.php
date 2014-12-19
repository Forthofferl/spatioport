<?php
function view1($tab_traj) {
    foreach ($tab_traj as $t) {
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
   echo <<< EOT
        <li> 
            <a href='?action=create&controller=vaisseau'>Créer un nouveau vaisseau</a>
        </li>
EOT;
}
?>
        <!-- Une variable $tab_util est donnée -->    
        <div>
            <h1>Liste des vaisseaux:</h1>
            <ol>
            <?php view1($tab_vaisseau); ?>
            </ol>
        </div>