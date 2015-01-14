<li class="active" ?>><a href="index.php?action=choixmode"><span class="fa fa-gamepad"></span> Accueil</a></li>
<li class="active" ><a href="index.php?action=classement"><span class="fa fa-sort-amount-asc"></span> Recherche de vaisseau</a></li>
<li <?php /*if (isset($vue)) if ($page=="index" && ($vue=="statistiques" || $vue=="stats"))*/ echo 'class="active"'; ?>><a href="index.php?action=statistiques"><span class="fa fa-pie-chart"></span> Panier</a></li>
<li <?php /*if (isset($vue)) if ($page=='joueur' && ($vue=="defaut" || $vue=="profil" || $vue=='update' || $vue=='updated'|| $vue=='delete'))*/ echo 'class="active"'; ?>><a href="joueur.php?action=profil"><span class="fa fa-user"></span> Profil</a></li>
<li><a href="joueur.php?action=deconnexion"><span class="fa fa-toggle-off"></span> Se déconnecter (<?php echo $_SESSION['pseudo']; ?>)</a></li>
