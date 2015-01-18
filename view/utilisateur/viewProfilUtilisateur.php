<?php

function view1($u) {
    $p = $u[0]->pseudo;
    $n = $u[0]->nom;
    $pr = $u[0]->prenom;
    $e = $u[0]->email;
	$t = $u[0]->numtel;
	$a = $u[0]->age;
	$adr = $u[0]->adr;
	$nbr = $u[0]->nbrVaisseauAcheter;

    // La syntaxe suivante permet de créer facilement des chaînes de caractères multi-lignes
    echo <<< EOT
    
    <h2>Profil de $p</h2>
              <h3>Nom: $n</h3>
			  <h3>Prenom: $pr</h3>
			  <h3>Age: $a ans</h3>
			  <h3>E-mail: $e</h3>
			  <h3>Téléphone: $t</h3>
			  <h3>Adresse: $adr</h3>
			  <h3>Nombre d'achat: $nbr</h3>
              
	<p> <a href="utilisateur.php?action=update" class="btn btn-primary"><span class="fa fa-refresh"></span> Mettre à jour votre profil</a> </p>
    <p> <a href="utilisateur.php?action=delete" class="btn btn-danger"><span class="fa fa-trash"></span> Supprimer votre profil</a> </p>
EOT;
}
?>
<div class="container">
    <div class='tabs-x tabs-above tab-align-center'>
      <ul id="onglets" class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#profil" role="tab" data-toggle="tab"><span class="fa fa-user"></span> Profil</a></li>
        <li><a href="#historique" role="tab-kv" data-toggle="tab"><span class="fa fa-history"></span> Historique des commandes</a></li>
      </ul>
      <div id="contenu" class="tab-content">
	          <div class="tab-pane fade in active" id="profil">
        <?php view1($u); ?>
		</div>
		<div class="tab-pane fade" id="historique">
          <h3>Dernières commandes effectuées</h3>
            <?php if (empty($tableauVue))  echo "<h4>Vous n'avez pas encore de commande d'enregistrer !</h4>";
              else  echo $tableauVue;
            ?>
        </div>
      </div>
	 </div>
</div>
        