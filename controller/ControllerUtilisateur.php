<?php

require_once('config.inc.php');
$controller="Utilisateur";
// On va chercher le modele dans "./model/ModelUtilisateur.php"
require_once MODEL_PATH . 'Model' . ucfirst($controller) . '.php';
require_once MODEL_PATH . 'Model.php';


switch ($action) {
        
	
    case "connect":
		
		$view="connexion";
		$pagetitle="connexion";
		$label="connexion";
		$submit="Se connecter";
		break;
		
	case "connected":
            if(!estConnecte()){
				
				if (!(isset($_POST['pseudo']) || isset($_POST['pwd']))){
                  header('Location: .');
				}
                $data = array(
                "pseudo" => $_POST['pseudo'],
                "pwd" => hash('sha256',$_POST['pwd'].Conf::getSeed()),
                );
				//$pwd=$_POST['pwd'];
				//var_dump($pwd);
				//var_dump($data);
                $user = ModelUtilisateur::selectWhere($data);
				//var_dump($user);
                if($user != null) {
                  
                    $data2 = array(
					  "admin" =>$user[0]->admin,
                      "idUtilisateur" => $user[0]->idUtilisateur,
                      "pseudo" => $user[0]->pseudo
					
                    );
                    ModelUtilisateur::connexion($data2);
					//var_dump($data2);
                    /*if(isset($_POST['redirurl'])) $url = $_POST['redirurl'];
                    else{$url = ".";}
                    header("Location:$url");*/
					$view="connected";
					$pagetitle="Vous êtes connecté!";
                }
                else{
				$view = "error";
				$pagetitle = "Erreur";
				break;
				} 
				
            }
            else{
              header('Location: .');
            }
			break;
		
	case "deconnexion":
                ModelUtilisateur::deconnexion();
                header('Location: .');
            
           
    break;
		
	case "created":
	
			$view="created";
			$pagetitle="Créer!";
			$ps=myGet('pseudo');
			break;
			
    case "save":
        if (is_null(myGet('pseudo') || is_null(myGet('prenom')) || is_null(myGet('nom')) 
                || is_null(myGet('age')) || is_null(myGet('adr')) || is_null(myGet('pwd')) || is_null(myGet('pwd2')) || is_null(myGet('email')) || is_null(myGet('numtel')))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        if((myGet('mdp'))!=(myGet('mdp2'))){
            $view = "error";
            $pagetile ="Erreur";
            break;
        }
        $data = array(
            "pseudo" => myGet("pseudo"),
            "nom" => myGet("nom"),
            "prenom" => myGet("prenom"),
            "email" => myGet("email"),
			"adr" => myGet("adr"),
			"age" => myGet("age"),
			"numtel" => myGet("numtel"),
            "pwd" => hash('sha256',myGet("pwd") . Conf::getSeed())
        );
        ModelUtilisateur::insert($data);
        // Initialisation des variables pour la vue
        $login = myGet('pseudo');
        $tab_util = ModelUtilisateur::selectAll();
        // Chargement de la vue
        $view = "created";
        $pagetitle = "Créer";
        break;

   case "update":
	if(estConnecte()){
        
        $data = array("pseudo" => $_SESSION['pseudo']);
        $u = ModelUtilisateur::selectWhere($data);
        // Initialisation des variables pour la vue
		
		$ps=$u[0]->pseudo;
        $a = $u[0]->age;
        $n = $u[0]->nom;
        $p = $u[0]->prenom;
        $e = $u[0]->email;
		$t = $u[0]->numtel;
		$adr = $u[0]->adr;
		
        $pagetitle = "Mise à jour d'un utilisateur";
        $label = "Mise à jour ";
        $pseudo_status = "readonly";
        $submit = "Mise à jour";
        $act = "updated";
        $view = "update";
		
	}
	else{
	$view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Vous devez être connecté pour pouvoir accéder à cette partie.";
            
	}
    break;
		
	case "updated":
            if(estConnecte()){
              if (empty($_POST)) {
                  header('Location: utilisateur.php?action=update');
                  break;
              }
              else {
                $data = array(
                  "idUtilisateur" => $_SESSION["idUtilisateur"],
                  "pseudo" => $_POST["pseudo"],
                  "age" => $_POST["age"],
                  "email" => $_POST["email"],
				  "adr"=>$_POST["adr"],
				  "numtel"=>$_POST["numtel"],
				  "nom"=>$_POST["nom"],
				  "prenom"=>$_POST["prenom"]
				  
                );
                if(!empty($_POST["pwd"])){
                  $data['pwd']=hash('sha256',$_POST["pwd"].Conf::getSeed());
                }
                $dataCheck = array(
                  "pseudo" => $_POST["pseudo"],
                  "email" => $_POST["email"]
                );
                $existe = ModelUtilisateur::selectWhereOr($dataCheck);
                if ($existe != null && $existe[0]->idUtilisateur!=$_SESSION['idUtilisateur']) {
                  $messageErreur="Ce pseudo ou cet e-mail est déjà utilisé !";
                  break;
                }
    			      else {
                    $r = ModelUtilisateur::update($data);
                    $_SESSION['pseudo'] = $_POST["pseudo"];
					$pseudo=$_SESSION['pseudo'];
                    $view="updated";
                    $pagetitle='Profil mis à jour !';
                }
              }
            }
            
			else {
				$view="error";
				$pagetitle="Erreur";
				$messageErreur="Il semblerait que vous ayez trouvé un glitch dans le système !";
			  }
        break;

		case "delete":
            if(estConnecte()){
                $view="delete";
                $pagetitle="Confirmation suppression de votre compte";
            }
            else{
              $view="error";
				$pagetitle="Erreur";
				$messageErreur="Vous devez être connecter pour accéder à cette partie du site!";
            }
        break;

        case "deleted":
            if(estConnecte()){
              $data = array(
                "idUtilisateur" => $_SESSION['idUtilisateur'],
              );
              ModelUtilisateur::suppression($data);
              $dataWaiting = array(
                "idUtilisateur" => $_SESSION['idUtilisateur']
              );
              $attente = ModelUtilisateur::selectWhere($dataWaiting);
              if($attente != null) { // on est en recherche d'un adversaire ?
                $dataDel = array(
                  "idUtilisateur" => $_SESSION['idUtilisateur']
                );
                ModelUtilisateur::suppressionWhere($dataDel);
              }
              ModelUtilisateur::deconnexion();
              $view="deleted";
              $pagetitle="Profil supprimé !";
            }
            else{
              $view="error";
				$pagetitle="Erreur";
				$messageErreur="Vous devez être connecter pour accéder à cette partie du site!";
            }
        break;
		
		case "profil":
	
		if(estConnecte()){
			if (!isset($_SESSION['pseudo'])) {
            $view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Vous devez être connecté pour accéder à cette partie du site!";
            break;
			}
        
			$data=array("pseudo"=>$_SESSION['pseudo']);
			
			
			$u=ModelUtilisateur::selectWhere($data);
			
			
			if(count($u)==null){
			$view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Vous devez être connecté pour accéder à cette partie du site!";
            break;
			}
			else{
			$view="profil";
			$controller="utilisateur";
			$pagetitle="Informations sur le profil";
			
			}
		}
		else{
			$view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Vous devez être connecté pour accéder à cette partie du site!";
            
		}
	
	
	break;

	
		
	case "create":
        $ps = "";
        $n = "";
        $p = "";
		$a = "";
		$adr = "";
		$n = "";
        $e = "";
        $m1="";
        $m2="";
        $label = "Créer";
        $pseudo_status = "required";
        $pagetitle = "Création d'un utilisateur";
		
        $submit = "Création";
        $view = "create";
        $act="save";
		break;
		
	case"dansPanier":
	if(estConnecte()){
		$data = array("nomVaisseau" => $_SESSION['nomVaisseau']);
        $u = ModelUtilisateur::selectWhereUtil($data);
		Model::ajouterArticle($u[0]->nomVaisseau,$_POST["quantite"],$u[0]->prixVaisseau);
		$view="ajoutPanier";
		$pagetitle="Ajouté!";
	}
	else{
			$view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Vous devez être connecté pour accéder à cette partie du site!";
            
		}
	
	break;
	
	case"panier":
	
	if(estConnecte()){
		$view="panier";
		$pagetitle="Panier";
		$montantTotal=ModelUtilisateur::MontantGlobal();
	}
	else{
			$view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Vous devez être connecté pour accéder à cette partie du site!";
            
		}
	break;
	
	case"suppressionArticle":
	
	if(estConnecte()){
		$l = $_GET['nomVaisseau'] ;
		$l = preg_replace('#\v#', '',$l);
		Model::supprimerArticle($l);
		$view="panier";
		$pagetitle="Panier";
		$montantTotal=Model::MontantGlobal();
	}
	else{
			$view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Vous devez être connecté pour accéder à cette partie du site!";
            
		}
	break;
	case "accueil":
		$view="accueil";
		$pagetitle="Accueil";
	break;
			
	
	
	
		
	default :
			$view="error";
			$pagetitle="Erreur";
            $messageErreur="Il semblerait que vous ayez trouvé un glitch dans le système !";

        
	
	
}
            
			
    
			
	
		
	
		

require VIEW_PATH . "view.php";
