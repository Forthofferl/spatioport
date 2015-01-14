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
                </li>
				<li>
					<a href="rechercherVaisseau.php?page=rechercherVaisseau">Rechercher un Vaisseau</a>
                </li><li>
					<a href="panier.php?page=panier">Panier</a>
                </li><li <?php if (isset($view)) if ($page=="index" && $view=="profil") echo 'class="active"'; ?>>
					
					<a href="index.php?action=profil">Profil</a>

                </li>
				<li>
                    
                    <?php if(estConnecte()) include_once VIEW_PATH.'menu'.DS.'viewMenuConnecte.php';
                    else include_once  VIEW_PATH.'menu'.DS.'viewMenuNonConnecte.php';
                    ?>
                </li>
            </ul>
        </nav>
		
		
	
