<?php
echo <<< EOT
        <form method="post" action=".">
            <fieldset>
                <legend>$label utilisateur</legend>
                <p>
                    <label for="id_pseudo">Pseudo</label> :
                    <input type="text" name="pseudo" id="id_pseudo" required/>
                </p>
                <p>
                    <label for="id_pwd">Mot de passe</label> :
                    <input type="password" name="pwd" id="id_pwd" required/>
                </p>
                <input type="hidden" name="action" value="connected" />
                <input type="hidden" name="controller" value="utilisateur" />                
                <p>
                    <input type="submit" value="$submit"/>
                </p>
            </fieldset>
        </form>
EOT;
?>