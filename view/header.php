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
                    <a href="?controller=utilisateur">Gestion des utilisateurs</a>
                </li><li>
                    <a href="?controller=utilisateur&action=create">S'inscrire</a>
                </li>
            </ul>
        </nav>
