<?php

function view1($u) {
    $l = $u->login;
    $n = $u->nom;
    $p = $u->prenom;
    $e = $u->email;

    // La syntaxe suivante permet de créer facilement des chaînes de caractères multi-lignes
    echo <<< EOT
    Sous le login $l se trouve l'utilisateur $p $n dont l'email est $e.
    <a href='?action=update&controller=utilisateur&login=$l'>Mettre à jour</a>, 
    <a href='?action=delete&controller=utilisateur&login=$l'>Supprimer</a>, 
    <a href='?action=readAllTrajets&controller=utilisateur&login=$l'>Liste des trajets</a>
EOT;
}
?>
        <?php view1($u); ?>
        <p>
            Retour à la <a href="?">page principale</a>.
        </p>