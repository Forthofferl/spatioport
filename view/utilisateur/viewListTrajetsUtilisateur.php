<?php
function view1($tab_traj, $login, $passager = true) {
    foreach ($tab_traj as $t) {
        $i = $t->id;
        $c = $t->conducteur;
        $d = $t->depart;
        $a = $t->arrivee;
        $p = $t->prix;
        $n = $t->nbplaces;
        
        $desinscrip = "";
        if ($passager) 
            $desinscrip = ", <a href='?action=deleteTrajet&controller=utilisateur&id=$i&login=$login'>Désinscription</a>";
        
        echo <<< EOT
        <li> Le trajet n°$i va de $d à $a pour ${p}€.
            <a href='?action=read&controller=trajet&id=$i'>Détails</a>$desinscrip
        </li>
EOT;
    }
}
?>
        <!-- Une variable $tab_util est donnée -->    
        <div>
            <h1>Trajets de l'utilisateur <?php echo $login ?>:</h1>
            <h2>En tant que conducteur</h2>
            <ol>
            <?php view1($tab_conduc, $login, false); ?>
            </ol>
            <h2>En tant que passager</h2>
            <ol>
            <?php view1($tab_trajets, $login); ?>
            </ol>
        </div>