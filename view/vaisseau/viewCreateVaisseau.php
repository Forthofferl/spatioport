<?php
echo <<< EOT
        <form method="post" action="." onsubmit="check()">
            <fieldset>
                <legend>$label un vaisseau</legend>
                
                <p>
                    <label for="id_nomVaisseau">Nom du Vaisseau</label> :
                    <input type="text" value="$v" name="nomVaisseau" id="id_nomVaisseau" required/>
                </p>
                <p>
                    <label for="id_prixVaisseau">Prix</label> :
                    <input type="text" value="$p" name="prix" id="id_prix" required/>
                </p>
                <p>
                    <label for="id_nbStock">Nombre en stock</label> :
                    <input type="text" value="$n" name="nbrStock" id="id_nbStock" required/>
                </p>
				 <p>
					<b>
                    Description:
					</b>
				
					<label for="id_categorie">Catégorie</label> :
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
					</select>
				</p>
				</p>
                    <textarea name="description" rows="3" cols="60" required/>$d</textarea>
                
				<p>
                <input type="hidden" name="action" value="$act" />
                <input type="hidden" name="controller" value="vaisseau" />                
                <p>
                    <input type="submit" value="$submit" />
                </p>
            </fieldset>
        </form>
EOT;
?>   
<script type="text/javascript">
function check() {
    var option = document.getElementById('categorie') ;
    if(option.selectedIndex == 0 ) // si le choix selectionné est le premier
         return false ;
    return true ;
}
</script>     