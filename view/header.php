<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/navstyle.css">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
        <nav>
            <ul>
                <li>
                    <a href="index.php?page=index">Accueil</a>
                </li><li>
                    <a href="?controller=utilisateur&action=create">S'inscrire</a>
				</li>
				<li>
					<a href="rechercherVaisseau.php?page=rechercherVaisseau">Rechercher un Vaisseau</a>
                </li><li>
					<a href="panier.php?page=panier">Panier</a>
                </li><li>
					<a href="profil.php?page=profil">Profil</a>

                </li>
				<li>
					<a href="?controller=utilisateur&action=connexion">Se connecter</a>
                </li>
            </ul>
        </nav>
		
		
	
