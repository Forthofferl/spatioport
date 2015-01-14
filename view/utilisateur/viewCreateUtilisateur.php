<?php
echo <<< EOT
        <form method="post" action=".">
            <fieldset>
                <legend>$label d'un utilisateur</legend>
                <p>
                    <label for="id_pseudo">Pseudo</label> :
                    <input type="text" value="$ps" name="pseudo" id="id_pseudo" $pseudo_status/>
                </p>
                <p>
                    <label for="id_nom">Nom</label> :
                    <input type="text" value="$n" name="nom" id="id_nom" required/>
                </p>
                <p>
                    <label for="id_prenom">Prénom</label> :
                    <input type="text" value="$p" name="prenom" id="id_prenom" required/>
                </p>
                <p>
                    <label for="id_email">Email</label> :
                    <input type="text" value="$e" name="email" id="id_email" required/>
                </p>
				<p>
                    <label for="id_age">Age</label> :
                    <input type="text" value="$a" name="age" id="id_age" required/>
                </p>
				<p>
                    <label for="id_adr">Adresse</label> :
                    <input type="text" value="$adr" name="adr" id="id_adr" required/>
                </p>
				<p>
                    <label for="id_numtel">Numéro de téléphone</label> :
                    <input type="text" value="$n" name="numtel" id="id_numtel" required/>
                </p>
                <p>
                    <label for="id_pwd">Mot de passe</label> :
                    <input type="password" value="$m1" name="pwd" id="id_pwd" required/>
                </p>
                <p>
                    <label for="id_pwd2">Mot de passe</label> :
                    <input type="password" value="$m2" name="pwd2" id="id_pwd2" required/>
                </p>
				
                <input type="hidden" name="action" value="$act" />
                <input type="hidden" name="controller" value="utilisateur" />                
                <p>
                    <input type="submit" value="$submit" />
                </p>
            </fieldset>
        </form>
EOT;
?>