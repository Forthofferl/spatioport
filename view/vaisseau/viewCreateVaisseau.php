<?php
echo <<< EOT
        <form method="get" action="">
            <fieldset>
                <legend>$label un vaisseau</legend>
                $hidden_id
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
                    <input type="text" value="$n" name="nbpStock" id="id_nbStock" required/>
                </p>
				 <p>
                    <label for="id_description">Description</label> :
                    <input type="text" value="$d" name="description" id="id_description" required/>
                </p>
                <input type="hidden" name="action" value="$act" />
                <input type="hidden" name="controller" value="vaisseau" />                
                <p>
                    <input type="submit" value="$submit" />
                </p>
            </fieldset>
        </form>
EOT;
?>        