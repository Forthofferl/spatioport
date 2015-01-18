<?php
function view1($u) {
    foreach ($u as $t) {
      
        $n = $t->nom;
        $p = $t->prenom;
        $adr = $t->adr;
		
		echo <<< EOT
		
        
		<h3>Adresse de facturation et de livraison</h3>
				<h4>$n</h4>
				<h4>$p</h4>
				<h4>$adr</h4>
		
EOT;
    
	}
}
?>
        <!-- Une variable $tab_util est donnée -->    
        <div>
            <h3>Reglement de la commande:</h3></br>
		<div class="col-md-12">
            <table style="width: 50%">
			<tr>
				<td colspan="4">Votre commande</td>
			</tr></br>
			<tr>
				<td>Libellé</td>
				<td>Quantité</td>
				<td>Prix Unitaire</td>
				
			</tr>
            <?php for ($i=0 ;$i < $nbArticles ; $i++)
			{
			
				echo "<tr>";
				echo "<td>".htmlspecialchars($_SESSION['panier']['nomVaisseau'][$i])."</ td>";
				echo "<td>".htmlspecialchars($_SESSION['panier']['qte'][$i])."</td>";
				echo "<td>".htmlspecialchars($_SESSION['panier']['prixVaisseau'][$i])."</td>";
				
				echo "</tr>";
			}

			echo "<tr><td colspan=\"2\"> </td>";
			echo "<td colspan=\"2\">";
			echo "Total : ".$montantTotal;
			echo "</td></tr>"; ?>
            </table>
			
			<div class="row">
                <div class="col-md-12">
				
			<?php view1($u);?>
			</div>
			</div>
			</div>
			
			
			<a href="utilisateur.php?action=panier" class="btn btn-warning"><span class="fa fa-reply"></span> Revenir au panier</a> 
			<a href="utilisateur.php?action=confirmation " class="btn btn-primary"><span ></span> Confirmer mon achat</a> 
			
			
        </div>
		