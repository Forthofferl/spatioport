
         
        <div>
            <h3>Récapitulatif et reglement de la commande:</h3></br>
		<div class="row">
            <div class="col-lg-6">
            <table class="table-responsive;" style="width: 100%">
			<tr>
				<td colspan="4">Votre commande</td>
			</tr>
			
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
			</div>
			<div class="col-md-6">
			<h4><b>Adresse de livraison et de facturation</b></h4>
			<center>
			<table class="table-responsive;">
			
			<tr>
				
				<td>
					<div class="col-md-6">
					<h4><?php echo $n ?></h4>
					</div>
				</td>
				
				
				<td>
					<div class="col-md-6">
					<h4><?php echo $p ?></h4>
					</div>
				</td>				
			<tr>			
			</table>
			</center>
					<h4><?php echo $adr ?></h4>
			
			
			
			
			<a href="utilisateur.php?action=panier" class="btn btn-warning"><span class="fa fa-reply"></span> Revenir au panier</a> 
			<a href="utilisateur.php?action=confirmation" class="btn btn-primary"><span ></span> Confirmer mon achat</a> 
			</div>
			</div>
			
        </div>
		