<?php

function view1($tu, $id, $passager = true) {
    foreach ($tu as $u) {
        $l = $u->login;
        $n = $u->nom;
        $p = $u->prenom;
        $e = $u->email;

        $desinscrip = "";
        if ($passager) 
            $desinscrip = ", <a href='?action=deleteUtilisateur&controller=vaisseau&id=$id&login=$l'>Désinscription</a>";
        
        
        echo <<< EOT
        <li> Sous le login $l se trouve l'utilisateur $p $n dont l'email est $e.
            <a href='?action=read&controller=utilisateur&login=$l'>Détails</a>$desinscrip
        </li>
EOT;
    }
}

function view2($t) {
    $v = $t->nomVaisseau;
    $c = $t->conducteur;

    // La syntaxe suivante permet de créer facilement des chaînes de caractères multi-lignes
    echo "Le $v est conduit par $c";
}
?>
<!-- Une variable $tab_util est donnée -->    
<div>
    <h1>Trajet n°<?php echo $id; ?>:</h1>
    <h2>Conducteur</h2>
    <ol>
    <?php view1(array($u), $id, false); ?>
    </ol>
    
    <h2>Liste des passagers</h2>
    <ol>
    <?php view1($tab_util, $id); ?>
    </ol>
</div>