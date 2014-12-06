<h1 id="mainhead">Votre profil</h1>
<hr>
<p>
<?php
echo <<< EOT
Pseudo : $p <br/>
Age : $a <br/>
Sexe : $s <br/>
E-mail : $e <br/>
Nombre de vaisseaux acheter : $nba <br/>
EOT;
?>
</p>
<hr>
<a href='joueur.php?action=update'>Mettre à jour votre profil</a><br/>
<a href='joueur.php?action=delete'>Supprimer votre profil du système!</a><br/>
