<?php
function view1($tab_traj) {
    foreach ($tab_traj as $t) {
        $i = $t->id;
        $c = $t->conducteur;
        $d = $t->depart;
        $a = $t->arrivee;
        $p = $t->prix;
        $n = $t->nbplaces;
        
        // La syntaxe suivante permet de créer facilement des chaînes de caractères multi-lignes
        echo <<< EOT
        <li> Le trajet n°$i va de $d à $a pour ${p}€.
            <a href='?action=read&controller=trajet&id=$i'> Détails </a>
        </li>
EOT;
    }
   echo <<< EOT
        <li> 
            <a href='?action=create&controller=trajet'>Créer un nouveau trajet</a>
        </li>
EOT;
}
?>
        <!-- Une variable $tab_util est donnée -->    
        <div>
            <h1>Liste des trajets:</h1>
            <ol>
            <?php view1($tab_trajets); ?>
            </ol>
        </div>