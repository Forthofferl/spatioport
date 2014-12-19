<?php
echo <<< EOT
        <form method="post" action=".">
            <fieldset>
                <legend>$label utilisateur</legend>
                <p>
                    <label for="id_login">Login du conducteur</label> :
                    <input type="text" name="login" id="id_login" required/>
                </p>
                <p>
                    <label for="id_mdpl">Mot de passe</label> :
                    <input type="password" name="mdp" id="id_mdp" required/>
                </p>
                <input type="hidden" name="action" value="connected" />
                <input type="hidden" name="controller" value="utilisateur" />                
                <p>
                    <input type="submit" value="$submit" na />
                </p>
            </fieldset>
        </form>
EOT;
?>