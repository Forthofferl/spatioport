

<h2 id="mainhead"><span class="fa fa-refresh fa-spin"></span> Mettre à jour le profil de <?php echo $ps ?></h2>
<hr>
<div class="row">
<div class="col-md-offset-3 col-md-6">
<form method="post" action="administrateur.php?action=updated">
        <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span><input type="text" class="form-control" value="<?php echo $ps ?>" name="pseudo" id="id_pseudo" required/></div><br/>
        <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span><input type="text" class="form-control" value="<?php echo $n ?>" name="nom" id="id_nom" required/></div><br/>
		<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span><input type="text" class="form-control" value="<?php echo $p ?>" name="prenom" id="id_prenom" required/></div><br/>
        <div class="input-group"><span class="input-group-addon"><i class="fa fa-calculator"></i></span><input type="number" class="form-control" value="<?php echo $a ?>" name="age" id="id_age" min="1" max="100" required/></div><br/>
        <div class="input-group"><span class="input-group-addon"><i class="fa fa-key"></i></span><input type="password" class="form-control strength" name="pwd" placeholder="Nouveau mot de passe" id="id_pwd" autocomplete="off"/></div><br/>
        <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i></span><input type="email" class="form-control" value="<?php echo $e ?>" name="email" id="id_email" required/></div><br/>
		<div class="input-group"><span class="input-group-addon"><i class="fa fa-phone"></i></span><input type="number" class="form-control" value="<?php echo $t ?>" name="numtel" id="id_numtel" required/></div><br/>
		<div class="input-group"><span class="input-group-addon"><i class="fa"></i></span><input type="text" class="form-control" value="<?php echo $adr ?>" name="adr" id="id_adr" required/></div><br/>
		<label> Admin ? </label>
		
		<center><div class="input-group"><input type="radio" class="form-control" value="Oui" name="admin" id="id_admin" >Oui</div>
		<div class="input-group"><input type="radio" class="form-control" value="Non" name="admin" id="id_admin" checked>Non</div></center>
		<input type="submit" class="btn btn-default" value="&#xf021; Mettre à jour" />
</form>
</div>
</div>