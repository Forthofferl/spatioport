


<h2 id="mainhead"><span class="fa fa-rocket"></span> Ajouter un vaisseau</h2>
<hr>
<div class="row">
<div class="col-md-offset-3 col-md-6">
<form method="post" action="vaisseau.php?action=save" onsubmit="check()">
        <div class="input-group"><span class="input-group-addon"></span><input type="text" type="text" class="form-control" value="<?php echo $v?>" placeholder="Nom du vaisseau" name="nomVaisseau" id="id_nomVaisseau" required/></div><br/>
        <div class="input-group"><span class="input-group-addon"></span><input type="text" class="form-control" value="<?php echo $p ?>" name="prix" placeholder="Prix du vaisseau" id="id_prix" required/></div><br/>
		<div class="input-group"><span class="input-group-addon"></span><input type="text" class="form-control" value="<?php echo $n ?>" placeholder="Nombre en stock" name="nbrStock" id="id_nbStock" required/></div><br/>
        
					<select name="categorie" id="categorie">
						<option selected="selected" value="selection de categorie">selectionnez une catégorie</option>
						<option value="chasseur">chasseur</option>
						<option value="bombardier">bombardier</option>
						<option value="fregate">frégate</option>
						<option value="corvette">corvette</option>
						<option value="destroyer">destroyer</option>
						<option value="croiser">croiser</option>
						<option value="cuirrase">cuirassé</option>
						<option value="porte-vaisseau">porte-vaisseaux</option>
						<option value="vaisseau mère">vaisseau mère</option>
						<option value="vaisseau de soutien">vaisseau de soutien</option>		
					</select><br/>
        <div class="input-group"><textarea name="description" placeholder="Description" rows="5" cols="67" required/><?php echo $d ?></textarea></div><br/>
		<input type="submit" class="btn btn-default" value="&#xf021; Ajouter le vaisseau" />
</form>
</div>
</div>  
<script type="text/javascript">
function check() {
    var option = document.getElementById('categorie') ;
    if(option.selectedIndex == 0 ) // si le choix selectionné est le premier
         return false ;
    return true ;
}
</script>     