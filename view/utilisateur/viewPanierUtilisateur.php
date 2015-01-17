<form method="post" action="panier.php">
<table style="width: 400px">
	<tr>
		<td colspan="4">Votre panier</td>
	</tr>
	<tr>
		<td>Libellé</td>
		<td>Quantité</td>
		<td>Prix Unitaire</td>
		<td>Action</td>
	</tr>


	<?php
	
		$nbArticles=count($_SESSION['panier']['nomVaisseau']);
		if ($nbArticles <= 0)
		echo "<tr><td>Votre panier est vide </ td></tr>";
		else
		{
			for ($i=0 ;$i < $nbArticles ; $i++)
			{
				echo "<tr>";
				echo "<td>".htmlspecialchars($_SESSION['panier']['nomVaisseau'][$i])."</ td>";
				echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qte'][$i])."\"/></td>";
				echo "<td>".htmlspecialchars($_SESSION['panier']['prixVaisseau'][$i])."</td>";
				echo "<td><a href=\"".htmlspecialchars("utilisateur.php?action=suppressionArticle&nomVaisseau=".rawurlencode($_SESSION['panier']['nomVaisseau'][$i]))."\">Supprimer</a></td>";
				echo "</tr>";
			}

			echo "<tr><td colspan=\"2\"> </td>";
			echo "<td colspan=\"2\">";
			echo "Total : ".$montantTotal;
			echo "</td></tr>";

			echo "<tr><td colspan=\"4\">";
			echo "<input type=\"submit\" value=\"Rafraichir\"/>";
			echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

			echo "</td></tr>";
		}
	
	?>
</table>
</form>