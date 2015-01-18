

<h2 id="mainhead"><span class="fa fa-coffee"></span> Inscription</h2>
<hr>
<div class="row">
<div class="col-md-offset-3 col-md-6">
<form method="post" action="utilisateur.php?action=save">
        <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span><input type="text" class="form-control" value="Votre pseudo" name="pseudo" id="id_pseudo" required/></div><br/>
        <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span><input type="text" class="form-control" value="Votre nom" name="nom" id="id_nom" required/></div><br/>
		<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span><input type="text" class="form-control" value="Votre prenom" name="prenom" id="id_prenom" required/></div><br/>
        <div class="input-group"><span class="input-group-addon"><i class="fa fa-calculator"></i></span><input type="number" class="form-control" placeholder="Votre âge" name="age" id="id_age" min="1" max="100" required/></div><br/>
        <div class="input-group"><span class="input-group-addon"><i class="fa fa-key"></i></span><input type="password" class="form-control strength" name="pwd" placeholder="Mot de passe" id="id_pwd" required/></div><br/>
		<div class="input-group"><span class="input-group-addon"><i class="fa fa-key"></i></span><input type="password"  class="form-control" name="pwd2" placeholder="Confirmation mot de passe" id="id_pwd2" required/></div><br/>
        <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i></span><input type="email" class="form-control" value="Votre e-mail" name="email" id="id_email" required/></div><br/>
		<div class="input-group"><span class="input-group-addon"><i class="fa fa-phone"></i></span><input type="number" class="form-control" placeholder="Votre numéro de téléphone" name="numtel" id="id_numtel" required/></div><br/>
		<div class="input-group"><span class="input-group-addon"><i class="fa fa-university"></i></span><input type="text" class="form-control" value="Votre adresse" name="adr" id="id_adr" required/></div><br/>
		<input type="submit" class="btn btn-default" value="&#xf021; Mettre à jour" />
</form>
</div>
</div>