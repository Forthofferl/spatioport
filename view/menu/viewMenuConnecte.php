<li <?php if (isset($view)) if ($page=='utilisateur' && ($view=="defaut" || $view=="profil" || $view=='update' || $view=='updated'|| $view=='delete')) echo 'class="active"'; ?>>
<a href="joueur.php?action=profil"><span class="fa fa-user"></span> Profil</a></li>
<li><a href="joueur.php?action=deconnexion"><span class="fa fa-toggle-off"></span> Se déconnecter (<?php echo $_SESSION['pseudo']; ?>)</a></li>
