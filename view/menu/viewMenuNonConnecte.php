<li class="active"><a href="index.php?"><span class="fa fa-sort-amount-asc"></span> Accueil</a></li>
<li class="active"><a href="index.php?find"><span class="fa fa-pie-chart"></span> Recherche de vaisseau</a></li>
<li class="active"><a href="index.php?action=panier"><span class="fa fa-file-text"></span>Panier </a></li>
<li class="active"><a href="index.php?action=inscription"><span class="fa fa-coffee"></span> S'inscrire</a></li>
<li class="active"><a href="index.php?action=connect"><span class="fa fa-coffee"></span> Se connecter</a></li>
</li>

  <script type="text/javascript"> // évite que les input sortent du form s'ils sont trop grand
  $(function() {
    $('.dropdown-toggle').dropdown();
    $('.dropdown input').click(function(e) {
      e.stopPropagation();
    });
  });
  </script>
