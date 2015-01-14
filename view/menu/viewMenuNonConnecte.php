<li class="active"><a href="utilisateur.php?action=create"><span class="fa fa-sort-amount-asc"></span> Accueil</a></li>
<li class="active"><a href="utilisateur.php?action=recherche"><span class="fa fa-pie-chart"></span> Recherche de vaisseau</a></li>
<li class="active"><a href="utilisateur.php?action=panier"><span class="fa fa-file-text"></span>Panier </a></li>
<li class="active"><a href="utilisateur.php?action=create"><span class="fa fa-coffee"></span> S'inscrire</a></li>
<li class="active"> <a href="utilisateur.php?action=connect"><span class="fa fa-coffee"></span> Se connecter</a></li>
  <!--<div class="dropdown-menu" style="padding: 15px;">
    <form method="post" action="joueur.php?action=connect">
      <input type="text" id="id_pseudo" class="form-control" name="pseudo" placeholder="Pseudo" required/><br/>
      <input type="password" id="id_pwd" class="form-control" name="pwd" placeholder="Mot de passe" required/><br/>
      <input type="hidden" name="redirurl" value="<?php if(isset($_SERVER['HTTP_REFERER'])) echo $_SERVER['HTTP_REFERER']; ?>" />
      <input type="submit" class="btn btn-default" name="submit" value="&#xf205; Connexion"/><br/><br/>
      <a href="joueur.php?action=recoverypwd"><small><span class="fa fa-question-circle"></span> Mot de passe oublié ?</small></a><br/>
    </form>
  </div>
</li>

  <script type="text/javascript"> // évite que les input sortent du form s'ils sont trop grand
  $(function() {
    $('.dropdown-toggle').dropdown();
    $('.dropdown input').click(function(e) {
      e.stopPropagation();
    });
  });
  </script>-->
