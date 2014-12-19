<?php

function view1($t) {
    $i = $t->id;
    $c = $t->conducteur;
    $d = $t->depart;
    $a = $t->arrivee;
    $p = $t->prix;
    $n = $t->nbplaces;

    // La syntaxe suivante permet de créer facilement des chaînes de caractères multi-lignes
    echo <<< EOT
    Le trajet n°$i est conduit par $c et ira de $d à $a. 
    Pour ${p}€, vous pouvez vous inscrire dans la limite de $n places.
    <a href='?action=update&controller=trajet&id=$i'>Mettre à jour</a>, 
    <a href='?action=delete&controller=trajet&id=$i'>Supprimer</a>, 
    <a href='?action=readAllUtilisateurs&controller=trajet&id=$i'>Liste des utilisateurs</a>
EOT;
}

view1($t);
?>
        <p>
            Retour à la <a href="?controller=trajet">page principale</a>.
        </p>