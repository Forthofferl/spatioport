<?php






// vérifier si l'utilisateur est connecté
function estConnecte() {
    return(isset($_SESSION['idUtilisateur']));
}
?>
