<?php
echo <<< EOT
        <form method="get" action="">
            <fieldset>
                <legend>$label un trajet</legend>
                $hidden_id
                <p>
                    <label for="id_conducteur">Login du conducteur</label> :
                    <input type="text" value="$c" name="conducteur" id="id_conducteur"/>
                </p>
                <p>
                    <label for="id_depart">Départ</label> :
                    <input type="text" value="$d" name="depart" id="id_depart" required/>
                </p>
                <p>
                    <label for="id_arrivee">Arrivée</label> :
                    <input type="text" value="$a" name="arrivee" id="id_arrivee" required/>
                </p>
                <p>
                    <label for="id_prix">Prix</label> :
                    <input type="text" value="$p" name="prix" id="id_prix" required/>
                </p>
                <p>
                    <label for="id_nbplaces">Nombre de places</label> :
                    <input type="text" value="$n" name="nbplaces" id="id_nbplaces" required/>
                </p>
                <input type="hidden" name="action" value="$act" />
                <input type="hidden" name="controller" value="trajet" />                
                <p>
                    <input type="submit" value="$submit" />
                </p>
            </fieldset>
        </form>
EOT;
?>        