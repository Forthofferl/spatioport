<?php

require_once('config.inc.php');
$controller="utilisateur";
// On va chercher le modele dans "./model/ModelUtilisateur.php"
require_once MODEL_PATH . 'Model' . ucfirst($controller) . '.php';
require_once MODEL_PATH . 'Model.php';


switch ($action) {
        
	
    
	case "connected":
            if(!estConnecte()){
				
				if (!(isset($_POST['pseudo']) || isset($_POST['pwd']))){
                  header('Location: .');
				}
                $data = array(
                "pseudo" => $_POST['pseudo'],
                "pwd" => hash('sha256',$_POST['pwd'].Conf::getSeed()),
                );
				
                $user = ModelUtilisateur::selectWhere($data);
				
                if($user != null) {
					if($user[0]->active == "Oui") {
                    $data2 = array(
                      "idUtilisateur" => $user[0]->idUtilisateur,
                      "pseudo" => $user[0]->pseudo
                    );
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
					$view="error";
					$pagetitle="Erreur";
					$messageErreur="Votre compte n'est pas activé ! Vérifié vos e-mails et cliquez sur le lien d'activation ! Pensez à regarder dans vos courriels indesirabless !";
					}
				}
                else{
				$view = "error";
				$pagetitle = "Erreur";
				$messageErreur= "Pseudo ou mot de passe incorrect!";
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
		
	
			
    case "save":
	if(!estConnecte()){
        if (is_null($_POST['pseudo'] || is_null($_POST['prenom']) || is_null($_POST['nom']) 
                || is_null($_POST['age']) || is_null($_POST['adr']) || is_null($_POST['pwd']) || is_null($_POST['pwd2']) || is_null($_POST['email']) || is_null($_POST['numtel']))) {
            $view = "error";
            $pagetitle = "Erreur";
            break;
        }
        if(($_POST['pwd'])!=($_POST['pwd2'])){
            $view = "error";
            $pagetile ="Erreur";
			$messageErreur="Les deux mots de passe entré ne sont pas identiques";
            break;
        }
        $data = array(
            "pseudo" => $_POST["pseudo"],
            "nom" => $_POST["nom"],
            "prenom" => $_POST["prenom"],
            "email" => $_POST["email"],
			"adr" => $_POST["adr"],
			"age" => $_POST["age"],
			"numtel" => $_POST["numtel"],
            "pwd" => hash('sha256',$_POST["pwd"] . Conf::getSeed())
        );
		
		$dataCheck = array(
                "pseudo" => $_POST["pseudo"],
                "email" => $_POST["email"]
              );
              $existe = ModelUtilisateur::selectWhereOr($dataCheck);
              if ($existe != null) {
				$view="error";
				$pagetitle="erreur";
                $messageErreur="Ce pseudo ou cet e-mail est déjà utilisé !";
                break;
              }
        
		$data['active'] = md5(uniqid(rand(),true));
                  $active = $data['active'];
                  
                  //on créer l'email et on l'envoi
                  $to = $_POST['email'];
                  $subject = "Confirmation d'inscription à Spatioport";
                  $body = nl2br("Merci de vous être inscrit sur notre site !\nPour activer votre compte, cliquez sur le lien suivant : ".URL.BASE."utilisateur.php?action=activation&key=$active \nL'équipe du Spatioport \n");
                  $additional_headers = "From: <".SITEEMAIL.">\n";
                  $additional_headers .= "Reply-To: $".SITEEMAIL."\n";
                  $additional_headers .='Content-Type: text/html; charset="UTF-8"'."\n";
                  $additional_headers .='Content-Transfer-Encoding: 8bit';
								  mail($to, $subject, $body, $additional_headers);
				  ModelUtilisateur::insert($data);
        // Initialisation des variables pour la vue
        
        
        // Chargement de la vue
        $view = "created";
        $pagetitle = "Créer";
	}
        break;
	case "activation":
        if(!estConnecte()){
          $active = trim($_GET['key']);
          if(!empty($active)){
            $data = array(
              "active" => $active
            );
            $user = ModelUtilisateur::selectWhere($data);
            if($user != null) {
              $data2 = array(
                "idUtilisateur" => $user[0]->idUtilisateur,
                "active" => "Oui"
              );
			$_SESSION['idUtilisateur']=$user[0]->idUtilisateur;
              ModelUtilisateur::update($data2);
              $view="actived";
              $pagetitle="Validation complétée avec succès !";
            }
            else {
			$view="error";
			$pagetitle="Erreur";
              $messageErreur="Votre compte est déjà activé ou ce lien est invalide !";
            }
          }
          else {
            header('Location:.');
          }
        }
        else{
          header('Location:.');
        }
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
			$data=array("idAcheteur"=>$_SESSION['idUtilisateur']);
			$v=ModelUtilisateur::selectWhereHistorique($data);
			
			$tableauVue = '<div class="table-responsive"><table class="table table-bordered table-hover"><thead>
                <tr><th> Numéro de la commande </th><th> Date </th><th> Nom du vaisseau </th><th> Quantité </th><th> Montant </th></tr></thead><tbody>';
                foreach ($v as $commande) {
                  
				  $tableauVue .= '<tr><td>'.$commande->idAchat.'</td>';
                  $tableauVue .= '<td>'.$commande->date.'</td>';                  
                  $tableauVue .= '<td>'.$commande->nomVaisseau.'</td>';             
                  $tableauVue .= '<td>'.$commande->qte.'</td>';
				  $tableauVue .= '<td>'.$commande->montantUnitaire.'</td></tr>';
               
                
			
				}
			$tableauVue .= '</tbody></table></div>';
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
		$t = "";
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
		
		
		$data = array("nomVaisseau" => $_SESSION['nomVaisseau']);
        $u = ModelUtilisateur::selectWhereUtil($data);
		
		if(Model::estDansPanier($_SESSION['nomVaisseau'])==false){
		$_SESSION['qte']=$u[0]->nbrEnStock;
		}
		else{
		;
		
		}
		
		$data=$u[0]->nbrEnStock-$_POST["quantite"];
		if($data<0){
			$view="error";
			$pagetitle="Erreur";
			$messageErreur="Il n'y a pas assez de quantité en stock";
		}
		else{
		Model::ajouterArticle($u[0]->nomVaisseau,$_POST["quantite"],$u[0]->prixVaisseau);
		Model::updateQte($data);
		$view="ajoutPanier";
		$pagetitle="Ajouté!";
		}
		
	
	
	
	break;
	
	case"panier":
	
	
		$view="panier";
		$pagetitle="Panier";
		$montantTotal=ModelUtilisateur::MontantGlobal();
		$_SESSION['panier']['verrou']=false;
	
	break;
	
	case"suppressionArticle":
	
	if(!Model::isVerrouille()){
		$l = $_GET['nomVaisseau'] ;
		$l = preg_replace('#\v#', '',$l);
		$data= array("nomVaisseau" => $l);
		$u=ModelUtilisateur::selectWhereUtil($data);
		$_SESSION['idVais']=$u[0]->idVaisseau;
		Model::supprimerArticle($l);
		$view="panier";
		$pagetitle="Panier";
		$montantTotal=Model::MontantGlobal();
		//var_dump($_SESSION['qte']);
		Model::updateQte($_SESSION['qte']);
	}
	else{
			$view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Bien essayer! Mais vous ne pouvez pas supprimer un article via l'url lorsque que vous finalisez un achat !";
            
		}
	break;
	
	case"modifierArticle":
	
	if(estConnecte()&&!Model::isVerrouille()){
		$l = $_GET['nomVaisseau'] ;
		$l = preg_replace('#\v#', '',$l);
		$qte = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )); 
		var_dump($qte);
		$data=$_SESSION['qte']-$qte;
		if($data<=0){
			$view="error";
			$pagetitle="Erreur";
			$messageErreur="Il n'y a pas assez de quantité en stock";
		}
		else{
		
		Model::modifierArticle($l,$qte);
		$view="create";
		$pagetitle="Panier";
		//$montantTotal=Model::MontantGlobal();
		}
	}
	else{
			$view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Vous devez être connecté pour accéder à cette partie du site!";
            
		}
	break;
			
	
	case"reglement":
	if(estConnecte()){
	$data=array("idUtilisateur"=>
	$_SESSION['idUtilisateur']);
	$u=ModelUtilisateur::selectWhere($data);
	$n=$u[0]->nom;
	$p=$u[0]->prenom;
	$adr=$u[0]->adr;
	 $view="reglement";
	 $pagetitle="Reglement de la commande";
	 $_SESSION['panier']['verrou']=true;
	 $nbArticles=count($_SESSION['panier']['nomVaisseau']);
	 $montantTotal=ModelUtilisateur::MontantGlobal();
	 }
	 else{
			$view = "error";
            $pagetitle = "Erreur";
			$messageErreur="Vous devez être connecté pour accéder à cette partie du site!";
            
		}
	break;
	
	case"confirmation":
	if(estConnecte()){
	
		$montantTotal=ModelUtilisateur::MontantGlobal();
		$date=date('Y-m-j H:i:s');
		
		$data=array(
				"idAcheteur" => $_SESSION['idUtilisateur'],
				"montantGlobale" => $montantTotal,
				"date" => $date
		);
		ModelUtilisateur::insertAchat($data);
		$v=ModelUtilisateur::selectWhereAchat($data);
		$idA=$v[0]->idAchat;
		$nbArticles=count($_SESSION['panier']['nomVaisseau']);
		for ($i=0 ;$i < $nbArticles ; $i++){
			$data2=array("nomVaisseau"=>$_SESSION['panier']['nomVaisseau'][$i]);
			$u=ModelUtilisateur::selectWhereUtil($data2);
			$id=$u[0]->idVaisseau;
			$data3=array(
				"idVaisseau" => $id,
				"idAchat" => $idA,
				"qte" => $_SESSION['panier']['qte'][$i],
				"montantUnitaire" => $_SESSION['panier']['prixVaisseau'][$i]
			);
			ModelUtilisateur::insertCommande($data3);
			}
		
		Model::supprimePanier();
		Model::creationPanier();
		$view="recapitulatif";
		$pagetitle="Recapitulatif";
				
	}
	else{
	
		$view="error";
		$pagetitle="Connectez vous!";
		$messageErreur="Vous devez être connecté pour finaliser votre achat!";
	}
	
	break;
	case"contact":
	
	if(estConnecte()){
		$data=array("idUtilisateur"=>idUtilisateur);
		$u=ModelUtilisateur::selectWhere($data);
		$ps=$_SESSION['pseudo'];
		$mail=$u[0]->email;
		$view="contact";
		$pagetitle="Contact";
	}
	else{
		
		$ps="";
		$mail="";
		$view="contact";
		$pagetitle="Contact";
	}
	
	break;
		
	default :
			$view="accueil";
			$pagetitle="Bienvenue !";
			Model::creationPanier();

        
	
	
}
            
			
    
			
	
		
	
		

require VIEW_PATH . "view.php";
