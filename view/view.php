<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <title>Spatioport - <?php if (isset($pagetitle)) echo "$pagetitle"; else echo "Erreur" ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?= VIEW_PATH_BASE; ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= VIEW_PATH_BASE; ?>css/font-awesome.min.css" rel="stylesheet">
        <link href="<?= VIEW_PATH_BASE; ?>css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
        <link href="<?= VIEW_PATH_BASE; ?>css/strength-meter.min.css" rel="stylesheet">
        <link href="<?= VIEW_PATH_BASE; ?>css/bootstrap-tabs-x.min.css" rel="stylesheet">
        <link href="<?= VIEW_PATH_BASE; ?>css/style.css" rel="stylesheet">
    </head>
	<body>
        <!-- Menu -->
        <div >
            <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="fa fa-bars"></span>
                </button>
                
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php if(estConnecte())include_once VIEW_PATH . 'menu' . DS . 'viewMenuConnecte.php';  
					else include_once VIEW_PATH . 'menu' . DS . 'viewMenuNonConnecte.php'; ?>
                </ul>
            </div><!--/.nav-collapse -->
			</div><!--/.container -->
        </div>
        <!-- Fin du menu -->
        <div id="wrap">
        <div class="container">
        <!-- Principal -->
        <div class="row" id="main-content">
            <div class="col-md-1"></div>
            <div class="col-md-12">

                <div class="jumbotron">
                <?php /*if(!isset($vue)) {
                    echo "<h2>$messageErreur</h2>";
                    echo '<img class="img-responsive center-block" src="'.VIEW_PATH_BASE.'img/glitch.png" alt="Heeee ?!">';
                  }*/
                  /*else*/ require VIEW_PATH . $controller . DS . 'view' . ucfirst($view) . ucfirst($controller) . '.php';
				  ?>
                </div>

            </div>
        </div>
        </div>
        <!-- Fin principal -->
        <!-- Footer -->
        <div id="push"></div>
        </div>
        <div id="footer">
            <div class="container">
                <p class="credit">Spatioport <span class="fa fa-copyright"></span> 2015 -</p>
            </div>
        </div>
        <!-- JS placé à la fin pour un chargement plus rapide -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="<?= VIEW_PATH_BASE; ?>js/bootstrap.min.js"></script>
        <script src="<?= VIEW_PATH_BASE; ?>js/jquery.smartmenus.bootstrap.min.js"></script>
        <script src="<?= VIEW_PATH_BASE; ?>js/jquery.smartmenus.min.js"></script>
        <script type="text/javascript" src="<?= VIEW_PATH_BASE; ?>js/canvasjs.min.js"></script>
        <script type="text/javascript" src="<?= VIEW_PATH_BASE; ?>js/strength-meter.min.js"></script>
        <script type="text/javascript" src="<?= VIEW_PATH_BASE; ?>js/bootstrap-tabs-x.min.js"></script>
    </body>
</html>
	
