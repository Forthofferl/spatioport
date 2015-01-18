<li ><a href="utilisateur.php?action=accueil"><span class="fa fa-university"></span> Accueil</a></li>
<li class="dropdown"> <a class="dropdown-toggle" href="#" data-toggle="dropdown"><span class="fa fa-search"></span> Recherche par catégorie</a>
  
  <ul class="dropdown-menu">
    <li><a href="vaisseau.php?action=readAll&cat=chasseur"><i class="fa fa-arrow-circle-o-right"></i> Chasseur</a></li>
    <li><a href="vaisseau.php?action=readAll&cat=bombardier"><i class="fa fa-arrow-circle-o-right"></i> Bombardier</a></li>
    <li><a href="vaisseau.php?action=readAll&cat=fregate"><i class="fa fa-arrow-circle-o-right"></i> Frégate</a></li>
    <li><a href="vaisseau.php?action=readAll&cat=corvette"><i class="fa fa-arrow-circle-o-right"></i> Corvette</a></li>
	<li><a href="vaisseau.php?action=readAll&cat=destroyer"><i class="fa fa-arrow-circle-o-right"></i> Destroyer</a></li>
	<li><a href="vaisseau.php?action=readAll&cat=croiser"><i class="fa fa-arrow-circle-o-right"></i> Croiser</a></li>
	<li><a href="vaisseau.php?action=readAll&cat=cuirasse"><i class="fa fa-arrow-circle-o-right"></i> Cuirassé</a></li>
	<li><a href="vaisseau.php?action=readAll&cat=porte-vaisseaux"><i class="fa fa-arrow-circle-o-right"></i> Porte-vaisseaux</a></li>
	<li><a href="vaisseau.php?action=readAll&cat=vaisseau-mere"><i class="fa fa-arrow-circle-o-right"></i> Vaisseau-mère</a></li>
	<li><a href="vaisseau.php?action=readAll&cat=vaisseaux de soutien"><i class="fa fa-arrow-circle-o-right"></i> Vaisseaux de soutien</a></li>
  </ul>
 
</li>
<li class="dropdown"> <a class="dropdown-toggle" href="#" data-toggle="dropdown"><span class="fa fa-search"></span> Rechercher un vaisseau</a>
  <div class="dropdown-menu" style="padding: 15px;">
    <form method="post" action="vaisseau.php?action=searched">
      <input type="text" id="id_pseudo" class="form-control" name="nomVaisseau" placeholder="nom d'un vaisseau" required/><br/>
      <input type="hidden" name="redirurl" value="<?php if(isset($_SERVER['HTTP_REFERER'])) echo $_SERVER['HTTP_REFERER']; ?>" />
      <input type="submit" class="btn btn-default" name="submit" value=" Rechercher"/><br/><br/>
    </form>
  </div>
</li>
<li  ><a href="utilisateur.php?action=panier"><span class="fa fa-shopping-cart"></span> Panier (<?php 
	if (isset($_SESSION['panier'])) echo count($_SESSION['panier']['nomVaisseau']);
	else echo 0; ?>)</a></li>

<li ><a href="utilisateur.php?action=create"><span class="fa fa-pencil"></span> S'inscrire</a></li>
<li class="dropdown"> <a class="dropdown-toogle" href="#" data-toggle="dropdown"><span class="fa fa-coffee"></span> Se connecter</a>
<div class="dropdown-menu" style="padding: 15px;">
    <form method="post" action="utilisateur.php?action=connected">
      <input type="text" id="id_pseudo" class="form-control" name="pseudo" placeholder="Pseudo" required/><br/>
      <input type="password" id="id_pwd" class="form-control" name="pwd" placeholder="Mot de passe" required/><br/>
      <input type="hidden" name="redirurl" value="<?php if(isset($_SERVER['HTTP_REFERER'])) echo $_SERVER['HTTP_REFERER']; ?>" />
      <input type="submit" class="btn btn-default" name="submit" value="&#xf205; Connexion"/><br/><br/>
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
  </script>



